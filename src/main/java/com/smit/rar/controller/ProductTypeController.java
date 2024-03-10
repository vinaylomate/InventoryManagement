package com.smit.rar.controller;

import com.smit.rar.model.Location;
import com.smit.rar.model.ProductType;
import com.smit.rar.service.ProductTypeService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Map;

@RestController
@AllArgsConstructor
public class ProductTypeController {

    private final ProductTypeService productTypeService;

    @PostMapping("/manage/add/productType")
    private ResponseEntity<ProductType> addProductType(@RequestBody ProductType productType) {
        return productTypeService.addProductType(productType);
    }
}
