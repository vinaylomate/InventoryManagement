package com.smit.rar.repository;

import com.smit.rar.model.Location;
import com.smit.rar.model.UserLocation;
import com.smit.rar.model.UserLocationId;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.util.List;

public interface UserLocationRepository extends JpaRepository<UserLocation, UserLocationId> {

    @Query("SELECT u.location FROM UserLocation u " +
            "WHERE (u.location.isDeleted = false) " +
            "AND (:companyId = 0L or u.location.company.companyId = :companyId) " +
            "AND (:userId = 0L or u.user.userId = :userId) " +
            "AND (:productTypeId = 0L or u.location.productType.productTypeId = :productTypeId)")
    List<Location> getLocationByCompanyAndProductType(@Param("companyId") Long companyId,
                                                      @Param("productTypeId") Long productTypeId,
                                                      @Param("userId") Long userId);

    @Query(value = "select u.location from UserLocation u where u.user.userId = ?1")
    List<Location> getLocationByUser(Long userId);
}
