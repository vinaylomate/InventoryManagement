package com.smit.rar.service;

import com.smit.rar.dao.UOMDAO;
import com.smit.rar.model.UOM;
import com.smit.rar.model.User;
import com.smit.rar.repository.UOMRepository;
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
public class UOMService {

    private final UOMRepository uomRepository;
    private final UserRepository userRepository;

    public ResponseEntity<UOM> addUOM(UOM uom, Long userId) {

        if(uom.getUomId() == null) {
            List<UOM> prevUOM = uomRepository.findTopByOrderByUOMIdDesc();
            uom.setUomId(prevUOM.isEmpty() ? 1L : prevUOM.get(0).getUomId()+1L);
        }
        uom.setUser(userRepository.findById(userId).get());
        uomRepository.save(uom);
        return ResponseEntity.ok(uom);
    }

    public ResponseEntity<List<UOM>> getUOM(int pageNumber, int pageSize) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        Page<UOM> resultPage = uomRepository.findUOM(pageable);

        return ResponseEntity.ok(resultPage.getContent());
    }

    public ResponseEntity<UOM> deleteUOM(Long uomId, Long userId) {

        UOM uom = uomRepository.getById(uomId);
        uom.setIsDeleted(true);
        uom.setUser(userRepository.findById(userId).get());
        uomRepository.save(uom);
        return ResponseEntity.ok(uom);
    }

    public String addAllUom(UOMDAO uomdao) {

        for(UOM uom : uomdao.getUoms()) {
            User user = userRepository.findById(uom.getUserId()).get();
            uom.setUser(user);
        }
        uomRepository.saveAll(uomdao.getUoms());
        return "done";
    }
}
