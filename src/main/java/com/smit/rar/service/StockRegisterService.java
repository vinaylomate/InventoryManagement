package com.smit.rar.service;

import com.smit.rar.dao.StockRegisterDAO;
import com.smit.rar.dto.*;
import com.smit.rar.model.*;
import com.smit.rar.repository.*;
import lombok.AllArgsConstructor;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.data.relational.core.sql.In;
import org.springframework.http.HttpHeaders;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import javax.persistence.EntityManager;
import javax.persistence.Query;
import javax.transaction.Transactional;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.sql.*;
import java.time.LocalDate;
import java.util.*;
import java.util.stream.Collectors;
import java.util.stream.IntStream;

@Service
@AllArgsConstructor
public class StockRegisterService {

    private final StockRegisterRepository stockRegisterRepository;
    private final LocationRepository locationRepository;
    private final EntryRepository entryRepository;
    private final ProductRegisterRepository productRegisterRepository;
    private final InventoryRepository inventoryRepository;
    private final DocNoRepository docNoRepository;
    private final UserRepository userRepository;


    @Transactional
    public ResponseEntity<StockRegister> addStockRegister(StockRegister stockRegister, Long locationId, Long entryId, Long productRegisterId, String docNo, Long userId) {

        if (stockRegister.getStockRegisterId() == null) {
            StockRegister prevStockRegister = stockRegisterRepository.findTopByOrderByStockRegisterIdDesc();
            stockRegister.setStockRegisterId(prevStockRegister.getStockRegisterId() + 1L);
        }

        Location location = locationRepository.findById(locationId).get();
        Entry entry = entryRepository.findById(entryId).get();
        ProductRegister productRegister = productRegisterRepository.findById(productRegisterId).get();
        DocNo docNos = docNoRepository.getDocNo(docNo);
        User user = userRepository.findById(userId).get();
        stockRegister.setLocation(location);
        stockRegister.setEntry(entry);
        stockRegister.setProductRegister(productRegister);
        stockRegister.setUser(user);

        List<StockRegister> stockRegisters = stockRegisterRepository.findByDate(stockRegister.getEntryDate(), productRegisterId, locationId);
        StockRegister updatedStockRegister = !stockRegisters.isEmpty() ? stockRegisters.get(stockRegisters.size() - 1) : null;
        Double changeQty = stockRegister.getQty();

        if (entry.getEntryType().equals(EntryType.OUT)) {
            changeQty = changeQty * -1L;
        }

        //previous stock entry
        if ((updatedStockRegister != null && updatedStockRegister.getCurrentQty() + changeQty < 0) ||
                (updatedStockRegister == null && changeQty < 0)) {
            throw new RuntimeException("Stock is zero now and ur still going to out this product");
        } else if (updatedStockRegister == null) {
            stockRegister.setCurrentQty(changeQty);
        } else {
            stockRegister.setCurrentQty(updatedStockRegister.getCurrentQty() + changeQty);
        }

        //next stock entry
        List<StockRegister> nextStockRegister = stockRegisterRepository.findNextStock(stockRegister.getEntryDate(), productRegisterId, locationId);
        Inventory inventory = inventoryRepository.findInventory(productRegisterId, locationId);
        if (nextStockRegister != null && !nextStockRegister.isEmpty()) {
            for (StockRegister register : nextStockRegister) {
                if (register.getCurrentQty() + changeQty < 0)
                    throw new RuntimeException("Stock is zero now and ur still going to out this product");
                register.setCurrentQty(register.getCurrentQty() + changeQty);
            }
            stockRegisterRepository.saveAll(nextStockRegister);
            if (inventory == null) {
                inventory = new Inventory(new InventoryId(productRegisterId, locationId), productRegister, location, nextStockRegister.get(nextStockRegister.size() - 1).getCurrentQty());
            } else {
                inventory.setQty(nextStockRegister.get(nextStockRegister.size() - 1).getCurrentQty());
            }
        } else {
            if (inventory == null) {
                inventory = new Inventory(new InventoryId(productRegisterId, locationId), productRegister, location, stockRegister.getCurrentQty());
            } else {
                inventory.setQty(stockRegister.getCurrentQty());
            }
        }
        inventoryRepository.save(inventory);
        docNos.setIsUsed(true);
        stockRegister.setDocNo(docNos);
        docNoRepository.save(docNos);

        stockRegisterRepository.save(stockRegister);
        return ResponseEntity.ok(stockRegister);
    }

