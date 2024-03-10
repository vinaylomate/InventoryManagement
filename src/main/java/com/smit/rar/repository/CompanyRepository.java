package com.smit.rar.repository;

import com.smit.rar.model.Company;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface CompanyRepository extends JpaRepository<Company, Long> {

    @Query(value = "select c from Company c order by c.companyId desc")
    List<Company> findTopByOrderByCompanyIdDesc();

    @Query(value = "select c from Company c where c.isDeleted = false order by c.companyId asc")
    Page<Company> findCompany(Pageable pageable);
}
