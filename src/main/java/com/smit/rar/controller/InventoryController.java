package com.smit.rar.controller;

import com.smit.rar.model.Inventory;
import com.smit.rar.service.InventoryService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.parameters.P;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Map;

@RestController
@AllArgsConstructor
public class InventoryController {

    private final InventoryService inventoryService;

    @GetMapping("/manage/get/qty/{productRegisterId}/{locationId}")
    private ResponseEntity<Double> getQty(@PathVariable(name = "productRegisterId") Long productRegisterId,
                                  @PathVariable(name = "locationId") Long locationId) {
        return inventoryService.getQty(productRegisterId, locationId);
    }

    @GetMapping("/manage/get/inventory/{productTypeId}/{locationId}/{productCategoryId}/{search}/{pageNumber}/{pageSize}")
    private ResponseEntity<Map<String, Object>> getInventory(@PathVariable(name = "productTypeId") Long productTypeId,
                                                             @PathVariable(name = "locationId") Long locationId,
                                                             @PathVariable(name = "productCategoryId") Long productCategoryId,
                                                             @PathVariable(name = "search") String search,
                                                             @PathVariable(name = "pageNumber") int pageNumber,
                                                             @PathVariable(name = "pageSize") int pageSize) {
        return inventoryService.getInventory(productTypeId, locationId, productCategoryId, search, pageNumber, pageSize);
    }

    @GetMapping("/manage/get/totalStock")
    private ResponseEntity<String> getTotalStock() {
        return inventoryService.getTotalStock();
    }

    @GetMapping("/manage/get/reorderLevelQty")
    private ResponseEntity<String> getReorderLevelQty() {
        return inventoryService.getReorderLevelQty();
    }

    @GetMapping("/manage/get/OFS")
    private ResponseEntity<String> getOFS() {
        return inventoryService.getOFS();
    }
}
