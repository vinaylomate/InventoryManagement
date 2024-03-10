package com.smit.rar.service;

import com.smit.rar.model.Company;
import com.smit.rar.model.DocNo;
import com.smit.rar.model.Location;
import com.smit.rar.model.ProductType;
import com.smit.rar.repository.CompanyRepository;
import com.smit.rar.repository.DocNoRepository;
import com.smit.rar.repository.LocationRepository;
import com.smit.rar.repository.ProductTypeRepository;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Objects;

@Service
@AllArgsConstructor
public class DocNoService {

    private final DocNoRepository docNoRepository;
    private final LocationRepository locationRepository;

    public ResponseEntity<DocNo> getDocNo(Long locationId, Long year) {

        Location location = locationRepository.findById(locationId).get();
        DocNo docNos = docNoRepository.getDocNo(locationId);

        if(docNos != null && !docNos.getIsUsed()) {
            return ResponseEntity.ok(docNos);
        }
        DocNo docNoTrue = docNoRepository.getDocNoTrue();
        Long id = docNoTrue == null ? 1L : docNoTrue.getDocNoId()+1L;
        String prevDocNo = docNoTrue == null ? null : docNoTrue.getDocNo();
        if(prevDocNo == null) {
            prevDocNo = location.getLocationCode() + year + "0000" + 1L;
        } else {
            int index = prevDocNo.indexOf("0000")+4;
            long num = Long.parseLong(prevDocNo.substring(index));
            num += 1L;
            prevDocNo = location.getLocationCode() + year + "0000"+num;
        }
        DocNo docNo = new DocNo(id, prevDocNo);
        docNo.setLocation(location);
        docNoRepository.save(docNo);
        return ResponseEntity.ok(docNo);
    }
}
