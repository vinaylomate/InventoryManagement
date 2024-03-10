package com.smit.rar.controller;

import com.smit.rar.dao.CompanyDAO;
import com.smit.rar.model.Company;
import com.smit.rar.service.CompanyService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Map;

@RestController
@AllArgsConstructor
public class CompanyController {

    private final CompanyService companyService;

    @PostMapping("/manage/add/company/{userId}")
    private ResponseEntity<Company> addCompany(@RequestBody Company company,
                                               @PathVariable(name = "userId") Long userId) {
        return companyService.addCompany(company, userId);
    }

    @DeleteMapping("/manage/delete/company/{companyId}/{userId}")
    private ResponseEntity<Company> deleteCompany(@PathVariable(name = "companyId") Long companyId,
                                                  @PathVariable(name = "userId") Long userId) {
        return companyService.deleteCompany(companyId, userId);
    }

    @PostMapping("/manage/addAll/company")
    private String addAllCompany(@RequestBody CompanyDAO companyDAO) {
        return companyService.addAllCompany(companyDAO);
    }

    @GetMapping("/manage/get/company/{pageNumber}/{pageSize}")
    private ResponseEntity<Map<String, List<Object>>> getCompany(@PathVariable(name = "pageNumber") int pageNumber,
                                                                 @PathVariable(name = "pageSize") int pageSize) {
        return companyService.getCompany(pageNumber, pageSize);
    }
}
