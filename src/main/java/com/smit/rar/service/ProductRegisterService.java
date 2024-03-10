package com.smit.rar.service;

import com.smit.rar.dao.ProductRegisterDAO;
import com.smit.rar.model.*;
import com.smit.rar.repository.*;
import lombok.AllArgsConstructor;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

@Service
@AllArgsConstructor
public class ProductRegisterService {

    private final ProductRegisterRepository productRegisterRepository;
    private final CompanyRepository companyRepository;
    private final UOMRepository uomRepository;
    private final ProductTypeRepository productTypeRepository;
    private final ProductCategoryRepository productCategoryRepository;
    private final UserRepository userRepository;

    public ResponseEntity<ProductRegister> addProductRegister(ProductRegister productRegister, Long companyId, Long uomId, Long productTypeId, Long productCategoryId, Long userId) {

        if(productRegister.getProductRegisterId() == null) {
            ProductRegister prevProductRegister = productRegisterRepository.findTopByOrderByProductRegisterIdDesc();
            productRegister.setProductRegisterId(prevProductRegister.getProductRegisterId()+1L);
        }
        Company company = companyRepository.getById(companyId);
        UOM uom = uomRepository.getById(uomId);
        ProductType productType = productTypeRepository.getById(productTypeId);
        ProductCategory productCategory = productCategoryRepository.getById(productCategoryId);
        productRegister.setCompany(company);
        productRegister.setUom(uom);
        productRegister.setProductType(productType);
        productRegister.setProductCategory(productCategory);
        productRegister.setEntryDate(LocalDate.now());
        productRegister.setUser(userRepository.findById(userId).get());
        productRegisterRepository.save(productRegister);
        return ResponseEntity.ok(productRegister);
    }

    public ResponseEntity<Map<String, Object>> getProductRegister(Long companyId, Long productCategoryId, Long productTypeId, String search, int pageNumber, int pageSize) {

        Map<String, Object> map = new HashMap<>();
        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        search = search.equals("null") ? null : search.replace("!", "/");
        Page<ProductRegister> page = productRegisterRepository.getProductRegister(companyId, productCategoryId, productTypeId, search, pageable);
        map.put("data", page.getContent());
        map.put("pages", page.getTotalPages());
        map.put("count", page.getTotalElements());
        System.out.println(page.getTotalElements());
        return ResponseEntity.ok(map);
    }

    public ResponseEntity<ProductRegister> deleteProductRegister(Long productRegisterId, Long userId) {

        ProductRegister productRegister = productRegisterRepository.getById(productRegisterId);
        productRegister.setIsDeleted(true);
        productRegister.setUser(userRepository.findById(userId).get());
        productRegisterRepository.save(productRegister);
        return ResponseEntity.ok(productRegister);
    }

    public String addAllProducts(ProductRegisterDAO productRegisterDAO) {
        ProductRegister prevProductRegister = productRegisterRepository.findTopByOrderByProductRegisterIdDesc();
        Long index = prevProductRegister.getProductRegisterId()+1L;
        for(ProductRegister productRegister : productRegisterDAO.getProducts()) {
            productRegister.setProductRegisterId(index);
            if(productRegister.getEntryDate() == null) productRegister.setEntryDate(LocalDate.now());
            productRegister.setCompany(companyRepository.findById(productRegister.getCompanyId()).get());
            productRegister.setUom(uomRepository.findById(productRegister.getUomId()).get());
            productRegister.setProductCategory(productCategoryRepository.findById(productRegister.getProductCategoryId()).get());
            productRegister.setProductType(productTypeRepository.findById(2L).get());
            productRegister.setUser(userRepository.findById(productRegister.getUserId()).get());
            index++;
        }
        productRegisterRepository.saveAll(productRegisterDAO.getProducts());
        return "done";
    }

    public ResponseEntity<String> changeProductRegister(ProductRegisterDAO productRegisterDAO) {
        int index = 1;
        for(ProductRegister productRegister : productRegisterDAO.getProducts()) {
            String sageCode = productRegister.getSageCode();
            String focusCode = productRegister.getFocusCode();
            String search = sageCode.replace("/","-");
            ProductRegister existingProduct = productRegisterRepository.findBySageCode(search);
            if(existingProduct == null) continue;
            existingProduct.setSageCode(sageCode);
            existingProduct.setFocusCode(focusCode);
            productRegisterRepository.save(existingProduct);
            System.out.println(index++);
        }
        return ResponseEntity.ok("done");
    }
}
