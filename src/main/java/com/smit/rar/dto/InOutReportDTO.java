package com.smit.rar.dto;

import lombok.*;

import javax.persistence.*;
import java.time.LocalDate;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
public class InOutReportDTO {

    private LocalDate entryDate;
    private String company;
    private String location;
    private String productTypeName;
    private String focusCode;
    private String sageCode;
    private String description;
    private Double openingStock;
    private Double in;
    private Double out;
    private Double closingStock;

    public InOutReportDTO(String location, String productTypeName, String focusCode, String sageCode, String description, Double in, Double out, Double closingStock) {
        this.location = location;
        this.productTypeName = productTypeName;
        this.focusCode = focusCode;
        this.sageCode = sageCode;
        this.description = description;
        this.in = in;
        this.out = out;
        this.closingStock = closingStock;
    }

    public InOutReportDTO(String location, String productTypeName, String sageCode, Double in, Double out) {
        this.location = location;
        this.productTypeName = productTypeName;
        this.sageCode = sageCode;
        this.in = in;
        this.out = out;
    }

    public InOutReportDTO(String location, String productTypeName, String focusCode, String sageCode, String description, Double openingStock, Double in, Double out, Double closingStock) {
        this.location = location;
        this.productTypeName = productTypeName;
        this.focusCode = focusCode;
        this.sageCode = sageCode;
        this.description = description;
        this.openingStock = openingStock;
        this.in = in;
        this.out = out;
        this.closingStock = closingStock;
    }
}
