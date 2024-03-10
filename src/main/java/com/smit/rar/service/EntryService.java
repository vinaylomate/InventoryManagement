package com.smit.rar.service;

import com.smit.rar.dao.EntryTypeDAO;
import com.smit.rar.model.Entry;
import com.smit.rar.model.User;
import com.smit.rar.repository.EntryRepository;
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
public class EntryService {

    private final EntryRepository entryRepository;
    private final UserRepository userRepository;

    public ResponseEntity<Entry> addEntry(Entry entry, Long userId) {

        if(entry.getEntryId() == null) {
            List<Entry> prevEntry = entryRepository.findTopByOrderByEntryIdDesc();
            entry.setEntryId(prevEntry.isEmpty() ? 1L : prevEntry.get(0).getEntryId()+1L);
        }
        entry.setUser(userRepository.findById(userId).get());
        entryRepository.save(entry);
        return ResponseEntity.ok(entry);
    }

    public ResponseEntity<List<Entry>> getEntry(int pageNumber, int pageSize) {

        Pageable pageable = PageRequest.of(pageNumber, pageSize);
        Page<Entry> resultPage = entryRepository.findEntry(pageable);

        return ResponseEntity.ok(resultPage.getContent());
    }

    public String getEntry(Long entryId) {

        Entry entry = entryRepository.getById(entryId);
        return entry.getEntryType().name();
    }

    public ResponseEntity<Entry> deleteEntry(Long entryId, Long userId) {

        Entry entry = entryRepository.getById(entryId);
        entry.setIsDeleted(true);
        entry.setUser(userRepository.findById(userId).get());
        entryRepository.save(entry);
        return ResponseEntity.ok(entry);
    }

    public String addAllEntry(EntryTypeDAO entryTypeDAO) {

        for(Entry entry : entryTypeDAO.getEntryTypes()) {
            User user = userRepository.findById(entry.getUserId()).get();
            entry.setUser(user);
        }
        entryRepository.saveAll(entryTypeDAO.getEntryTypes());
        return "done";
    }
}
