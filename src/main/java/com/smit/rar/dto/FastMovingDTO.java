package com.smit.rar.dto;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.Setter;

@AllArgsConstructor
@Getter
@Setter
public class FastMovingDTO {

    private String location;
    private String focusCode;
    private String sageCode;
    private String description;
    private Double qty;
}
