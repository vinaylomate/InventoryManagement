package com.smit.rar.controller;

import com.smit.rar.dao.StockRegisterDAO;
import com.smit.rar.dto.*;
import com.smit.rar.model.EntryType;
import com.smit.rar.model.StockRegister;
import com.smit.rar.service.StockRegisterService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.io.IOException;
import java.util.List;
import java.util.Map;

@RestController
@AllArgsConstructor
public class StockRegisterController {

    private final StockRegisterService stockRegisterService;

    @PostMapping("/manage/add/stockRegister/{locationId}/{entryId}/{productRegisterId}/{docNo}/{userId}")
    private ResponseEntity<StockRegister> addStockRegister(@RequestBody StockRegister stockRegister,
                                                           @PathVariable(name = "locationId") Long locationId,
                                                           @PathVariable(name = "entryId") Long entryId,
                                                           @PathVariable(name = "productRegisterId") Long productRegisterId,
                                                           @PathVariable(name = "docNo") String docNo,
                                                           @PathVariable(name = "userId") Long userId) {
        return stockRegisterService.addStockRegister(stockRegister, locationId, entryId, productRegisterId, docNo, userId);
    }

    @PostMapping("/manage/addAll/stockRegister")
    private String addAllStockEntry(@RequestBody StockRegisterDAO stockRegisterDAO) {
        return stockRegisterService.addAllStockEntry(stockRegisterDAO);
    }

    @DeleteMapping("/manage/delete/stockRegister/{docNo}/{userId}")
    private ResponseEntity<List<StockRegister>> deleteStockRegister(@PathVariable(name = "docNo") String docNo,
                                                                    @PathVariable(name = "userId") Long userId) {
        return stockRegisterService.deleteStockRegister(docNo, userId);
    }

    @GetMapping("/manage/view/stockRegister/{docNo}/{userId}")
    private ResponseEntity<List<StockRegister>> getView(@PathVariable(name = "docNo") String docNo,
                                                        @PathVariable(name = "userId") Long userId) {
        return stockRegisterService.getView(docNo, userId);
    }

    //TODO
    @GetMapping("/manage/viewInOut/stockRegister/{locationCode}/{sageCode}/{fromDate}/{endDate}")
    private ResponseEntity<List<StockRegister>> getViewInOut(@PathVariable(name = "locationCode") String locationCode,
                                                             @PathVariable(name = "sageCode") String sageCode,
                                                             @PathVariable(name = "fromDate") String fromDate,
                                                             @PathVariable(name = "endDate") String endDate) {
        return stockRegisterService.getViewInOut(locationCode, sageCode, fromDate, endDate);
    }

    //TODO
    @GetMapping("/manage/inOutReport/stockRegister/{companyId}/{productTypeId}/{locationId}/{search}/{pageNumber}/{pageSize}/{fromDate}/{endDate}")
    private ResponseEntity<Map<String, Object>> getInOutReport(@PathVariable(name = "companyId") Long companyId,
                                                       @PathVariable(name = "productTypeId") Long productTypeId,
                                                       @PathVariable(name = "locationId") Long locationId,
                                                       @PathVariable(name = "search") String search,
                                                       @PathVariable(name = "pageNumber") int pageNumber,
                                                       @PathVariable(name = "pageSize") int pageSize,
                                                       @PathVariable(name = "fromDate") String fromDate,
                                                       @PathVariable(name = "endDate") String endDate) {
        return stockRegisterService.getInOutReport(companyId, productTypeId, locationId, search, pageNumber, pageSize, fromDate, endDate);
    }

    @GetMapping("/manage/get/stockRegister/{locationId}/{productRegisterId}/{userId}")
    private ResponseEntity<List<BatchNoDTO>> getBatchNo(@PathVariable(name = "locationId") Long locationId,
                                                           @PathVariable(name = "productRegisterId") Long productRegisterId,
                                                           @PathVariable(name = "userId") Long userId) {
        return stockRegisterService.getBatchNo(locationId, productRegisterId, userId);
    }

