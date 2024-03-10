package com.smit.rar.controller;

import com.smit.rar.dao.UOMDAO;
import com.smit.rar.model.Entry;
import com.smit.rar.model.UOM;
import com.smit.rar.service.UOMService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Repository;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@AllArgsConstructor
public class UOMController {

    private final UOMService uomService;

    @PostMapping("/manage/add/uom/{userId}")
    private ResponseEntity<UOM> addUOM(@RequestBody UOM uom,
                                       @PathVariable(name = "userId") Long userId) {
        return uomService.addUOM(uom, userId);
    }

    @PostMapping("/manage/addAll/uom")
    private String addAllUom(@RequestBody UOMDAO uomdao) {
        return uomService.addAllUom(uomdao);
    }

    @DeleteMapping("/manage/delete/uom/{uomId}/{userId}")
    private ResponseEntity<UOM> deleteUOM(@PathVariable(name = "uomId") Long uomId,
                                          @PathVariable(name = "userId") Long userId) {
        return uomService.deleteUOM(uomId, userId);
    }

    @GetMapping("/manage/get/uom/{pageNumber}/{pageSize}")
    private ResponseEntity<List<UOM>> getUOM(@PathVariable(name = "pageNumber") int pageNumber,
                                                 @PathVariable(name = "pageSize") int pageSize) {
        return uomService.getUOM(pageNumber, pageSize);
    }
}
