package com.smit.rar.model;


import com.fasterxml.jackson.annotation.JsonIgnore;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import javax.persistence.*;
import java.util.List;

@Setter
@Getter
@AllArgsConstructor
@NoArgsConstructor
@Entity
@Table(name = "product_type")
public class ProductType {

    @Id
    @Column(name = "product_type_id")
    private Long productTypeId;

    @Column(
            name = "product_type_name"
    )
    private String productTypeName;

    @Column(
            name = "is_deleted"
    )
    private Boolean isDeleted = false;

    @JsonIgnore
    @OneToMany(
            cascade = CascadeType.ALL,
            mappedBy = "productType"
    )
    private List<Location> locations;

    @JsonIgnore
    @OneToMany(
            cascade = CascadeType.ALL,
            mappedBy = "productType"
    )
    private List<ProductCategory> productCategories;

    @JsonIgnore
    @OneToMany(
            cascade = CascadeType.ALL,
            mappedBy = "productType"
    )
    private List<ProductRegister> productRegisters;


    public ProductType(Long productTypeId, String productTypeName) {
        this.productTypeId = productTypeId;
        this.productTypeName = productTypeName;
    }

    public ProductType(String productTypeName) {
        this.productTypeName = productTypeName;
    }
}
