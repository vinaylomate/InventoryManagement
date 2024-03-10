package com.smit.rar.repository;

import com.smit.rar.model.ProductRegister;
import com.smit.rar.model.StockRegister;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import java.time.LocalDate;
import java.util.List;

@Repository
public interface ProductRegisterRepository extends JpaRepository<ProductRegister, Long> {

    @Query("SELECT s FROM ProductRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:companyId = 0L or s.company.companyId = :companyId) " +
            "AND (:productCategoryId = 0L or s.productCategory.productCategoryId = :productCategoryId) " +
            "AND (:productTypeId = 0L or s.productType.productTypeId = :productTypeId) " +
            "AND (:search is null " +
            "       or s.productCategory.productCategoryName LIKE %:search% " +
            "       or s.sageCode LIKE %:search% " +
            "       or s.focusCode LIKE %:search% " +
            "       or s.description LIKE %:search% )")
    Page<ProductRegister> getProductRegister(@Param("companyId") Long companyId,
                                             @Param("productCategoryId") Long productCategoryId,
                                             @Param("productTypeId") Long productTypeId,
                                             @Param("search") String search,
                                             Pageable pageable);

    @Query(value = "select * from product_register order by product_register_id desc limit 1", nativeQuery = true)
    ProductRegister findTopByOrderByProductRegisterIdDesc();

    @Query(value = "select p from ProductRegister p where p.sageCode = ?1")
    ProductRegister findBySageCode(String stockRegisterId);

    @Query(value = "select p from ProductRegister p")
    List<ProductRegister> findProducts();
}
