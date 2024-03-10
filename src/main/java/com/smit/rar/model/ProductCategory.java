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
@Table(name = "product_category")
public class ProductCategory {

    @Id
    @Column(name = "product_category_id")
    private Long productCategoryId;

    @Column(
            name = "product_category_name"
    )
    private String productCategoryName;

    @Column(
            name = "is_deleted"
    )
    private Boolean isDeleted = false;

    @Transient
    private Long productTypeId;

    @Transient
    private Long userId;

    @ManyToOne
    @JoinColumn(
            name = "product_type_id",
            referencedColumnName = "product_type_id",
            foreignKey = @ForeignKey(
                    name = "product_type_location_fk"
            )
    )
    private ProductType productType;

    @ManyToOne
    @JoinColumn(
            name = "user_id",
            referencedColumnName = "user_id",
            foreignKey = @ForeignKey(
                    name = "user_category_fk"
            )
    )
    private User user;

    @JsonIgnore
    @OneToMany(
            cascade = CascadeType.ALL,
            mappedBy = "productCategory"
    )
    private List<ProductRegister> productRegisters;

    public ProductCategory(Long productCategoryId, String productCategoryName) {
        this.productCategoryId = productCategoryId;
        this.productCategoryName = productCategoryName;
    }

    public ProductCategory(String productCategoryName) {
        this.productCategoryName = productCategoryName;
    }

    public ProductCategory(Long productCategoryId, String productCategoryName, Long productTypeId, Long userId) {
        this.productCategoryId = productCategoryId;
        this.productCategoryName = productCategoryName;
        this.productTypeId = productTypeId;
        this.userId = userId;
    }
}
