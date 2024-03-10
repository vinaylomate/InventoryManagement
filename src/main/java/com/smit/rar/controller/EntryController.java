package com.smit.rar.controller;

import com.smit.rar.dao.EntryTypeDAO;
import com.smit.rar.model.Company;
import com.smit.rar.model.Entry;
import com.smit.rar.model.Location;
import com.smit.rar.service.EntryService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@AllArgsConstructor
public class EntryController {

    private final EntryService entryService;

    @PostMapping("/manage/add/entry/{userId}")
    private ResponseEntity<Entry> addEntry(@RequestBody Entry entry,
                                           @PathVariable(name = "userId") Long userId) {
        return entryService.addEntry(entry, userId);
    }

    @PostMapping("/manage/addAll/entryType")
    private String addAllEntry(@RequestBody EntryTypeDAO entryTypeDAO) {
        return entryService.addAllEntry(entryTypeDAO);
    }

    @DeleteMapping("/manage/delete/entry/{entryId}/{userId}")
    private ResponseEntity<Entry> deleteEntry(@PathVariable(name = "entryId") Long entryId,
                                              @PathVariable(name = "userId") Long userId) {
        return entryService.deleteEntry(entryId, userId);
    }

    @GetMapping("/manage/get/entry/{pageNumber}/{pageSize}")
    private ResponseEntity<List<Entry>> getEntry(@PathVariable(name = "pageNumber") int pageNumber,
                                                       @PathVariable(name = "pageSize") int pageSize) {
        return entryService.getEntry(pageNumber, pageSize);
    }

    @GetMapping("/manage/get/entry/{entryId}")
    private String getEntry(@PathVariable(name = "entryId") Long entryId) {
        return entryService.getEntry(entryId);
    }
}
