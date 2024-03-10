package com.smit.rar.service;

import com.smit.rar.model.Company;
import com.smit.rar.model.ProductType;
import com.smit.rar.model.Rack;
import com.smit.rar.repository.ProductTypeRepository;
import com.smit.rar.repository.RackRepository;
import com.smit.rar.repository.UserRepository;
import lombok.AllArgsConstructor;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@AllArgsConstructor
public class RackService {

    private final RackRepository rackRepository;
    private final ProductTypeRepository productTypeRepository;
    private final UserRepository userRepository;

    public ResponseEntity<Rack> addRack(Rack rack, Long productTypeId, Long userId) {

        if(rack.getRackId() == null) {
            List<Rack> prevRack = rackRepository.findTopByOrderByRackIdDesc();
            rack.setRackId(prevRack.isEmpty() ? 1L : prevRack.get(0).getRackId() + 1L);
        }
        ProductType productType = productTypeRepository.getById(productTypeId);
        rack.setProductType(productType);
        rack.setUser(userRepository.findById(userId).get());
        rackRepository.save(rack);
        return ResponseEntity.ok(rack);
    }

    public ResponseEntity<List<Rack>> getRack(Long productTypeId, int pageNumber, int pageSize) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        Page<Rack> resultPage = rackRepository.findRack(productTypeId, pageable);

        return ResponseEntity.ok(resultPage.getContent());
    }

    public ResponseEntity<List<Rack>> getAllRack(int pageNumber, int pageSize) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        Page<Rack> rackPage = rackRepository.findAll(pageable);

        return ResponseEntity.ok(rackPage.getContent());
    }

    public ResponseEntity<Rack> deleteRack(Long rackId, Long userId) {

        Rack rack = rackRepository.findById(rackId).get();
        rack.setIsDeleted(true);
        rack.setUser(userRepository.findById(userId).get());
        rackRepository.save(rack);
        return ResponseEntity.ok(rack);
    }
}
