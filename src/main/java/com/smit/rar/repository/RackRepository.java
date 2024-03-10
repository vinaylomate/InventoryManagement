package com.smit.rar.repository;

import com.smit.rar.model.Rack;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface RackRepository extends JpaRepository<Rack, Long> {

    @Query(value = "select r from Rack r")
    Page<Rack> findRack(Long productTypeId, Pageable pageable);

    @Query(value = "select r from Rack r order by r.rackId desc")
    List<Rack> findTopByOrderByRackIdDesc();
}
