package com.smit.rar.repository;

import com.smit.rar.model.Entry;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface EntryRepository extends JpaRepository<Entry, Long> {

    @Query(value = "select e from Entry e order by e.entryId desc")
    List<Entry> findTopByOrderByEntryIdDesc();

    @Query(value = "select e from Entry e where e.isDeleted = false order by e.entryId asc")
    Page<Entry> findEntry(Pageable pageable);
}
