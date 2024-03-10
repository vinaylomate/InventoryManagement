package com.smit.rar.controller;

import com.smit.rar.dao.ProductCategoryDAO;
import com.smit.rar.model.ProductCategory;
import com.smit.rar.model.ProductType;
import com.smit.rar.service.ProductCategoryService;
import com.smit.rar.service.ProductTypeService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@AllArgsConstructor
public class ProductCategoryController {

    private final ProductCategoryService productCategoryService;

    @PostMapping("/manage/add/productCategory/{productTypeId}/{userId}")
    private ResponseEntity<ProductCategory> addProductCategory(@RequestBody ProductCategory productCategory,
                                                               @PathVariable(name = "productTypeId") Long productTypeId,
                                                               @PathVariable(name = "userId") Long userId) {
        return productCategoryService.addProductCategory(productCategory, productTypeId, userId);
    }

    @PostMapping("/manage/addAll/productCategory")
    private String addAllProductCategory(@RequestBody ProductCategoryDAO productCategoryDAO) {
        return productCategoryService.addAllProductCategory(productCategoryDAO);
    }

    @DeleteMapping("/manage/delete/productCategory/{productCategoryId}/{userId}")
    private ResponseEntity<ProductCategory> deleteProductCategory(@PathVariable(name = "productCategoryId") Long productCategoryId,
                                                                  @PathVariable(name = "userId") Long userId) {
        return productCategoryService.deleteProductCategory(productCategoryId, userId);
    }

    @GetMapping("/manage/get/productCategory/{pageNumber}/{pageSize}")
    private ResponseEntity<List<ProductCategory>> getProductCategory(@PathVariable(name = "pageNumber") int pageNumber,
                                                                     @PathVariable(name = "pageSize") int pageSize) {
        return productCategoryService.getProductCategory(pageNumber, pageSize);
    }

    @GetMapping("/manage/get/productCategory/{productTypeId}")
    private ResponseEntity<List<ProductCategory>> getProductCategoryByType(@PathVariable(name = "productTypeId") Long productTypeId) {
        return productCategoryService.getProductCategoryByType(productTypeId);
    }
}
