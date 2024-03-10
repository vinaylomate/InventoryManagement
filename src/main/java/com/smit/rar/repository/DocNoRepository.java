package com.smit.rar.repository;

import com.smit.rar.model.DocNo;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface DocNoRepository extends JpaRepository<DocNo, Long> {

    @Query(value = "SELECT * FROM doc_no WHERE location_id = ?1 ORDER BY doc_no_id DESC LIMIT 1", nativeQuery = true)
    DocNo getDocNo(Long locationId);

    @Query(value = "select d from DocNo d where d.docNo = ?1")
    DocNo getDocNo(String docNo);

    @Query(value = "SELECT * FROM doc_no WHERE is_used = true ORDER BY doc_no_id DESC LIMIT 1", nativeQuery = true)
    DocNo getDocNoTrue();
}
