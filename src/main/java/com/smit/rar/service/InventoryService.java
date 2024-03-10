package com.smit.rar.service;

import com.smit.rar.model.Inventory;
import com.smit.rar.repository.InventoryRepository;
import lombok.AllArgsConstructor;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import javax.transaction.Transactional;
import java.util.HashMap;
import java.util.Map;

@Service
@AllArgsConstructor
public class InventoryService {

    private final InventoryRepository inventoryRepository;

    @Transactional
    public ResponseEntity<Double> getQty(Long productRegisterId, Long locationId) {

        Inventory inventory = inventoryRepository.findInventory(productRegisterId, locationId);
        if(inventory == null)
            return ResponseEntity.ok(0.0);
        return ResponseEntity.ok(inventory.getQty());
    }

    @Transactional
    public ResponseEntity<Map<String, Object>> getInventory(Long productTypeId, Long locationId, Long productCategoryId, String search, int pageNumber, int pageSize) {

        search = search.equals("null") ? null : search.replace("!", "/");
        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        Page<Inventory> page = inventoryRepository.getInventories(productTypeId, locationId, productCategoryId, search, pageable);

        Map<String, Object> map = new HashMap<>();
        map.put("data", page.getContent());
        map.put("count", page.getTotalElements());

        return ResponseEntity.ok(map);
    }

    public ResponseEntity<String> getTotalStock() {

        return ResponseEntity.ok(String.format("%.2f", inventoryRepository.getTotalStock()));
    }

    public ResponseEntity<String> getReorderLevelQty() {

        return ResponseEntity.ok(String.format("%.2f", inventoryRepository.getReorderLevelQty()));
    }

    public ResponseEntity<String> getOFS() {

        return ResponseEntity.ok(String.format("%.2f", inventoryRepository.getOFS()));
    }
}
