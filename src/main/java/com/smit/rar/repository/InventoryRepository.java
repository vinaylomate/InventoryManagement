package com.smit.rar.repository;

import com.smit.rar.model.Inventory;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Lock;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import javax.persistence.LockModeType;

@Repository
public interface InventoryRepository extends JpaRepository<Inventory, Long> {

    @Lock(LockModeType.PESSIMISTIC_WRITE)
    @Query(value = "select i from Inventory i where i.productRegister.productRegisterId = ?1 and i.location.locationId = ?2")
    Inventory findInventory(Long productRegisterId, Long locationId);

    @Query(value = "select i from Inventory i where (:productTypeId is 0L or i.productRegister.productType.productTypeId = :productTypeId) and (:locationId is 0L or i.location.locationId = :locationId) and (:productCategoryId is 0L or i.productRegister.productCategory.productCategoryId = :productCategoryId) and (:search is null or i.productRegister.sageCode LIKE %:search% or i.productRegister.focusCode LIKE %:search% or i.productRegister.description LIKE %:search%)")
    Page<Inventory> getInventories(@Param("productTypeId") Long productTypeId,
                                   @Param("locationId") Long locationId,
                                   @Param("productCategoryId")Long productCategoryId,
                                   @Param("search") String search,
                                   Pageable pageable);

    @Query(value = "select sum(qty) from Inventory")
    Double getTotalStock();

    @Query(value = "select count(i) from Inventory i where i.productRegister.reorderLevelQty < i.qty")
    Double getReorderLevelQty();

    @Query(value = "select count(i) from Inventory i where i.qty = 0")
    Double getOFS();
}
