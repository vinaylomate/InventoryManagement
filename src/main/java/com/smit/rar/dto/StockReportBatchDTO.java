package com.smit.rar.dto;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.Setter;

@AllArgsConstructor
@Getter
@Setter
public class StockReportBatchDTO {

    private String location;
    private String focusCode;
    private String sageCode;
    private String description;
    private String batchNo;
    private Double inQty;
    private Double outQty;
    private Double reorderLevelQty;
}