    //TODO
    @GetMapping("/manage/get/stockRegister/{companyId}/{productTypeId}/{locationId}/{search}/{pageNumber}/{pageSize}/{fromDate}/{endDate}/{userId}")
    private ResponseEntity<Map<String, Object>> getStockRegister(@PathVariable(name = "companyId") Long companyId,
                                                                 @PathVariable(name = "productTypeId") Long productTypeId,
                                                                 @PathVariable(name = "locationId") Long locationId,
                                                                 @PathVariable(name = "search") String search,
                                                                 @PathVariable(name = "pageNumber") int pageNumber,
                                                                 @PathVariable(name = "pageSize") int pageSize,
                                                                 @PathVariable(name = "fromDate") String fromDate,
                                                                 @PathVariable(name = "endDate") String endDate,
                                                                 @PathVariable(name = "userId") Long userId) {
        return stockRegisterService.getStockRegister(companyId, productTypeId, locationId, search, pageNumber, pageSize, fromDate, endDate, userId);
    }

    @GetMapping("/manage/get/inventoryRegister/{companyId}/{productTypeId}/{locationId}/{search}/{pageNumber}/{pageSize}/{fromDate}/{endDate}/{userId}")
    private ResponseEntity<Map<String, Object>> getInventoryRegister(@PathVariable(name = "companyId") Long companyId,
                                                                 @PathVariable(name = "productTypeId") Long productTypeId,
                                                                 @PathVariable(name = "locationId") Long locationId,
                                                                 @PathVariable(name = "search") String search,
                                                                 @PathVariable(name = "pageNumber") int pageNumber,
                                                                 @PathVariable(name = "pageSize") int pageSize,
                                                                 @PathVariable(name = "fromDate") String fromDate,
                                                                 @PathVariable(name = "endDate") String endDate,
                                                                 @PathVariable(name = "userId") Long userId) {
        return stockRegisterService.getInventoryRegister(companyId, productTypeId, locationId, search, pageNumber, pageSize, fromDate, endDate, userId);
    }

    @GetMapping("/manage/report/stockRegister/{companyId}/{productTypeId}/{locationId}/{productCategoryId}/{batchNo}/{search}/{pageNumber}/{pageSize}")
    private ResponseEntity<Map<String, Object>> getReport(@PathVariable(name = "companyId") Long companyId,
                                                                @PathVariable(name = "productTypeId") Long productTypeId,
                                                                @PathVariable(name = "locationId") Long locationId,
                                                                @PathVariable(name = "productCategoryId") Long productCategoryId,
                                                                @PathVariable(name = "batchNo") String batchNo,
                                                                @PathVariable(name = "search") String search,
                                                                @PathVariable(name = "pageNumber") int pageNumber,
                                                                @PathVariable(name = "pageSize") int pageSize) {
        return stockRegisterService.getReport(companyId, productTypeId, locationId, productCategoryId, batchNo, search, pageNumber, pageSize);
    }

    @GetMapping("/manage/OFSReport/stockRegister/{companyId}/{productTypeId}/{locationId}/{productCategoryId}/{batchNo}/{search}/{pageNumber}/{pageSize}")
    private ResponseEntity<Map<String, Object>> getOFSReport(@PathVariable(name = "companyId") Long companyId,
                                                          @PathVariable(name = "productTypeId") Long productTypeId,
                                                          @PathVariable(name = "locationId") Long locationId,
                                                          @PathVariable(name = "productCategoryId") Long productCategoryId,
                                                          @PathVariable(name = "batchNo") String batchNo,
                                                          @PathVariable(name = "search") String search,
                                                          @PathVariable(name = "pageNumber") int pageNumber,
                                                          @PathVariable(name = "pageSize") int pageSize) {
        return stockRegisterService.getOFSReport(companyId, productTypeId, locationId, productCategoryId, batchNo, search, pageNumber, pageSize);
    }

    @GetMapping("/manage/stockReport/stockRegister/{companyId}/{productTypeId}/{locationId}/{productCategoryId}/{brandName}/{search}/{pageNumber}/{pageSize}")
    private ResponseEntity<Map<String, Object>> getStock(@PathVariable(name = "companyId") Long companyId,
                                                          @PathVariable(name = "productTypeId") Long productTypeId,
                                                          @PathVariable(name = "locationId") Long locationId,
                                                          @PathVariable(name = "productCategoryId") Long productCategoryId,
                                                          @PathVariable(name = "brandName") String brandName,
                                                          @PathVariable(name = "search") String search,
                                                          @PathVariable(name = "pageNumber") int pageNumber,
                                                          @PathVariable(name = "pageSize") int pageSize) {
        return stockRegisterService.getStock(companyId, productTypeId, locationId, productCategoryId, brandName, search, pageNumber, pageSize);
    }

