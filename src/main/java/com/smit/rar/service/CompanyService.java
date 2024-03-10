package com.smit.rar.service;

import com.smit.rar.dao.CompanyDAO;
import com.smit.rar.model.*;
import com.smit.rar.repository.*;
import lombok.AllArgsConstructor;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.util.*;

@Service
@AllArgsConstructor
public class CompanyService {

    private final CompanyRepository companyRepository;
    private final ProductTypeRepository productTypeRepository;
    private final UOMRepository uomRepository;
    private final EntryRepository entryRepository;
    private final UserRepository userRepository;
    private final UserLocationRepository userLocationRepository;
    private final LocationRepository locationRepository;

    public ResponseEntity<Company> addCompany(Company company, Long userId) {

        if(company.getCompanyId() == null) {
            List<Company> prevCompany = companyRepository.findTopByOrderByCompanyIdDesc();
            company.setCompanyId(prevCompany.isEmpty() ? 1L : prevCompany.get(0).getCompanyId() + 1L);
        }
        company.setUser(userRepository.findById(userId).get());
        companyRepository.save(company);
        return ResponseEntity.ok(company);
    }

    public ResponseEntity<Map<String, List<Object>>> getCompany(int pageNumber, int pageSize) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        Page<Company> resultPage = companyRepository.findCompany(pageable);
        Page<ProductType> productTypes = productTypeRepository.findAll(pageable);
        Page<UOM> uoms = uomRepository.findAll(pageable);
        Page<Entry> entryPage = entryRepository.findAll(pageable);

        List<Object> companies = new ArrayList<>(resultPage.getContent());
        List<Object> productType = new ArrayList<>(productTypes.getContent());
        List<Object> uom = new ArrayList<>(uoms.getContent());
        List<Object> entries = new ArrayList<>(entryPage.getContent());

        Map<String, List<Object>> map = new HashMap<>();
        map.put("Company", companies);
        map.put("ProductType", productType);
        map.put("UOM", uom);
        map.put("Entry", entries);

        return ResponseEntity.ok().body(map);
    }

    public ResponseEntity<Company> deleteCompany(Long companyId, Long userId) {

        Company company = companyRepository.getById(companyId);
        company.setIsDeleted(true);
        company.setUser(userRepository.findById(userId).get());
        companyRepository.save(company);
        return ResponseEntity.ok(company);
    }

    public String addAllCompany(CompanyDAO companyDAO) {

        for(Company company : companyDAO.getCompanies()) {
            User user = userRepository.findById(company.getUserId()).get();
            company.setUser(user);
        }
        companyRepository.saveAll(companyDAO.getCompanies());
        return "done";
    }
}
