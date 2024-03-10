package com.smit.rar.repository;

import com.smit.rar.model.ProductType;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface ProductTypeRepository extends JpaRepository<ProductType, Long> {

    @Query(value = "select p from ProductType p order by p.productTypeId desc")
    List<ProductType> findTopByOrderByProductTypeIdDesc();
}