    public ResponseEntity<List<BatchNoDTO>> getBatchNo(Long locationId, Long productRegisterId, Long userId) {

        User user = userRepository.findById(userId).get();
        if(user.getUserRole().equals(UserRole.ADMIN)) userId = 0L;
        List<BatchNoDTO> batchNos = stockRegisterRepository.getBatch(locationId, productRegisterId, userId);
        return ResponseEntity.ok(batchNos);
    }

    public ResponseEntity<Map<String, Object>> getStockRegister(Long companyId, Long productTypeId, Long locationId, String search, int pageNumber, int pageSize, String fromDate, String endDate, Long userId) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        Page<StockRegister> page;
        User user = userRepository.findById(userId).get();
        search = search.equals("null") ? null : search.replace("!", "/");
        userId = user.getUserRole().equals(UserRole.ADMIN) ? 0 : userId;

        if (fromDate.equals("null") && endDate.equals("null")) {
            fromDate = null;
            endDate = null;
            page = stockRegisterRepository.filterProducts(companyId, locationId, productTypeId, search, null, null, userId, pageable);
        } else {
            page = stockRegisterRepository.filterProducts(companyId, locationId, productTypeId, search, LocalDate.parse(fromDate), LocalDate.parse(endDate), userId, pageable);
        }
        Map<String, Object> hashMap = new HashMap<>();
        hashMap.put("data", page.getContent());
        hashMap.put("count", page.getTotalElements());
        return ResponseEntity.ok(hashMap);
    }

    @Transactional
    public ResponseEntity<Map<String, Object>> getReport(Long companyId, Long productTypeId, Long locationId, Long productCategoryId, String batchNo, String search, int pageNumber, int pageSize) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        search = search.equals("null") ? null : search.replace("!","/");
        batchNo = batchNo.equals("null") ? null : batchNo.replace("!", "/");
        Page<StockReportBatchDTO> page = stockRegisterRepository.getBatch(companyId, productTypeId, locationId, productCategoryId, batchNo, search, pageable);
        Map<String, Object> map = new HashMap<>();
        map.put("data", page.getContent());
        map.put("count", page.getTotalElements());
        return ResponseEntity.ok(map);
    }

    @Transactional
    public ResponseEntity<Map<String, Object>> getStock(Long companyId, Long productTypeId, Long locationId, Long productCategoryId, String brandName, String search, int pageNumber, int pageSize) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        search = search.equals("null") ? null : search.replace("!","/");
        brandName = brandName.equals("null") ? null : brandName.replace("!", "/");
        Page<StockReportDTO> page = stockRegisterRepository.getStock(companyId, productTypeId, locationId, productCategoryId, brandName, search, pageable);
        Map<String, Object> map = new HashMap<>();
        map.put("data", page.getContent());
        map.put("count", page.getTotalElements());
        return ResponseEntity.ok(map);
    }

    @Transactional
    public ResponseEntity<Map<String, Object>> getOFSReport(Long companyId, Long productTypeId, Long locationId, Long productCategoryId, String batchNo, String search, int pageNumber, int pageSize) {
        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        search = search.equals("null") ? null : search.replace("!","/");
        batchNo = batchNo.equals("null") ? null : batchNo.replace("!", "/");
        Page<OFSReportDTO> page = stockRegisterRepository.getOFS(companyId, productTypeId, locationId, productCategoryId, batchNo, search, pageable);
        Map<String, Object> map = new HashMap<>();
        map.put("data", page.getContent());
        map.put("count", page.getTotalElements());
        return ResponseEntity.ok(map);
    }

    @Transactional
    public ResponseEntity<Map<String, Object>> getInOutReport(Long companyId, Long productTypeId, Long locationId, String search, int pageNumber, int pageSize, String fromDate, String endDate) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        search = search.equals("null") ? null : search.replace("!","/");
        LocalDate from = fromDate.equals("null") ? null : LocalDate.parse(fromDate);
        LocalDate to = endDate.equals("null") ? null : LocalDate.parse(endDate);
        Page<InOutReportDTO> page = stockRegisterRepository.inOutReport(companyId, locationId, productTypeId, search, from, to, pageable);

        for (InOutReportDTO inOutReportDTO : page.getContent()) {
            LocalDate date = from == null ? null : from.minusDays(1);
            ProductRegister productRegister = productRegisterRepository.findBySageCode(inOutReportDTO.getSageCode());
            Long productRegisterId = productRegister.getProductRegisterId();
            Pageable pageable1 = PageRequest.of(0,1);
            Page<StockRegister> prevStockRegisters = stockRegisterRepository.findStockByDate(productRegisterId, date, pageable1);
            Page<StockRegister> stockRegisters = stockRegisterRepository.findStockByDate(productRegisterId, to, pageable1);
            Double openingStock = 0.0;
            if (!prevStockRegisters.getContent().isEmpty() && date != null)
                openingStock = prevStockRegisters.getContent().get(0).getCurrentQty();
            inOutReportDTO.setOpeningStock(openingStock);
            Double closingStock = 0.0;
            if (!stockRegisters.getContent().isEmpty()) closingStock = stockRegisters.getContent().get(0).getCurrentQty();
            inOutReportDTO.setClosingStock(closingStock);
            inOutReportDTO.setFocusCode(productRegister.getFocusCode());
            inOutReportDTO.setDescription(productRegister.getDescription());
        }
        Map<String, Object> hashMap = new HashMap<>();
        hashMap.put("data", page.getContent());
        hashMap.put("count", page.getTotalElements());
        return ResponseEntity.ok(hashMap);
    }

    public ResponseEntity<List<StockRegister>> getView(String docNo, Long userId) {

        User user = userRepository.findById(userId).get();
        userId = user.getUserRole().equals(UserRole.ADMIN) ? 0 : userId;
        return ResponseEntity.ok(stockRegisterRepository.getView(docNo, userId));
    }

    public ResponseEntity<List<StockRegister>> getViewInOut(String locationCode, String sageCode, String fromDate, String endDate) {

        sageCode = sageCode.replace("!", "/");
        locationCode = locationCode.trim();
        Location location = locationRepository.findByCode(locationCode);
        LocalDate from = fromDate.equals("null") ? null : LocalDate.parse(fromDate);
        LocalDate end = endDate.equals("null") ? null : LocalDate.parse(endDate);
        List<StockRegister> mainList = stockRegisterRepository.getViewInOut(location.getLocationId(), sageCode, from, end);
        return ResponseEntity.ok(mainList);
    }

    public ResponseEntity<List<StockRegister>> deleteStockRegister(String docNo, Long userId) {

        List<StockRegister> list = stockRegisterRepository.getByDocNo(docNo);
        for(StockRegister stockRegister : list) {
            stockRegister.setIsDeleted(true);
            stockRegister.setUser(userRepository.findById(userId).get());
        }
        stockRegisterRepository.saveAll(list);
        return ResponseEntity.ok(list);
    }

    @Transactional
    public String addAllStockEntry(StockRegisterDAO stockReportDTO) {
        StockRegister prevStockRegister = stockRegisterRepository.findTopByOrderByStockRegisterIdDesc();
        Long id = prevStockRegister.getStockRegisterId()+1L;
        for (StockRegister stockRegister : stockReportDTO.getStocks()) {
            stockRegister.setStockRegisterId(id);
            Location location = locationRepository.findById(stockRegister.getLocationId()).get();
            Entry entry = entryRepository.findById(stockRegister.getEntryId()).get();
            ProductRegister productRegister = productRegisterRepository.findBySageCode(stockRegister.getProductRegisterId());
            DocNo docNos = docNoRepository.getDocNo(stockRegister.getDocNoId());
            User user = userRepository.findById(stockRegister.getUserId()).get();
            if (docNos == null) {
                DocNo prevDocNo = docNoRepository.getDocNo(location.getLocationId());
                DocNo docNo = new DocNo(prevDocNo.getDocNoId()+1L, stockRegister.getDocNoId());
                docNo.setIsUsed(true);
                stockRegister.setDocNo(docNo);
                docNoRepository.save(docNo);
            } else {
                stockRegister.setDocNo(docNos);
            }
            stockRegister.setExpiryDate(stockRegister.getOldExpiryDate().equals("-") ? null : LocalDate.parse(stockRegister.getOldExpiryDate()));
            stockRegister.setUser(user);
            stockRegister.setLocation(location);
            stockRegister.setEntry(entry);
            stockRegister.setProductRegister(productRegister);

            Double changeQty = stockRegister.getQty();
            if (entry.getEntryType().equals(EntryType.OUT)) {
                changeQty = changeQty * -1L;
            }
            if (stockRegister.getEntryDate() == null) continue;
            //previous stock entry
            List<StockRegister> stockRegisters = stockRegisterRepository.findByDate(stockRegister.getEntryDate(), productRegister.getProductRegisterId(), location.getLocationId());
            StockRegister updatedStockRegister = !stockRegisters.isEmpty() ? stockRegisters.get(stockRegisters.size() - 1) : null;
            if (updatedStockRegister != null) {
                stockRegister.setCurrentQty(updatedStockRegister.getCurrentQty() + changeQty);
            } else {
                stockRegister.setCurrentQty(changeQty);
            }

            StockRegister lastEntry = stockRegisterRepository.findSum(productRegister.getProductRegisterId(), location.getLocationId());
            Double sum = 0.0;
            if (lastEntry != null) sum = lastEntry.getSum();
            sum += changeQty;
            stockRegister.setSum(sum);
            if (sum < 0 || stockRegister.getCurrentQty() < 0) continue;
            stockRegisterRepository.save(stockRegister);

            List<StockRegister> nextStocks = stockRegisterRepository.findNextStock(stockRegister.getEntryDate(), productRegister.getProductRegisterId(), location.getLocationId());
            for (StockRegister register : nextStocks) {
                register.setCurrentQty(register.getCurrentQty() + changeQty);
                register.setSum(register.getSum() + changeQty);
            }

            Inventory inventory = inventoryRepository.findInventory(productRegister.getProductRegisterId(), location.getLocationId());
            if (inventory == null)
                inventory = new Inventory(new InventoryId(productRegister.getProductRegisterId(), location.getLocationId()), productRegister, location, stockRegister.getCurrentQty());
            else if (nextStocks.isEmpty())
                inventory.setQty(stockRegister.getCurrentQty());
            else
                inventory.setQty(nextStocks.get(nextStocks.size() - 1).getCurrentQty());
            inventoryRepository.save(inventory);
            stockRegisterRepository.saveAll(nextStocks);
            id++;
        }
        return "done";
    }

    public ResponseEntity<byte[]> excelStockRegister(Long companyId, Long productTypeId, Long locationId, String search, int pageNumber, int pageSize, String fromDate, String endDate, Long userId) {

        List<StockRegister> page;
        User user = userRepository.findById(userId).get();
        search = search.equals("null") ? null : search.replace("!", "/");
        userId = user.getUserRole().equals(UserRole.ADMIN) ? 0 : userId;

        if (fromDate.equals("null") && endDate.equals("null")) {
            fromDate = null;
            endDate = null;
            page = stockRegisterRepository.filterProductsExcel(companyId, locationId, productTypeId, search, null, null, userId);
        } else {
            page = stockRegisterRepository.filterProductsExcel(companyId, locationId, productTypeId, search, LocalDate.parse(fromDate), LocalDate.parse(endDate), userId);
        }
        Map<String, Object> hashMap = new HashMap<>();
        hashMap.put("data", page);
        hashMap.put("count", page);
        try (Workbook workbook = new XSSFWorkbook()) {
            Sheet sheet = workbook.createSheet("Data");

            // Create a header row
            Row headerRow = sheet.createRow(0);
            headerRow.createCell(0).setCellValue("Date");
            headerRow.createCell(1).setCellValue("Doc. No");
            headerRow.createCell(2).setCellValue("Location");
            headerRow.createCell(3).setCellValue("Product Category");
            headerRow.createCell(4).setCellValue("Reference");
            headerRow.createCell(5).setCellValue("Focus Code");
            headerRow.createCell(6).setCellValue("Sage Code");
            headerRow.createCell(7).setCellValue("Product");
            headerRow.createCell(8).setCellValue("Entry Type");
            headerRow.createCell(9).setCellValue("Batch / Lot No.");
            headerRow.createCell(10).setCellValue("IN");
            headerRow.createCell(11).setCellValue("OUT");
            headerRow.createCell(12).setCellValue("Expiry Date");
            // Add more columns as needed

            // Add data rows
            int rowNum = 1;
            for (StockRegister data : (List<StockRegister>) hashMap.get("data")) {
                Row row = sheet.createRow(rowNum++);
                row.createCell(0).setCellValue(data.getEntryDate().toString());
                row.createCell(1).setCellValue(data.getDocNo().getDocNo());
                row.createCell(2).setCellValue(data.getLocation().getLocationCode() + "-"+data.getLocation().getLocationName() + "-" +data.getLocation().getLocationDescription());
                row.createCell(3).setCellValue(data.getProductRegister().getProductCategory().getProductCategoryName());
                row.createCell(4).setCellValue(data.getSageReference());
                row.createCell(5).setCellValue(data.getProductRegister().getFocusCode());
                row.createCell(6).setCellValue(data.getProductRegister().getSageCode());
                row.createCell(7).setCellValue(data.getProductRegister().getDescription());
                row.createCell(8).setCellValue(data.getEntry().getEntryType().name());
                row.createCell(9).setCellValue(data.getBatchNo());
                if(data.getEntry().getEntryType().equals(EntryType.IN)) {
                    row.createCell(10).setCellValue(data.getQty());
                    row.createCell(11).setCellValue("0");
                } else {
                    row.createCell(11).setCellValue(data.getQty());
                    row.createCell(10).setCellValue("0");
                }
                row.createCell(12).setCellValue(data.getExpiryDate().toString());
                // Add more columns as needed
            }

            // Write the workbook content to a ByteArrayOutputStream
            ByteArrayOutputStream outputStream = new ByteArrayOutputStream();
            workbook.write(outputStream);

            // Set the response headers
            HttpHeaders headers = new HttpHeaders();
            headers.setContentType(MediaType.APPLICATION_OCTET_STREAM);
            headers.setContentDispositionFormData("attachment", "data.xlsx");

            return ResponseEntity.ok()
                    .headers(headers)
                    .body(outputStream.toByteArray());
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
    }

    public ResponseEntity<byte[]> downloadStockReport(Long companyId, Long productTypeId, Long locationId, Long productCategoryId, String brandName, String search, int pageNumber, int pageSize) {

        search = search.equals("null") ? null : search.replace("!", "/");
        brandName = brandName.equals("null") ? null : brandName.replace("!", "/");
        List<StockReportDTO> page = stockRegisterRepository.getStockExcel(companyId, productTypeId, locationId, productCategoryId, brandName, search);
        try (Workbook workbook = new XSSFWorkbook()) {
            Sheet sheet = workbook.createSheet("Data");

            // Create a header row
            Row headerRow = sheet.createRow(0);
            headerRow.createCell(0).setCellValue("Location");
            headerRow.createCell(1).setCellValue("Focus Code");
            headerRow.createCell(2).setCellValue("Sage Code");
            headerRow.createCell(3).setCellValue("Product");
            headerRow.createCell(4).setCellValue("IN");
            headerRow.createCell(5).setCellValue("OUT");
            headerRow.createCell(6).setCellValue("Lock Qty");
            headerRow.createCell(7).setCellValue("Avail Stock");
            headerRow.createCell(8).setCellValue("Re-order Level Qty");
            headerRow.createCell(9).setCellValue("Re-order Request");
            int rowNum = 1;
            for (StockReportDTO data : page) {
                Row row = sheet.createRow(rowNum++);
                row.createCell(0).setCellValue(data.getLocation());
                row.createCell(1).setCellValue(data.getFocusCode());
                row.createCell(2).setCellValue(data.getSageCode());
                row.createCell(3).setCellValue(data.getProductDescription());
                row.createCell(4).setCellValue(data.getInQty());
                row.createCell(5).setCellValue(data.getOutQty());
                row.createCell(6).setCellValue("0");
                row.createCell(7).setCellValue(data.getInQty() - data.getOutQty());
                row.createCell(8).setCellValue(data.getReorderLevel());
                if((data.getInQty()-data.getOutQty()) < data.getReorderLevel()) {
                    row.createCell(9).setCellValue("YES");
                } else {
                    row.createCell(9).setCellValue("NO");
                }
                // Add more columns as needed
            }

            // Write the workbook content to a ByteArrayOutputStream
            ByteArrayOutputStream outputStream = new ByteArrayOutputStream();
            workbook.write(outputStream);

            // Set the response headers
            HttpHeaders headers = new HttpHeaders();
            headers.setContentType(MediaType.APPLICATION_OCTET_STREAM);
            headers.setContentDispositionFormData("attachment", "data.xlsx");

            return ResponseEntity.ok()
                    .headers(headers)
                    .body(outputStream.toByteArray());
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
    }

    public ResponseEntity<byte[]> downloadReport(Long companyId, Long productTypeId, Long locationId, Long productCategoryId, String batchNo, String search, int pageNumber, int pageSize) {

        search = search.equals("null") ? null : search.replace("!", "/");
        batchNo = batchNo.equals("null") ? null : batchNo.replace("!", "/");
        List<StockReportBatchDTO> page = stockRegisterRepository.getBatchExcel(companyId, productTypeId, locationId, productCategoryId, batchNo, search);
        try (Workbook workbook = new XSSFWorkbook()) {
            Sheet sheet = workbook.createSheet("Data");

            // Create a header row
            Row headerRow = sheet.createRow(0);
            headerRow.createCell(0).setCellValue("Location");
            headerRow.createCell(1).setCellValue("Focus Code");
            headerRow.createCell(2).setCellValue("Sage Code");
            headerRow.createCell(3).setCellValue("Product");
            headerRow.createCell(4).setCellValue("Batch/Lot No.");
            headerRow.createCell(5).setCellValue("IN");
            headerRow.createCell(6).setCellValue("OUT");
            headerRow.createCell(7).setCellValue("Lock Qty");
            headerRow.createCell(8).setCellValue("Avail Stock");
            headerRow.createCell(9).setCellValue("Re-order Level Qty");
            headerRow.createCell(10).setCellValue("Re-order Request");
            int rowNum = 1;
            for (StockReportBatchDTO data : page) {
                Row row = sheet.createRow(rowNum++);
                row.createCell(0).setCellValue(data.getLocation());
                row.createCell(1).setCellValue(data.getFocusCode());
                row.createCell(2).setCellValue(data.getSageCode());
                row.createCell(3).setCellValue(data.getDescription());
                row.createCell(4).setCellValue(data.getBatchNo());
                row.createCell(5).setCellValue(data.getInQty());
                row.createCell(6).setCellValue(data.getOutQty());
                row.createCell(7).setCellValue("0");
                row.createCell(8).setCellValue(data.getInQty() - data.getOutQty());
                row.createCell(9).setCellValue(data.getReorderLevelQty());
                if((data.getInQty()-data.getOutQty()) < data.getReorderLevelQty()) {
                    row.createCell(10).setCellValue("YES");
                } else {
                    row.createCell(10).setCellValue("NO");
                }
                // Add more columns as needed
            }

            // Write the workbook content to a ByteArrayOutputStream
            ByteArrayOutputStream outputStream = new ByteArrayOutputStream();
            workbook.write(outputStream);

            // Set the response headers
            HttpHeaders headers = new HttpHeaders();
            headers.setContentType(MediaType.APPLICATION_OCTET_STREAM);
            headers.setContentDispositionFormData("attachment", "data.xlsx");

            return ResponseEntity.ok()
                    .headers(headers)
                    .body(outputStream.toByteArray());
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
    }

    public ResponseEntity<byte[]> downloadReorderReport(Long companyId, Long productTypeId, Long locationId, Long productCategoryId, String brandName, String search, int pageNumber, int pageSize) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        search = search.equals("null") ? null : search.replace("!", "/");
        brandName = brandName.equals("null") ? null : brandName.replace("!", "/");
        List<StockReportDTO> page = stockRegisterRepository.getStockExcel(companyId, productTypeId, locationId, productCategoryId, brandName, search);
        try (Workbook workbook = new XSSFWorkbook()) {
            Sheet sheet = workbook.createSheet("Data");

            // Create a header row
            Row headerRow = sheet.createRow(0);
            headerRow.createCell(0).setCellValue("Location");
            headerRow.createCell(1).setCellValue("Focus Code");
            headerRow.createCell(2).setCellValue("Sage Code");
            headerRow.createCell(3).setCellValue("Product");
            headerRow.createCell(4).setCellValue("IN");
            headerRow.createCell(5).setCellValue("OUT");
            headerRow.createCell(6).setCellValue("Lock Qty");
            headerRow.createCell(7).setCellValue("Avail Stock");
            headerRow.createCell(8).setCellValue("Re-order Level Qty");
            headerRow.createCell(9).setCellValue("Re-order Request");
            int rowNum = 1;
            for (StockReportDTO data : page) {
                if((data.getInQty()-data.getOutQty()) > data.getReorderLevel()) continue;
                Row row = sheet.createRow(rowNum++);
                row.createCell(0).setCellValue(data.getLocation());
                row.createCell(1).setCellValue(data.getFocusCode());
                row.createCell(2).setCellValue(data.getSageCode());
                row.createCell(3).setCellValue(data.getProductDescription());
                row.createCell(4).setCellValue(data.getInQty());
                row.createCell(5).setCellValue(data.getOutQty());
                row.createCell(6).setCellValue("0");
                row.createCell(7).setCellValue((data.getInQty() - data.getOutQty()) < 0 ? 0 : (data.getInQty() - data.getOutQty()));
                row.createCell(8).setCellValue(data.getReorderLevel());
                if((data.getInQty()-data.getOutQty()) < data.getReorderLevel()) {
                    row.createCell(9).setCellValue("YES");
                } else {
                    row.createCell(9).setCellValue("NO");
                }
                // Add more columns as needed
            }

            // Write the workbook content to a ByteArrayOutputStream
            ByteArrayOutputStream outputStream = new ByteArrayOutputStream();
            workbook.write(outputStream);

            // Set the response headers
            HttpHeaders headers = new HttpHeaders();
            headers.setContentType(MediaType.APPLICATION_OCTET_STREAM);
            headers.setContentDispositionFormData("attachment", "data.xlsx");

            return ResponseEntity.ok()
                    .headers(headers)
                    .body(outputStream.toByteArray());
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
    }

    public ResponseEntity<byte[]> downloadOFSReport(Long companyId, Long productTypeId, Long locationId, Long productCategoryId, String brandName, String search, int pageNumber, int pageSize) {

        search = search.equals("null") ? null : search.replace("!", "/");
        brandName = brandName.equals("null") ? null : brandName.replace("!", "/");
        List<OFSReportDTO> page = stockRegisterRepository.getOFSExcel(companyId, productTypeId, locationId, productCategoryId, brandName, search);
        try (Workbook workbook = new XSSFWorkbook()) {
            Sheet sheet = workbook.createSheet("Data");

            // Create a header row
            Row headerRow = sheet.createRow(0);
            headerRow.createCell(0).setCellValue("Date");
            headerRow.createCell(1).setCellValue("Location");
            headerRow.createCell(2).setCellValue("Focus Code");
            headerRow.createCell(3).setCellValue("Sage Code");
            headerRow.createCell(4).setCellValue("Product");
            headerRow.createCell(5).setCellValue("Batch No");
            headerRow.createCell(6).setCellValue("Qty");
            headerRow.createCell(7).setCellValue("Expiry Date");
            int rowNum = 1;
            for (OFSReportDTO data : page) {
                Row row = sheet.createRow(rowNum++);
                row.createCell(0).setCellValue(data.getEntryDate().toString());
                row.createCell(1).setCellValue(data.getLocation());
                row.createCell(2).setCellValue(data.getFocusCode());
                row.createCell(3).setCellValue(data.getSageCode());
                row.createCell(4).setCellValue(data.getDescription());
                row.createCell(5).setCellValue(data.getBatchNo());
                row.createCell(6).setCellValue(data.getQty());
                if(data.getExpiryDate() == null)
                    row.createCell(7).setCellValue("");
                else
                    row.createCell(7).setCellValue(data.getExpiryDate().toString());
                // Add more columns as needed
            }

            // Write the workbook content to a ByteArrayOutputStream
            ByteArrayOutputStream outputStream = new ByteArrayOutputStream();
            workbook.write(outputStream);

            // Set the response headers
            HttpHeaders headers = new HttpHeaders();
            headers.setContentType(MediaType.APPLICATION_OCTET_STREAM);
            headers.setContentDispositionFormData("attachment", "data.xlsx");

            return ResponseEntity.ok()
                    .headers(headers)
                    .body(outputStream.toByteArray());
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
    }

    public ResponseEntity<byte[]> downloadInOutReport(Long companyId, Long productTypeId, Long locationId, String search, int pageNumber, int pageSize, String fromDate, String endDate) {

        search = search.equals("null") ? null : search.replace("!", "/");
        LocalDate from = fromDate.equals("null") ? null : LocalDate.parse(fromDate);
        LocalDate to = endDate.equals("null") ? null : LocalDate.parse(endDate);
        List<InOutReportDTO> page = stockRegisterRepository.inOutReportExcel(companyId, locationId, productTypeId, search, from, to);

        try (Workbook workbook = new XSSFWorkbook()) {
            Sheet sheet = workbook.createSheet("Data");

            // Create a header row
            Row headerRow = sheet.createRow(0);
            headerRow.createCell(0).setCellValue("Location");
            headerRow.createCell(1).setCellValue("Product Type");
            headerRow.createCell(2).setCellValue("Focus Code");
            headerRow.createCell(3).setCellValue("Sage Code");
            headerRow.createCell(4).setCellValue("Product");
            headerRow.createCell(5).setCellValue("Opening Stock");
            headerRow.createCell(6).setCellValue("IN");
            headerRow.createCell(7).setCellValue("OUT");
            headerRow.createCell(8).setCellValue("Closing Stock");
            int rowNum = 1;
            for(InOutReportDTO inOutReportDTO : page) {
                LocalDate date = from == null ? null : from.minusDays(1);
                ProductRegister productRegister = productRegisterRepository.findBySageCode(inOutReportDTO.getSageCode());
                Long productRegisterId = productRegister.getProductRegisterId();
                Pageable pageable1 = PageRequest.of(0,1);
                Page<StockRegister> prevStockRegisters = stockRegisterRepository.findStockByDate(productRegisterId, date, pageable1);
                Page<StockRegister> stockRegisters = stockRegisterRepository.findStockByDate(productRegisterId, to, pageable1);
                Double openingStock = 0.0;
                if (!prevStockRegisters.getContent().isEmpty() && date != null)
                    openingStock = prevStockRegisters.getContent().get(0).getCurrentQty();
                inOutReportDTO.setOpeningStock(openingStock);
                Double closingStock = 0.0;
                if (!stockRegisters.getContent().isEmpty()) closingStock = stockRegisters.getContent().get(0).getCurrentQty();
                inOutReportDTO.setClosingStock(closingStock);
                inOutReportDTO.setFocusCode(productRegister.getFocusCode());
                inOutReportDTO.setDescription(productRegister.getDescription());

                Row row = sheet.createRow(rowNum++);
                row.createCell(0).setCellValue(inOutReportDTO.getLocation());
                row.createCell(1).setCellValue(inOutReportDTO.getProductTypeName());
                row.createCell(2).setCellValue(inOutReportDTO.getFocusCode());
                row.createCell(3).setCellValue(inOutReportDTO.getSageCode());
                row.createCell(4).setCellValue(inOutReportDTO.getDescription());
                row.createCell(5).setCellValue(inOutReportDTO.getOpeningStock());
                row.createCell(6).setCellValue(inOutReportDTO.getIn());
                row.createCell(7).setCellValue(inOutReportDTO.getOut());
                row.createCell(8).setCellValue(inOutReportDTO.getClosingStock());
            }

            // Write the workbook content to a ByteArrayOutputStream
            ByteArrayOutputStream outputStream = new ByteArrayOutputStream();
            workbook.write(outputStream);

            // Set the response headers
            HttpHeaders headers = new HttpHeaders();
            headers.setContentType(MediaType.APPLICATION_OCTET_STREAM);
            headers.setContentDispositionFormData("attachment", "data.xlsx");

            return ResponseEntity.ok()
                    .headers(headers)
                    .body(outputStream.toByteArray());
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
    }

    public ResponseEntity<Map<String, Object>> getFastMovingReport(Long companyId, Long productTypeId, Long locationId, String search, int pageNumber, int pageSize, String fromDate, String endDate) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        search = search.equals("null") ? null : search.replace("!", "/");
        LocalDate from = fromDate.equals("null") ? null : LocalDate.parse(fromDate);
        LocalDate to = endDate.equals("null") ? null : LocalDate.parse(endDate);
        Page<FastMovingDTO> page = stockRegisterRepository.fastMoving(companyId, locationId, productTypeId, search, from, to, pageable);
        Map<String, Object> map = new HashMap<>();
        map.put("data", page.getContent());
        map.put("count", page.getTotalElements());
        return ResponseEntity.ok(map);
    }

    public ResponseEntity<Map<String, Object>> getNonMovingReport(Long companyId, Long productTypeId, Long locationId, String search, int pageNumber, int pageSize, String fromDate, String endDate) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        search = search.equals("null") ? null : search.replace("!", "/");
        LocalDate from = fromDate.equals("null") ? null : LocalDate.parse(fromDate);
        LocalDate to = endDate.equals("null") ? null : LocalDate.parse(endDate);
        Page<FastMovingDTO> page = stockRegisterRepository.nonMoving(companyId, locationId, productTypeId, search, pageable);
        Map<String, Object> map = new HashMap<>();
        map.put("data", page.getContent());
        map.put("count", page.getTotalElements());
        return ResponseEntity.ok(map);
    }

    public ResponseEntity<List<TotalQtyByMonthDTO>> getGraph(Long productTypeId, EntryType entryType) {

        LocalDate startDate = LocalDate.now().minusMonths(5);
        return ResponseEntity.ok(stockRegisterRepository.findTotalQtyByMonthAndProductTypeAndEntryId(productTypeId, entryType, startDate));
    }

    public ResponseEntity<String> getExpiry() {

        LocalDate startDate = LocalDate.now().minusMonths(3);
        List<Long> list = stockRegisterRepository.getExpiry(startDate);

        return ResponseEntity.ok(list.size()+"");
    }

    public ResponseEntity<Map<String, Object>> getInventoryRegister(Long companyId, Long productTypeId, Long locationId, String search, int pageNumber, int pageSize, String fromDate, String endDate, Long userId) {
        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        Page<StockRegisterDTO> page;
        User user = userRepository.findById(userId).get();
        search = search.equals("null") ? null : search.replace("!", "/");
        userId = user.getUserRole().equals(UserRole.ADMIN) ? 0 : userId;

        if (fromDate.equals("null") && endDate.equals("null")) {
            fromDate = null;
            endDate = null;
            page = stockRegisterRepository.getInventoryRegister(companyId, locationId, productTypeId, search, null, null, userId, pageable);
        } else {
            page = stockRegisterRepository.getInventoryRegister(companyId, locationId, productTypeId, search, LocalDate.parse(fromDate), LocalDate.parse(endDate), userId, pageable);
        }
        Map<String, Object> hashMap = new HashMap<>();
        hashMap.put("data", page.getContent());
        hashMap.put("count", page.getTotalElements());
        return ResponseEntity.ok(hashMap);
    }
}
