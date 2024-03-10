package com.smit.rar.controller;

import com.smit.rar.model.DocNo;
import com.smit.rar.service.DocNoService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@AllArgsConstructor
public class DocNoController {

    private final DocNoService docNoService;

    @GetMapping("/manage/get/docNo/{locationId}/{year}")
    private ResponseEntity<DocNo> getDocNo(@PathVariable(name = "locationId") Long locationId,
                                          @PathVariable(name = "year") Long year) {
        return docNoService.getDocNo(locationId, year);
    }
}
