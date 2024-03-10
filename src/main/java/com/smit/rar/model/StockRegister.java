package com.smit.rar.model;

import com.fasterxml.jackson.annotation.JsonIgnore;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import javax.persistence.*;
import java.time.LocalDate;
import java.util.List;

@Setter
@Getter
@AllArgsConstructor
@NoArgsConstructor
@Entity
@Table(name = "stock_register")
public class StockRegister {

    @Id
    @Column(name = "stock_register_id")
    private Long stockRegisterId;

    @Column(
            name = "entry_date"
    )
    private LocalDate entryDate;

    @Column(
            name = "sage_reference"
    )
    private String sageReference;

    @Column(
            name = "notes"
    )
    private String notes;

    @Column(
            name = "batchNo"
    )
    private String batchNo;

    @Column(
            name = "qty"
    )
    private Double qty;

    @Column(
            name = "current_qty"
    )
    private Double currentQty;

    @Column(
            name = "expiry_date"
    )
    private LocalDate expiryDate;

    @Column(
            name = "is_deleted"
    )
    private Boolean isDeleted = false;

    @Column(
            name = "sum"
    )
    private Double sum;

    @Transient
    private Long locationId;

    @Transient
    private Long entryId;

    @Transient
    private String productRegisterId;

    @Transient
    private String docNoId;

    @Transient
    private String oldExpiryDate;

    @Transient
    private Long userId;

    @ManyToOne
    @JoinColumn(
            name = "user_id",
            referencedColumnName = "user_id",
            foreignKey = @ForeignKey(
                    name = "user_stock_fk"
            )
    )
    private User user;

    @ManyToOne
    @JoinColumn(
            name = "location_id",
            referencedColumnName = "location_id",
            foreignKey = @ForeignKey(
                    name = "location_stock_register_fk"
            )
    )
    private Location location;

    @ManyToOne
    @JoinColumn(
            name = "entry_id",
            referencedColumnName = "entry_id",
            foreignKey = @ForeignKey(
                    name = "entry_stock_register_fk"
            )
    )
    private Entry entry;

    @ManyToOne
    @JoinColumn(
            name = "product_register_id",
            referencedColumnName = "product_register_id",
            foreignKey = @ForeignKey(
                    name = "product_register_stock_register_fk"
            )
    )
    private ProductRegister productRegister;

    @ManyToOne
    @JoinColumn(
            name = "doc_no_id",
            referencedColumnName = "doc_no_id",
            foreignKey = @ForeignKey(
                    name = "doc_no_stock_register_fk"
            )
    )
    private DocNo docNo;

    public StockRegister(Long stockRegisterId, LocalDate entryDate, String sageReference, String notes, String batchNo, Double qty, LocalDate expiryDate) {
        this.stockRegisterId = stockRegisterId;
        this.entryDate = entryDate;
        this.sageReference = sageReference;
        this.notes = notes;
        this.batchNo = batchNo;
        this.qty = qty;
        this.expiryDate = expiryDate;
    }

    public StockRegister(LocalDate entryDate, String sageReference, String notes, String batchNo, Double qty, LocalDate expiryDate) {
        this.entryDate = entryDate;
        this.sageReference = sageReference;
        this.notes = notes;
        this.batchNo = batchNo;
        this.qty = qty;
        this.expiryDate = expiryDate;
    }

    public StockRegister(LocalDate entryDate, String sageReference, String notes, String batchNo, Double qty, String oldExpiryDate, Long locationId, Long entryId, String productRegisterId, String docNoId, Long userId) {
        this.entryDate = entryDate;
        this.sageReference = sageReference;
        this.notes = notes;
        this.batchNo = batchNo;
        this.qty = qty;
        this.oldExpiryDate = oldExpiryDate;
        this.locationId = locationId;
        this.entryId = entryId;
        this.productRegisterId = productRegisterId; //sageCode
        this.docNoId = docNoId; //docNo
        this.userId =userId;
    }
}
