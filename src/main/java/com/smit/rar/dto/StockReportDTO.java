package com.smit.rar.dto;

import com.smit.rar.model.EntryType;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import java.time.LocalDate;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
public class StockReportDTO {

    private String location;
    private String focusCode;
    private String sageCode;
    private String productDescription;
    private Double inQty;
    private Double outQty;
    private Double reorderLevel;
}
