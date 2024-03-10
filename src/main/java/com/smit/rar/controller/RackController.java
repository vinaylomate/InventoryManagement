package com.smit.rar.controller;

import com.smit.rar.model.Rack;
import com.smit.rar.model.UOM;
import com.smit.rar.service.RackService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@AllArgsConstructor
public class RackController {

    private final RackService rackService;

    @PostMapping("/manage/add/rack/{productTypeId}/{userId}")
    private ResponseEntity<Rack> addRack(@PathVariable(name = "productTypeId") Long productTypeId,
                                         @RequestBody Rack rack,
                                         @PathVariable(name = "userId") Long userId) {
        return rackService.addRack(rack, productTypeId, userId);
    }

    @DeleteMapping("/manage/delete/rack/{rackId}/{userId}")
    private ResponseEntity<Rack> deleteRack(@PathVariable(name = "rackId") Long rackId,
                                         @PathVariable(name = "userId") Long userId) {
        return rackService.deleteRack(rackId, userId);
    }

    @GetMapping("/manage/get/rack/{productTypeId}/{pageNumber}/{pageSize}")
    private ResponseEntity<List<Rack>> getRack(@PathVariable(name = "productTypeId") Long productTypeId,
                                               @PathVariable(name = "pageNumber") int pageNumber,
                                               @PathVariable(name = "pageSize") int pageSize) {
        return rackService.getRack(productTypeId, pageNumber, pageSize);
    }

    @GetMapping("/manage/get/allRack/{pageNumber}/{pageSize}")
    private ResponseEntity<List<Rack>> getAllRack(@PathVariable(name = "pageNumber") int pageNumber,
                                               @PathVariable(name = "pageSize") int pageSize) {
        return rackService.getAllRack(pageNumber, pageSize);
    }
}
