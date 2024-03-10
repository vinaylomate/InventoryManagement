package com.smit.rar.model;

import com.fasterxml.jackson.annotation.JsonIgnore;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import javax.persistence.*;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.List;

@Setter
@Getter
@AllArgsConstructor
@NoArgsConstructor
@Entity
@Table(name = "product_register")
public class ProductRegister {

    @Id
    @Column(name = "product_register_id")
    private Long productRegisterId;

    @Column(
            name = "sage_code"
    )
    private String sageCode;

    @Column(
            name = "focus_code"
    )
    private String focusCode;

    @Column(
            name = "description"
    )
    private String description;

    @Column(
            name = "reorder_level_qty"
    )
    private Double reorderLevelQty;

    @Column(
            name = "brand_name"
    )
    private String brandName;

    @Column(
            name = "product_expiry"
    )
    private Long productExpiry;

    @Column(
            name = "entry_date"
    )
    private LocalDate entryDate;

    @Column(
            name = "is_deleted"
    )
    private Boolean isDeleted = false;

    @Transient
    private Long companyId;

    @Transient
    private Long uomId;

    @Transient
    private Long productCategoryId;

    @Transient
    private Long userId;

    @ManyToOne
    @JoinColumn(
            name = "user_id",
            referencedColumnName = "user_id",
            foreignKey = @ForeignKey(
                    name = "user_product_fk"
            )
    )
    private User user;

    @ManyToOne
    @JoinColumn(
            name = "company_id",
            referencedColumnName = "company_id",
            foreignKey = @ForeignKey(
                    name = "company_product_register_fk"
            )
    )
    private Company company;

    @ManyToOne
    @JoinColumn(
            name = "uom_id",
            referencedColumnName = "uom_id",
            foreignKey = @ForeignKey(
                    name = "uom_product_register_fk"
            )
    )
    private UOM uom;

    @ManyToOne
    @JoinColumn(
            name = "product_type_id",
            referencedColumnName = "product_type_id",
            foreignKey = @ForeignKey(
                    name = "product_type_product_register_fk"
            )
    )
    private ProductType productType;

    @ManyToOne
    @JoinColumn(
            name = "product_category_id",
            referencedColumnName = "product_category_id",
            foreignKey = @ForeignKey(
                    name = "product_category_stock_register_fk"
            )
    )
    private ProductCategory productCategory;

    @JsonIgnore
    @OneToMany(
            cascade = CascadeType.ALL,
            mappedBy = "productRegister"
    )
    private List<StockRegister> stockRegisters;

    public ProductRegister(String sageCode, String focusCode, String description, Double reorderLevelQty, String brandName, Long productExpiry) {
        this.sageCode = sageCode;
        this.focusCode = focusCode;
        this.description = description;
        this.reorderLevelQty = reorderLevelQty;
        this.brandName = brandName;
        this.productExpiry = productExpiry;
    }

    public ProductRegister(String sageCode, String focusCode, String description, Double reorderLevelQty, Long productExpiry) {
        this.sageCode = sageCode;
        this.focusCode = focusCode;
        this.description = description;
        this.reorderLevelQty = reorderLevelQty;
        this.productExpiry = productExpiry;
    }

    public ProductRegister(Long productRegisterId, String sageCode, String focusCode, String description, Double reorderLevelQty, Long productExpiry, String entryDate, Long companyId, Long uomId, Long productCategoryId, Long userId) {
        this.productRegisterId = productRegisterId;
        this.sageCode = sageCode;
        this.focusCode = focusCode;
        this.description = description;
        this.reorderLevelQty = reorderLevelQty;
        this.productExpiry = productExpiry;
        this.entryDate = LocalDate.parse(entryDate);
        this.companyId = companyId;
        this.uomId = uomId;
        this.productCategoryId = productCategoryId;
        this.userId = userId;
    }

    public ProductRegister(String sageCode, String focusCode, String description, Double reorderLevelQty, String brandName, Long productExpiry, Long companyId, Long uomId, Long productCategoryId, Long userId) {
        this.sageCode = sageCode;
        this.focusCode = focusCode;
        this.description = description;
        this.reorderLevelQty = reorderLevelQty;
        this.brandName = brandName;
        this.productExpiry = productExpiry;
        this.companyId = companyId;
        this.uomId = uomId;
        this.productCategoryId = productCategoryId;
        this.userId = userId;
    }

    public ProductRegister(String sageCode, String focusCode) {
        this.sageCode = sageCode;
        this.focusCode = focusCode;
    }
}
