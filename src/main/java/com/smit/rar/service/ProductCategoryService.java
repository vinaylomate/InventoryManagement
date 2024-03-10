package com.smit.rar.service;

import com.smit.rar.dao.ProductCategoryDAO;
import com.smit.rar.model.ProductCategory;
import com.smit.rar.model.ProductType;
import com.smit.rar.repository.ProductCategoryRepository;
import com.smit.rar.repository.ProductTypeRepository;
import com.smit.rar.repository.UserRepository;
import lombok.AllArgsConstructor;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@AllArgsConstructor
public class ProductCategoryService {

    private final ProductCategoryRepository productCategoryRepository;
    private final ProductTypeRepository productTypeRepository;
    private final UserRepository userRepository;

    public ResponseEntity<ProductCategory> addProductCategory(ProductCategory productCategory, Long productTypeId, Long userId) {

        if(productCategory.getProductCategoryId() == null) {
            List<ProductCategory> prevProductCategory = productCategoryRepository.findTopByOrderByProductCategoryIdDesc();
            productCategory.setProductCategoryId(prevProductCategory.isEmpty() ? 1L : prevProductCategory.get(0).getProductCategoryId()+1L);
        }
        ProductType productType = productTypeRepository.getById(productTypeId);
        productCategory.setProductType(productType);
        productCategory.setUser(userRepository.findById(userId).get());
        productCategoryRepository.save(productCategory);
        return ResponseEntity.ok(productCategory);
    }

    public ResponseEntity<List<ProductCategory>> getProductCategory(int pageNumber, int pageSize) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        Page<ProductCategory> resultPage = productCategoryRepository.findCategory(pageable);

        return ResponseEntity.ok(resultPage.getContent());
    }

    public ResponseEntity<List<ProductCategory>> getProductCategoryByType(Long productTypeId) {

        return ResponseEntity.ok(productCategoryRepository.getProductCategoryByType(productTypeId));
    }

    public ResponseEntity<ProductCategory> deleteProductCategory(Long productCategoryId, Long userId) {

        ProductCategory productCategory = productCategoryRepository.getById(productCategoryId);
        productCategory.setIsDeleted(true);
        productCategory.setUser(userRepository.findById(userId).get());
        productCategoryRepository.save(productCategory);
        return ResponseEntity.ok(productCategory);
    }

    public String addAllProductCategory(ProductCategoryDAO productCategoryDAO) {

        for(ProductCategory productCategory : productCategoryDAO.getProductCategories()) {
            productCategory.setProductType(productTypeRepository.findById(productCategory.getProductTypeId()).get());
            productCategory.setUser(userRepository.findById(productCategory.getUserId()).get());
        }
        productCategoryRepository.saveAll(productCategoryDAO.getProductCategories());
        return "done";
    }
}
