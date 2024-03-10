package com.smit.rar.dto;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.Setter;

import java.time.LocalDate;

@AllArgsConstructor
@Getter
@Setter
public class OFSReportDTO {

    private LocalDate entryDate;
    private String location;
    private String focusCode;
    private String sageCode;
    private String description;
    private String batchNo;
    private Double qty;
    private Double reorderLevelQty;
    private LocalDate expiryDate;
}