    @GetMapping("/manage/get/fastMovingReport/{companyId}/{productTypeId}/{locationId}/{search}/{pageNumber}/{pageSize}/{fromDate}/{endDate}/")
    private ResponseEntity<Map<String, Object>> getFastMovingReport(@PathVariable(name = "companyId") Long companyId,
                                                        @PathVariable(name = "productTypeId") Long productTypeId,
                                                        @PathVariable(name = "locationId") Long locationId,
                                                        @PathVariable(name = "search") String search,
                                                        @PathVariable(name = "pageNumber") int pageNumber,
                                                        @PathVariable(name = "pageSize") int pageSize,
                                                        @PathVariable(name = "fromDate") String fromDate,
                                                        @PathVariable(name = "endDate") String endDate) {
        return stockRegisterService.getFastMovingReport(companyId, productTypeId, locationId, search, pageNumber, pageSize, fromDate, endDate);
    }

    @GetMapping("/manage/get/nonMovingReport/{companyId}/{productTypeId}/{locationId}/{search}/{pageNumber}/{pageSize}/{fromDate}/{endDate}/")
    private ResponseEntity<Map<String, Object>> getNonMovingReport(@PathVariable(name = "companyId") Long companyId,
                                                                    @PathVariable(name = "productTypeId") Long productTypeId,
                                                                    @PathVariable(name = "locationId") Long locationId,
                                                                    @PathVariable(name = "search") String search,
                                                                    @PathVariable(name = "pageNumber") int pageNumber,
                                                                    @PathVariable(name = "pageSize") int pageSize,
                                                                    @PathVariable(name = "fromDate") String fromDate,
                                                                    @PathVariable(name = "endDate") String endDate) {
        return stockRegisterService.getNonMovingReport(companyId, productTypeId, locationId, search, pageNumber, pageSize, fromDate, endDate);
    }

    @GetMapping("/download/excel/stockRegister/{companyId}/{productTypeId}/{locationId}/{search}/{pageNumber}/{pageSize}/{fromDate}/{endDate}/{userId}")
    private ResponseEntity<byte[]> excelStockRegister(@PathVariable(name = "companyId") Long companyId,
                                                      @PathVariable(name = "productTypeId") Long productTypeId,
                                                      @PathVariable(name = "locationId") Long locationId,
                                                      @PathVariable(name = "search") String search,
                                                      @PathVariable(name = "pageNumber") int pageNumber,
                                                      @PathVariable(name = "pageSize") int pageSize,
                                                      @PathVariable(name = "fromDate") String fromDate,
                                                      @PathVariable(name = "endDate") String endDate,
                                                      @PathVariable(name = "userId") Long userId) throws IOException {
        return stockRegisterService.excelStockRegister(companyId, productTypeId, locationId, search, pageNumber, pageSize, fromDate, endDate, userId);
    }

    @GetMapping("/download/stockReport/stockRegister/{companyId}/{productTypeId}/{locationId}/{productCategoryId}/{brandName}/{search}/{pageNumber}/{pageSize}")
    private ResponseEntity<byte[]> downloadStockReport(@PathVariable(name = "companyId") Long companyId,
                                                         @PathVariable(name = "productTypeId") Long productTypeId,
                                                         @PathVariable(name = "locationId") Long locationId,
                                                         @PathVariable(name = "productCategoryId") Long productCategoryId,
                                                         @PathVariable(name = "brandName") String brandName,
                                                         @PathVariable(name = "search") String search,
                                                         @PathVariable(name = "pageNumber") int pageNumber,
                                                         @PathVariable(name = "pageSize") int pageSize) {
        return stockRegisterService.downloadStockReport(companyId, productTypeId, locationId, productCategoryId, brandName, search, pageNumber, pageSize);
    }

