package com.smit.rar.service;

import com.smit.rar.model.Company;
import com.smit.rar.model.Location;
import com.smit.rar.model.ProductType;
import com.smit.rar.repository.ProductTypeRepository;
import lombok.AllArgsConstructor;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@AllArgsConstructor
public class ProductTypeService {

    private final ProductTypeRepository productTypeRepository;

    public ResponseEntity<ProductType> addProductType(ProductType productType) {

        if(productType.getProductTypeId() == null) {
            List<ProductType> prevProductType = productTypeRepository.findTopByOrderByProductTypeIdDesc();
            productType.setProductTypeId(prevProductType.isEmpty() ? 1L : prevProductType.get(0).getProductTypeId()+1L);
        }
        productTypeRepository.save(productType);
        return ResponseEntity.ok(productType);
    }
}
