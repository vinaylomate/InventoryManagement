package com.smit.rar.repository;

import com.smit.rar.dto.*;
import com.smit.rar.model.EntryType;
import com.smit.rar.model.StockRegister;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Lock;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import javax.persistence.LockModeType;
import java.time.LocalDate;
import java.util.List;

@Repository
public interface StockRegisterRepository extends JpaRepository<StockRegister, Long> {

    @Lock(LockModeType.PESSIMISTIC_WRITE)
    @Query(value = "select s from StockRegister s where s.isDeleted = false and s.entryDate <= ?1 and s.productRegister.productRegisterId = ?2 and s.location.locationId = ?3 order by s.entryDate,s.stockRegisterId ASC")
    List<StockRegister> findByDate(LocalDate date, Long productRegisterId, Long locationId);

    @Lock(LockModeType.PESSIMISTIC_WRITE)
    @Query(value = "select s from StockRegister s where s.isDeleted = false and s.entryDate > ?1 and s.productRegister.productRegisterId = ?2 and s.location.locationId = ?3 order by s.entryDate, s.stockRegisterId ASC")
    List<StockRegister> findNextStock(LocalDate entryDate, Long productRegisterId, Long locationId);

    @Query(value = "select new com.smit.rar.dto.BatchNoDTO(s.batchNo, sum(s.qty) as qty) from StockRegister s where s.isDeleted = false and s.location.locationId = :locationId and s.entry.entryType = 1 and s.productRegister.productRegisterId = :productRegisterId and (:userId = 0L or s.user.userId = :userId) group by s.batchNo")
    List<BatchNoDTO> getBatch(@Param("locationId") Long locationId,
                                 @Param("productRegisterId") Long productRegisterId,
                                 @Param("userId") Long userId);

