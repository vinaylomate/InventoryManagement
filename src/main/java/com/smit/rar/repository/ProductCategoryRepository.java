package com.smit.rar.repository;

import com.smit.rar.model.ProductCategory;
import com.smit.rar.model.ProductType;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface ProductCategoryRepository extends JpaRepository<ProductCategory, Long> {

    @Query(value = "select p from ProductCategory p where p.productType.productTypeId = ?1 and p.isDeleted = false")
    List<ProductCategory> getProductCategoryByType(Long productTypeId);

    @Query(value = "select p from ProductCategory p order by p.productCategoryId desc")
    List<ProductCategory> findTopByOrderByProductCategoryIdDesc();

    @Query(value = "select p from ProductCategory p where p.isDeleted = false order by p.productCategoryId asc")
    Page<ProductCategory> findCategory(Pageable pageable);
}