    @GetMapping("/download/report/stockRegister/{companyId}/{productTypeId}/{locationId}/{productCategoryId}/{batchNo}/{search}/{pageNumber}/{pageSize}")
    private ResponseEntity<byte[]> downloadReport(@PathVariable(name = "companyId") Long companyId,
                                                          @PathVariable(name = "productTypeId") Long productTypeId,
                                                          @PathVariable(name = "locationId") Long locationId,
                                                          @PathVariable(name = "productCategoryId") Long productCategoryId,
                                                          @PathVariable(name = "batchNo") String batchNo,
                                                          @PathVariable(name = "search") String search,
                                                          @PathVariable(name = "pageNumber") int pageNumber,
                                                          @PathVariable(name = "pageSize") int pageSize) {
        return stockRegisterService.downloadReport(companyId, productTypeId, locationId, productCategoryId, batchNo, search, pageNumber, pageSize);
    }

    @GetMapping("/download/reorder/stockRegister/{companyId}/{productTypeId}/{locationId}/{productCategoryId}/{brandName}/{search}/{pageNumber}/{pageSize}")
    private ResponseEntity<byte[]> downloadReorderReport(@PathVariable(name = "companyId") Long companyId,
                                                       @PathVariable(name = "productTypeId") Long productTypeId,
                                                       @PathVariable(name = "locationId") Long locationId,
                                                       @PathVariable(name = "productCategoryId") Long productCategoryId,
                                                       @PathVariable(name = "brandName") String brandName,
                                                       @PathVariable(name = "search") String search,
                                                       @PathVariable(name = "pageNumber") int pageNumber,
                                                       @PathVariable(name = "pageSize") int pageSize) {
        return stockRegisterService.downloadReorderReport(companyId, productTypeId, locationId, productCategoryId, brandName, search, pageNumber, pageSize);
    }

    @GetMapping("/download/OFSReport/stockRegister/{companyId}/{productTypeId}/{locationId}/{productCategoryId}/{brandName}/{search}/{pageNumber}/{pageSize}")
    private ResponseEntity<byte[]> downloadOFSReport(@PathVariable(name = "companyId") Long companyId,
                                                         @PathVariable(name = "productTypeId") Long productTypeId,
                                                         @PathVariable(name = "locationId") Long locationId,
                                                         @PathVariable(name = "productCategoryId") Long productCategoryId,
                                                         @PathVariable(name = "brandName") String brandName,
                                                         @PathVariable(name = "search") String search,
                                                         @PathVariable(name = "pageNumber") int pageNumber,
                                                         @PathVariable(name = "pageSize") int pageSize) {
        return stockRegisterService.downloadOFSReport(companyId, productTypeId, locationId, productCategoryId, brandName, search, pageNumber, pageSize);
    }

    @GetMapping("/download/inOutReport/stockRegister/{companyId}/{productTypeId}/{locationId}/{search}/{pageNumber}/{pageSize}/{fromDate}/{endDate}")
    private ResponseEntity<byte[]> downloadInOutReport(@PathVariable(name = "companyId") Long companyId,
                                                               @PathVariable(name = "productTypeId") Long productTypeId,
                                                               @PathVariable(name = "locationId") Long locationId,
                                                               @PathVariable(name = "search") String search,
                                                               @PathVariable(name = "pageNumber") int pageNumber,
                                                               @PathVariable(name = "pageSize") int pageSize,
                                                               @PathVariable(name = "fromDate") String fromDate,
                                                               @PathVariable(name = "endDate") String endDate) {
        return stockRegisterService.downloadInOutReport(companyId, productTypeId, locationId, search, pageNumber, pageSize, fromDate, endDate);
    }

    @GetMapping("/get/graph/{productTypeId}/{entryType}")
    private ResponseEntity<List<TotalQtyByMonthDTO>> getGraph(@PathVariable(name = "productTypeId") Long productTypeId,
                                                        @PathVariable(name = "entryType") String entryType) {

        return stockRegisterService.getGraph(productTypeId, EntryType.valueOf(entryType));
    }

    @GetMapping("/manage/get/expiry")
    private ResponseEntity<String> getExpiry() {
        return stockRegisterService.getExpiry();
    }
}