    @Query("SELECT s "+
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:userId = 0L or s.user.userId = :userId) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:search is null " +
            "       or s.productRegister.sageCode LIKE %:search% " +
            "       or s.location.locationCode LIKE %:search% " +
            "       or s.location.locationName LIKE %:search% " +
            "       or s.location.locationDescription LIKE %:search% " +
            "       or s.sageReference LIKE %:search% " +
            "       or s.docNo.docNo LIKE %:search% " +
            "       or s.notes LIKE %:search%) " +
            "AND (cast(:fromDate as date) is null or s.entryDate >= :fromDate) " +
            "AND (cast(:toDate as date) is null or s.entryDate <= :toDate) " +
            "ORDER BY s.entryDate DESC")
    Page<StockRegister> filterProducts(@Param("companyId") Long companyId,
                                          @Param("locationId") Long locationId,
                                          @Param("productTypeId") Long productTypeId,
                                          @Param("search") String search,
                                          @Param("fromDate") LocalDate fromDate,
                                          @Param("toDate") LocalDate toDate,
                                          @Param("userId") Long userId,
                                          Pageable pageable);

    @Query("SELECT s "+
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:userId = 0L or s.user.userId = :userId) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:search is null " +
            "       or s.productRegister.sageCode LIKE %:search% " +
            "       or s.location.locationCode LIKE %:search% " +
            "       or s.location.locationName LIKE %:search% " +
            "       or s.location.locationDescription LIKE %:search% " +
            "       or s.sageReference LIKE %:search% " +
            "       or s.docNo.docNo LIKE %:search% " +
            "       or s.notes LIKE %:search%) " +
            "AND (cast(:fromDate as date) is null or s.entryDate >= :fromDate) " +
            "AND (cast(:toDate as date) is null or s.entryDate <= :toDate) " +
            "ORDER BY s.entryDate DESC")
    List<StockRegister> filterProductsExcel(@Param("companyId") Long companyId,
                                       @Param("locationId") Long locationId,
                                       @Param("productTypeId") Long productTypeId,
                                       @Param("search") String search,
                                       @Param("fromDate") LocalDate fromDate,
                                       @Param("toDate") LocalDate toDate,
                                       @Param("userId") Long userId);

    @Query("SELECT " +
            "NEW com.smit.rar.dto.FastMovingDTO(" +
            "s.location.locationCode || ' - ' || s.location.locationName || ' - ' || s.location.locationDescription, " +
            "s.productRegister.focusCode, " +
            "s.productRegister.sageCode, " +
            "s.productRegister.description, " +
            "SUM(CASE WHEN s.entry.entryType = 1 THEN s.qty ELSE 0 END) AS qty) " +
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:search is null " +
            "   or s.productRegister.sageCode LIKE %:search% " +
            "   or s.productRegister.focusCode LIKE %:search% " +
            "   or s.location.locationCode LIKE %:search% " +
            "   or s.location.locationName LIKE %:search% " +
            "   or s.location.locationDescription LIKE %:search%) " +
            "AND (cast(:fromDate as date) is null or s.entryDate >= :fromDate) " +
            "AND (cast(:toDate as date) is null or s.entryDate <= :toDate) " +
            "GROUP BY s.location.locationCode, " +
            "s.location.locationName, " +
            "s.location.locationDescription, " +
            "s.productRegister.description, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode, "+
            "s.productRegister.focusCode ORDER BY qty DESC")
    Page<FastMovingDTO> fastMoving(@Param("companyId") Long companyId,
                                   @Param("locationId") Long locationId,
                                   @Param("productTypeId") Long productTypeId,
                                   @Param("search") String search,
                                   @Param("fromDate") LocalDate fromDate,
                                   @Param("toDate") LocalDate toDate,
                                   Pageable pageable);

    @Query("SELECT " +
            "NEW com.smit.rar.dto.FastMovingDTO(" +
            "s.location.locationCode || ' - ' || s.location.locationName || ' - ' || s.location.locationDescription, " +
            "s.productRegister.focusCode, " +
            "s.productRegister.sageCode, " +
            "s.productRegister.description, " +
            "s.qty) " +
            "FROM Inventory s " +
            "WHERE (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:search is null " +
            "   or s.productRegister.sageCode LIKE %:search% " +
            "   or s.productRegister.focusCode LIKE %:search% " +
            "   or s.location.locationCode LIKE %:search% " +
            "   or s.location.locationName LIKE %:search% " +
            "   or s.location.locationDescription LIKE %:search%) " +
            "GROUP BY s.location.locationCode, " +
            "s.location.locationName, " +
            "s.qty, " +
            "s.location.locationDescription, " +
            "s.productRegister.description, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode, "+
            "s.productRegister.focusCode ORDER BY s.qty DESC")
    Page<FastMovingDTO> nonMoving(@Param("companyId") Long companyId,
                                   @Param("locationId") Long locationId,
                                   @Param("productTypeId") Long productTypeId,
                                   @Param("search") String search,
                                   Pageable pageable);

    @Query("SELECT " +
            "NEW com.smit.rar.dto.InOutReportDTO(" +
            "s.location.locationCode || ' - ' || s.location.locationName || ' - ' || s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode, " +
            "SUM(CASE WHEN s.entry.entryType = 0 THEN s.qty ELSE 0 END) AS inColumn, " +
            "SUM(CASE WHEN s.entry.entryType = 1 THEN s.qty ELSE 0 END) AS outColumn) " +
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:search is null " +
            "   or s.productRegister.sageCode LIKE %:search% " +
            "   or s.location.locationCode LIKE %:search% " +
            "   or s.location.locationName LIKE %:search% " +
            "   or s.location.locationDescription LIKE %:search% " +
            "   or s.sageReference LIKE %:search% " +
            "   or s.notes LIKE %:search%) " +
            "AND (cast(:fromDate as date) is null or s.entryDate >= :fromDate) " +
            "AND (cast(:toDate as date) is null or s.entryDate <= :toDate) " +
            "GROUP BY s.location.locationCode, " +
            "s.location.locationName, " +
            "s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode")
    Page<InOutReportDTO> inOutReport(@Param("companyId") Long companyId,
                                     @Param("locationId") Long locationId,
                                     @Param("productTypeId") Long productTypeId,
                                     @Param("search") String search,
                                     @Param("fromDate") LocalDate fromDate,
                                     @Param("toDate") LocalDate toDate,
                                     Pageable pageable);

    @Query("SELECT " +
            "NEW com.smit.rar.dto.InOutReportDTO(" +
            "s.location.locationCode || ' - ' || s.location.locationName || ' - ' || s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode, " +
            "SUM(CASE WHEN s.entry.entryType = 0 THEN s.qty ELSE 0 END) AS inColumn, " +
            "SUM(CASE WHEN s.entry.entryType = 1 THEN s.qty ELSE 0 END) AS outColumn) " +
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:search is null " +
            "   or s.productRegister.sageCode LIKE %:search% " +
            "   or s.location.locationCode LIKE %:search% " +
            "   or s.location.locationName LIKE %:search% " +
            "   or s.location.locationDescription LIKE %:search% " +
            "   or s.sageReference LIKE %:search% " +
            "   or s.notes LIKE %:search%) " +
            "AND (cast(:fromDate as date) is null or s.entryDate >= :fromDate) " +
            "AND (cast(:toDate as date) is null or s.entryDate <= :toDate) " +
            "GROUP BY s.location.locationCode, " +
            "s.location.locationName, " +
            "s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode")
    List<InOutReportDTO> inOutReportExcel(@Param("companyId") Long companyId,
                                     @Param("locationId") Long locationId,
                                     @Param("productTypeId") Long productTypeId,
                                     @Param("search") String search,
                                     @Param("fromDate") LocalDate fromDate,
                                     @Param("toDate") LocalDate toDate);

    @Query("SELECT NEW com.smit.rar.dto.StockReportDTO(" +
            "CONCAT(s.location.locationCode, ' - ', s.location.locationName, ' - ', s.location.locationDescription), " +
            "s.productRegister.focusCode, " +
            "s.productRegister.sageCode, " +
            "s.productRegister.description, " +
            "SUM(CASE WHEN s.entry.entryType = 0 THEN s.qty ELSE 0 END) AS inColumn, " +
            "SUM(CASE WHEN s.entry.entryType = 1 THEN s.qty ELSE 0 END) AS outColumn, " +
            "s.productRegister.reorderLevelQty) " +
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productCategoryId = 0L or s.productRegister.productCategory.productCategoryId = :productCategoryId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:brandName is null or s.productRegister.brandName = :brandName) " +
            "AND (:search is null " +
            "   or s.productRegister.sageCode LIKE %:search% " +
            "   or s.productRegister.focusCode LIKE %:search% " +
            "   or s.productRegister.description LIKE %:search% " +
            "   or s.location.locationCode LIKE %:search% " +
            "   or s.location.locationName LIKE %:search% " +
            "   or s.location.locationDescription LIKE %:search% " +
            "   or s.sageReference LIKE %:search% " +
            "   or s.notes LIKE %:search%) " +
            "GROUP BY s.location.locationCode, " +
            "s.location.locationName, " +
            "s.productRegister.focusCode, " +
            "s.productRegister.description, " +
            "s.productRegister.reorderLevelQty,"+
            "s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode")
    Page<StockReportDTO> getStock(@Param("companyId") Long companyId,
                                  @Param("productTypeId") Long productTypeId,
                                  @Param("locationId") Long locationId,
                                  @Param("productCategoryId") Long productCategoryId,
                                  @Param("brandName") String brandName,
                                  @Param("search") String search,
                                  Pageable pageable);

    @Query("SELECT NEW com.smit.rar.dto.StockReportDTO(" +
            "CONCAT(s.location.locationCode, ' - ', s.location.locationName, ' - ', s.location.locationDescription), " +
            "s.productRegister.focusCode, " +
            "s.productRegister.sageCode, " +
            "s.productRegister.description, " +
            "SUM(CASE WHEN s.entry.entryType = 0 THEN s.qty ELSE 0 END) AS inColumn, " +
            "SUM(CASE WHEN s.entry.entryType = 1 THEN s.qty ELSE 0 END) AS outColumn, " +
            "s.productRegister.reorderLevelQty) " +
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productCategoryId = 0L or s.productRegister.productCategory.productCategoryId = :productCategoryId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:brandName is null or s.productRegister.brandName = :brandName) " +
            "AND (:search is null " +
            "   or s.productRegister.sageCode LIKE %:search% " +
            "   or s.productRegister.focusCode LIKE %:search% " +
            "   or s.productRegister.description LIKE %:search% " +
            "   or s.location.locationCode LIKE %:search% " +
            "   or s.location.locationName LIKE %:search% " +
            "   or s.location.locationDescription LIKE %:search% " +
            "   or s.sageReference LIKE %:search% " +
            "   or s.notes LIKE %:search%) " +
            "GROUP BY s.location.locationCode, " +
            "s.location.locationName, " +
            "s.productRegister.focusCode, " +
            "s.productRegister.description, " +
            "s.productRegister.reorderLevelQty,"+
            "s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode")
    List<StockReportDTO> getStockExcel(@Param("companyId") Long companyId,
                                  @Param("productTypeId") Long productTypeId,
                                  @Param("locationId") Long locationId,
                                  @Param("productCategoryId") Long productCategoryId,
                                  @Param("brandName") String brandName,
                                  @Param("search") String search);

    @Query("SELECT NEW com.smit.rar.dto.StockReportBatchDTO(" +
            "CONCAT(s.location.locationCode, ' - ', s.location.locationName, ' - ', s.location.locationDescription), " +
            "s.productRegister.focusCode, " +
            "s.productRegister.sageCode, " +
            "s.productRegister.description, " +
            "s.batchNo, " +
            "SUM(CASE WHEN s.entry.entryType = 0 THEN s.qty ELSE 0 END) AS inColumn, " +
            "SUM(CASE WHEN s.entry.entryType = 1 THEN s.qty ELSE 0 END) AS outColumn, " +
            "s.productRegister.reorderLevelQty) " +
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productCategoryId = 0L or s.productRegister.productCategory.productCategoryId = :productCategoryId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:batchNo is null or s.batchNo = :batchNo) " +
            "AND (:search is null " +
            "   or s.batchNo LIKE %:search% " +
            "   or s.productRegister.sageCode LIKE %:search% " +
            "   or s.productRegister.focusCode LIKE %:search% " +
            "   or s.productRegister.description LIKE %:search% " +
            "   or s.location.locationCode LIKE %:search% " +
            "   or s.location.locationName LIKE %:search% " +
            "   or s.location.locationDescription LIKE %:search% " +
            "   or s.sageReference LIKE %:search% " +
            "   or s.notes LIKE %:search%) " +
            "GROUP BY s.location.locationCode, " +
            "s.location.locationName, " +
            "s.batchNo, " +
            "s.productRegister.focusCode, " +
            "s.productRegister.description, " +
            "s.productRegister.reorderLevelQty,"+
            "s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode")
    Page<StockReportBatchDTO> getBatch(@Param("companyId") Long companyId,
                                       @Param("productTypeId") Long productTypeId,
                                       @Param("locationId") Long locationId,
                                       @Param("productCategoryId") Long productCategoryId,
                                       @Param("batchNo") String batchNo,
                                       @Param("search") String search,
                                       Pageable pageable);

    @Query("SELECT NEW com.smit.rar.dto.StockReportBatchDTO(" +
            "CONCAT(s.location.locationCode, ' - ', s.location.locationName, ' - ', s.location.locationDescription), " +
            "s.productRegister.focusCode, " +
            "s.productRegister.sageCode, " +
            "s.productRegister.description, " +
            "s.batchNo, " +
            "SUM(CASE WHEN s.entry.entryType = 0 THEN s.qty ELSE 0 END) AS inColumn, " +
            "SUM(CASE WHEN s.entry.entryType = 1 THEN s.qty ELSE 0 END) AS outColumn, " +
            "s.productRegister.reorderLevelQty) " +
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productCategoryId = 0L or s.productRegister.productCategory.productCategoryId = :productCategoryId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:batchNo is null or s.batchNo = :batchNo) " +
            "AND (:search is null " +
            "   or s.batchNo LIKE %:search% " +
            "   or s.productRegister.sageCode LIKE %:search% " +
            "   or s.productRegister.focusCode LIKE %:search% " +
            "   or s.productRegister.description LIKE %:search% " +
            "   or s.location.locationCode LIKE %:search% " +
            "   or s.location.locationName LIKE %:search% " +
            "   or s.location.locationDescription LIKE %:search% " +
            "   or s.sageReference LIKE %:search% " +
            "   or s.notes LIKE %:search%) " +
            "GROUP BY s.location.locationCode, " +
            "s.location.locationName, " +
            "s.batchNo, " +
            "s.productRegister.focusCode, " +
            "s.productRegister.description, " +
            "s.productRegister.reorderLevelQty,"+
            "s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode")
    List<StockReportBatchDTO> getBatchExcel(@Param("companyId") Long companyId,
                                       @Param("productTypeId") Long productTypeId,
                                       @Param("locationId") Long locationId,
                                       @Param("productCategoryId") Long productCategoryId,
                                       @Param("batchNo") String batchNo,
                                       @Param("search") String search);

    @Query("SELECT NEW com.smit.rar.dto.OFSReportDTO(" +
            "s.entryDate, "+
            "CONCAT(s.location.locationCode, ' - ', s.location.locationName, ' - ', s.location.locationDescription), " +
            "s.productRegister.focusCode, " +
            "s.productRegister.sageCode, " +
            "s.productRegister.description, " +
            "s.batchNo, " +
            "s.qty, "+
            "s.productRegister.reorderLevelQty, " +
            "s.expiryDate) "+
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productCategoryId = 0L or s.productRegister.productCategory.productCategoryId = :productCategoryId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:batchNo is null or s.batchNo = :batchNo) " +
            "AND (:search is null " +
            "   or s.batchNo LIKE %:search% " +
            "   or s.productRegister.sageCode LIKE %:search% " +
            "   or s.productRegister.focusCode LIKE %:search% " +
            "   or s.productRegister.description LIKE %:search% " +
            "   or s.location.locationCode LIKE %:search% " +
            "   or s.location.locationName LIKE %:search% " +
            "   or s.location.locationDescription LIKE %:search% " +
            "   or s.sageReference LIKE %:search% " +
            "   or s.notes LIKE %:search%) " +
            "GROUP BY s.location.locationCode, " +
            "s.location.locationName, " +
            "s.batchNo, " +
            "s.qty, " +
            "s.entryDate, " +
            "s.expiryDate, " +
            "s.productRegister.focusCode, " +
            "s.productRegister.description, " +
            "s.productRegister.reorderLevelQty,"+
            "s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode")
    Page<OFSReportDTO> getOFS(@Param("companyId") Long companyId,
                              @Param("productTypeId") Long productTypeId,
                              @Param("locationId") Long locationId,
                              @Param("productCategoryId") Long productCategoryId,
                              @Param("batchNo") String batchNo,
                              @Param("search") String search,
                              Pageable pageable);

    @Query("SELECT NEW com.smit.rar.dto.OFSReportDTO(" +
            "s.entryDate, "+
            "CONCAT(s.location.locationCode, ' - ', s.location.locationName, ' - ', s.location.locationDescription), " +
            "s.productRegister.focusCode, " +
            "s.productRegister.sageCode, " +
            "s.productRegister.description, " +
            "s.batchNo, " +
            "s.qty, "+
            "s.productRegister.reorderLevelQty, " +
            "s.expiryDate) "+
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productCategoryId = 0L or s.productRegister.productCategory.productCategoryId = :productCategoryId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:batchNo is null or s.batchNo = :batchNo) " +
            "AND (:search is null " +
            "   or s.batchNo LIKE %:search% " +
            "   or s.productRegister.sageCode LIKE %:search% " +
            "   or s.productRegister.focusCode LIKE %:search% " +
            "   or s.productRegister.description LIKE %:search% " +
            "   or s.location.locationCode LIKE %:search% " +
            "   or s.location.locationName LIKE %:search% " +
            "   or s.location.locationDescription LIKE %:search% " +
            "   or s.sageReference LIKE %:search% " +
            "   or s.notes LIKE %:search%) " +
            "GROUP BY s.location.locationCode, " +
            "s.location.locationName, " +
            "s.batchNo, " +
            "s.qty, " +
            "s.entryDate, " +
            "s.expiryDate, " +
            "s.productRegister.focusCode, " +
            "s.productRegister.description, " +
            "s.productRegister.reorderLevelQty,"+
            "s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.productRegister.sageCode")
    List<OFSReportDTO> getOFSExcel(@Param("companyId") Long companyId,
                              @Param("productTypeId") Long productTypeId,
                              @Param("locationId") Long locationId,
                              @Param("productCategoryId") Long productCategoryId,
                              @Param("batchNo") String batchNo,
                              @Param("search") String search);

    @Query(value = "select s from StockRegister s where s.isDeleted = false and s.docNo.docNo = :docNo and (:userId = 0L or s.user.userId = :userId) order by s.entryDate ASC")
    List<StockRegister> getView(@Param("docNo") String docNo,
                                @Param("userId") Long userId);

    @Query("SELECT s FROM StockRegister s WHERE s.isDeleted = false " +
            "AND s.location.locationId = :locationId " +
            "AND s.productRegister.sageCode = :sageCode " +
            "AND (cast(:fromDate as date) IS NULL OR s.entryDate >= :fromDate) " +
            "AND (cast(:endDate as date) IS NULL OR s.entryDate <= :endDate) " +
            "ORDER BY s.entryDate,s.stockRegisterId ASC")
    List<StockRegister> getViewInOut(
            @Param("locationId") Long locationId,
            @Param("sageCode") String sageCode,
            @Param("fromDate") LocalDate fromDate,
            @Param("endDate") LocalDate endDate
    );

    @Query(value = "SELECT * FROM stock_register ORDER BY stock_register_id DESC LIMIT 1", nativeQuery = true)
    StockRegister findTopByOrderByStockRegisterIdDesc();

    @Query(value = "SELECT * FROM stock_register WHERE product_register_id = ?1 AND location_id = ?2 ORDER BY stock_register_id DESC LIMIT 1", nativeQuery = true)
    StockRegister findSum(Long ProductRegisterId, Long locationId);

    @Query(value = "select s from StockRegister s where s.productRegister.productRegisterId = ?1 order by s.stockRegisterId desc")
    List<StockRegister> findStockByProduct(Long productRegisterId);

    @Query(value = "select s from StockRegister s where s.productRegister.productRegisterId = ?1 order by s.entryDate, s.stockRegisterId ASC")
    List<StockRegister> findStock(Long productRegisterId);

    @Query(value = "select s.productRegister.productRegisterId from StockRegister s group by s.productRegister.productRegisterId")
    List<Long> findProducts();

    @Query(value = "select s from StockRegister s where (:productRegisterId = 0L or s.productRegister.productRegisterId = :productRegisterId) and (cast(:date as date) is null or s.entryDate <= :date) order by s.entryDate desc,s.stockRegisterId desc")
    Page<StockRegister> findStockByDate(@Param("productRegisterId") Long productRegisterId, @Param("date") LocalDate date, Pageable pageable);

    @Query("SELECT NEW com.smit.rar.dto.TotalQtyByMonthDTO(CAST(DATE_TRUNC('month', s.entryDate) AS java.time.LocalDate), " +
            "CAST(SUM(s.qty) AS java.math.BigDecimal)) " +
            "FROM StockRegister s " +
            "WHERE s.productRegister.productType.productTypeId = :productTypeId " +
            "AND s.entry.entryType = :entryType " +
            "AND s.entryDate >= :startDate " +
            "GROUP BY DATE_TRUNC('month', s.entryDate)")
    List<TotalQtyByMonthDTO> findTotalQtyByMonthAndProductTypeAndEntryId(@Param("productTypeId") Long productTypeId,
                                                                         @Param("entryType") EntryType entryType,
                                                                         @Param("startDate") LocalDate startDate);

    @Query(value = "select count(s) from StockRegister s where s.expiryDate <= ?1 group by s.productRegister.productRegisterId")
    List<Long> getExpiry(LocalDate startDate);

    @Query(value = "select s from StockRegister s where s.docNo.docNo = ?1")
    List<StockRegister> getByDocNo(String docNo);

    @Query("SELECT new com.smit.rar.dto.StockRegisterDTO(" +
            "s.entryDate, " +
            "s.docNo.docNo, " +
            "CONCAT(s.location.locationCode, ' - ', s.location.locationName, ' - ', s.location.locationDescription), " +
            "s.location.productType.productTypeName, " +
            "s.sageReference, " +
            "s.notes) "+
            "FROM StockRegister s " +
            "WHERE (s.isDeleted = false) " +
            "AND (:userId = 0L or s.user.userId = :userId) " +
            "AND (:companyId = 0L or s.location.company.companyId = :companyId) " +
            "AND (:locationId = 0L or s.location.locationId = :locationId) " +
            "AND (:productTypeId = 0L or s.location.productType.productTypeId = :productTypeId) " +
            "AND (:search is null " +
            "       or s.productRegister.sageCode LIKE %:search% " +
            "       or s.location.locationCode LIKE %:search% " +
            "       or s.location.locationName LIKE %:search% " +
            "       or s.location.locationDescription LIKE %:search% " +
            "       or s.sageReference LIKE %:search% " +
            "       or s.docNo.docNo LIKE %:search% " +
            "       or s.notes LIKE %:search%) " +
            "AND (cast(:fromDate as date) is null or s.entryDate >= :fromDate) " +
            "AND (cast(:toDate as date) is null or s.entryDate <= :toDate) " +
            "GROUP BY s.entryDate, " +
            "s.docNo.docNo, " +
            "s.location.locationCode, " +
            "s.location.locationName, " +
            "s.location.locationDescription, " +
            "s.location.productType.productTypeName, " +
            "s.sageReference, " +
            "s.notes " +
            "ORDER BY s.entryDate DESC")
    Page<StockRegisterDTO> getInventoryRegister(@Param("companyId") Long companyId,
                                       @Param("locationId") Long locationId,
                                       @Param("productTypeId") Long productTypeId,
                                       @Param("search") String search,
                                       @Param("fromDate") LocalDate fromDate,
                                       @Param("toDate") LocalDate toDate,
                                       @Param("userId") Long userId,
                                       Pageable pageable);
}
