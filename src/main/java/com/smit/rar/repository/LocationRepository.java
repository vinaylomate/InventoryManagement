package com.smit.rar.repository;

import com.smit.rar.model.Location;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface LocationRepository extends JpaRepository<Location, Long> {

    @Query(value = "select l from Location l where l.company.companyId = ?1 and l.isDeleted = false and l.user.userId = ?2")
    List<Location> getLocationByCompany(Long companyId, Long userId);

    @Query(value = "select l from Location l order by l.locationId desc")
    List<Location> findTopByOrderByLocationIdDesc();

    @Query(value = "select l from Location l where l.isDeleted = false order by l.locationId asc")
    Page<Location> findLocation(Pageable pageable);

    @Query(value = "select l from Location l where l.isDeleted = false and l.locationCode = ?1")
    Location findByCode(String locationCode);
}
