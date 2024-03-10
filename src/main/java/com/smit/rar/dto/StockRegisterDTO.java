package com.smit.rar.dto;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.Setter;

import java.time.LocalDate;

@AllArgsConstructor
@Getter
@Setter
public class StockRegisterDTO {

    private LocalDate entryDate;
    private String docNo;
    private String location;
    private String productTypeName;
    private String sageReference;
    private String notes;
}
