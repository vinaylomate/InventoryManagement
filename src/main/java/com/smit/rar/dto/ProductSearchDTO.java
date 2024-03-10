package com.smit.rar.dto;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
public class ProductSearchDTO {

    private Long companyId;
    private Long locationId;
    private Long productCategoryId;
    private Long productTypeId;
    private String search;
    private int pageNumber;
    private int pageSize;
}
