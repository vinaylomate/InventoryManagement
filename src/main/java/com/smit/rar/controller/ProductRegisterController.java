package com.smit.rar.controller;

import com.smit.rar.dao.ProductRegisterDAO;
import com.smit.rar.model.ProductRegister;
import com.smit.rar.service.ProductRegisterService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.io.UnsupportedEncodingException;
import java.net.URLDecoder;
import java.nio.charset.StandardCharsets;
import java.util.Map;

@RestController
@AllArgsConstructor
public class ProductRegisterController {

    private final ProductRegisterService productRegisterService;

    @PostMapping("/manage/add/productRegister/{companyId}/{uomId}/{productTypeId}/{productCategoryId}/{userId}")
    private ResponseEntity<ProductRegister> addProductRegister(@RequestBody ProductRegister productRegister,
                                                               @PathVariable(name = "companyId") Long companyId,
                                                               @PathVariable(name = "uomId") Long uomId,
                                                               @PathVariable(name = "productTypeId") Long productTypeId,
                                                               @PathVariable(name = "productCategoryId") Long productCategoryId,
                                                               @PathVariable(name = "userId") Long userId) {
        return productRegisterService.addProductRegister(productRegister, companyId, uomId, productTypeId, productCategoryId, userId);
    }

    @PostMapping("/manage/addAll/productRegister")
    private String addAllProducts(@RequestBody ProductRegisterDAO productRegisterDAO) {
        return productRegisterService.addAllProducts(productRegisterDAO);
    }

    @DeleteMapping("/manage/delete/productRegister/{productRegisterId}/{userId}")
    private ResponseEntity<ProductRegister> deleteProductRegister(@PathVariable(name = "productRegisterId") Long productRegisterId,
                                                                  @PathVariable(name = "userId") Long userId) {
        return productRegisterService.deleteProductRegister(productRegisterId, userId);
    }

    @GetMapping("/manage/get/productRegister/{companyId}/{productTypeId}/{productCategoryId}/{search:.+}/{pageNumber}/{pageSize}")
    private ResponseEntity<Map<String,Object>> getProductRegister(@PathVariable(name = "companyId") Long companyId,
                                                                  @PathVariable(name = "productTypeId") Long productTypeId,
                                                                  @PathVariable(name = "productCategoryId") Long productCategoryId,
                                                                  @PathVariable(name = "search") String search,
                                                                  @PathVariable(name = "pageNumber") int pageNumber,
                                                                  @PathVariable(name = "pageSize") int pageSize) {
        return productRegisterService.getProductRegister(companyId, productCategoryId, productTypeId, search, pageNumber, pageSize);
    }

    @PostMapping("/manage/change/productRegister")
    private ResponseEntity<String> changeProductRegister(@RequestBody ProductRegisterDAO productRegisterDAO) {
        return productRegisterService.changeProductRegister(productRegisterDAO);
    }
}
