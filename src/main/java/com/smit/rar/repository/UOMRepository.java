package com.smit.rar.repository;

import com.smit.rar.model.UOM;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface UOMRepository extends JpaRepository<UOM, Long> {

    @Query(value = "select u from UOM u order by u.uomId desc")
    List<UOM> findTopByOrderByUOMIdDesc();

    @Query(value = "select u from UOM u where u.isDeleted = false order by u.uomId desc")
    Page<UOM> findUOM(Pageable pageable);
}
