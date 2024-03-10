package com.smit.rar.controller;

import com.smit.rar.dao.LocationDAO;
import com.smit.rar.model.Location;
import com.smit.rar.service.LocationService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@AllArgsConstructor
@RestController
public class LocationController {

    private final LocationService locationService;

    @PostMapping("/manage/add/location/{companyId}/{productTypeId}/{userId}")
    private ResponseEntity<Location> addLocation(@RequestBody Location location,
                                                 @PathVariable(name = "companyId") Long companyId,
                                                 @PathVariable(name = "productTypeId") Long productTypeId,
                                                 @PathVariable(name = "userId") Long userId) {
        return locationService.addLocation(location, companyId, productTypeId, userId);
    }

    @PostMapping("/manage/addAll/location")
    private String addAllLocation(@RequestBody LocationDAO locationDAO) {
        return locationService.addAllLocation(locationDAO);
    }

    @DeleteMapping("/manage/delete/location/{locationId}/{userId}")
    private ResponseEntity<Location> deleteLocation(@PathVariable(name = "locationId") Long locationId,
                                                    @PathVariable(name = "userId") Long userId) {
        return locationService.deleteLocation(locationId, userId);
    }

    @GetMapping("/manage/getAll/location/{pageNumber}/{pageSize}")
    private ResponseEntity<List<Location>> getLocation(@PathVariable(name = "pageNumber") int pageNumber,
                                                          @PathVariable(name = "pageSize") int pageSize) {
        return locationService.getLocation(pageNumber, pageSize);
    }

    @GetMapping("/manage/get/location/{companyId}/{userId}")
    private ResponseEntity<List<Location>> getLocationByCompany(@PathVariable(name = "companyId") Long companyId,
                                                                @PathVariable(name = "userId") Long userId) {
        return locationService.getLocationByCompany(companyId, userId);
    }

    @GetMapping("/manage/get/location/typeWise/{companyId}/{productTypeId}/{userId}")
    private ResponseEntity<List<Location>> getLocationByCompanyProductType(@PathVariable(name = "companyId") Long companyId,
                                                                           @PathVariable(name = "productTypeId") Long productTypeId,
                                                                           @PathVariable(name = "userId") Long userId) {
        return locationService.getLocationByCompanyProductType(companyId, productTypeId, userId);
    }
}
