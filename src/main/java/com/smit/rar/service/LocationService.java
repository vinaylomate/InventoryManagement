package com.smit.rar.service;

import com.smit.rar.dao.LocationDAO;
import com.smit.rar.model.Company;
import com.smit.rar.model.Location;
import com.smit.rar.model.ProductType;
import com.smit.rar.repository.*;
import lombok.AllArgsConstructor;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@AllArgsConstructor
public class LocationService {

    private final LocationRepository locationRepository;
    private final CompanyRepository companyRepository;
    private final ProductTypeRepository productTypeRepository;
    private final UserLocationRepository userLocationRepository;
    private final UserRepository userRepository;

    public ResponseEntity<Location> addLocation(Location location, Long companyId, Long productTypeId, Long userId) {

        if(location.getLocationId() == null) {
            List<Location> prevLocation = locationRepository.findTopByOrderByLocationIdDesc();
            location.setLocationId(prevLocation.isEmpty() ? 1L : prevLocation.get(0).getLocationId()+1L);
        }
        Company company = companyRepository.getById(companyId);
        ProductType productType = productTypeRepository.getById(productTypeId);
        location.setCompany(company);
        location.setProductType(productType);
        location.setUser(userRepository.findById(userId).get());
        locationRepository.save(location);
        return ResponseEntity.ok(location);
    }

    public ResponseEntity<List<Location>> getLocation(int pageNumber, int pageSize) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        Page<Location> resultPage = locationRepository.findLocation(pageable);

        return ResponseEntity.ok(resultPage.getContent());
    }

    public ResponseEntity<List<Location>> getLocationByCompany(Long companyId, Long userId) {

        return ResponseEntity.ok(locationRepository.getLocationByCompany(companyId, userId));
    }

    public ResponseEntity<List<Location>> getLocationByCompanyProductType(Long companyId, Long productTypeId, Long userId) {

        return ResponseEntity.ok(userLocationRepository.getLocationByCompanyAndProductType(companyId, productTypeId, userId));
    }

    public ResponseEntity<Location> deleteLocation(Long locationId, Long userId) {

        Location location = locationRepository.getById(locationId);
        location.setIsDeleted(true);
        location.setUser(userRepository.findById(userId).get());
        locationRepository.save(location);
        return ResponseEntity.ok(location);
    }

    public String addAllLocation(LocationDAO locationDAO) {

        for(Location location : locationDAO.getLocations()) {
            location.setCompany(companyRepository.findById(location.getCompanyId()).get());
            location.setProductType(productTypeRepository.findById(location.getProductTypeId()).get());
            location.setUser(userRepository.findById(location.getUserId()).get());
        }
        locationRepository.saveAll(locationDAO.getLocations());
        return "done";
    }
}
