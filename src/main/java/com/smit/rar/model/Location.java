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
@Table(name = "location")
public class Location {

    @Id
    @Column(name = "location_id")
    private Long locationId;

    @Column(
            name = "location_code"
    )
    private String locationCode;

    @Column(
            name = "location_name"
    )
    private String locationName;

    @Column(
            name = "location_description"
    )
    private String locationDescription;

    @Column(
            name = "is_deleted"
    )
    private Boolean isDeleted = false;

    @Transient
    private Long companyId;

    @Transient
    private Long productTypeId;

    @Transient
    private Long userId;

    @ManyToOne
    @JoinColumn(
            name = "company_id",
            referencedColumnName = "company_id",
            foreignKey = @ForeignKey(
                    name = "company_location_fk"
            )
    )
    private Company company;

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
                    name = "user_location_fk"
            )
    )
    private User user;

    @JsonIgnore
    @OneToMany(
            cascade = CascadeType.ALL,
            mappedBy = "location"
    )
    private List<StockRegister> stockRegisters;

    @JsonIgnore
    @OneToMany(
            mappedBy = "location",
            cascade = CascadeType.ALL
    )
    private List<UserLocation> userLocations;

    @JsonIgnore
    @OneToMany(
            mappedBy = "location",
            cascade = CascadeType.ALL
    )
    private List<DocNo> docNos;

    //for excel upload
    public Location(Long locationId, String locationCode, String locationName, String locationDescription, Long companyId, Long productTypeId, Long userId) {
        this.locationId = locationId;
        this.locationCode = locationCode;
        this.locationName = locationName;
        this.locationDescription = locationDescription;
        this.companyId = companyId;
        this.productTypeId = productTypeId;
        this.userId = userId;
    }

    public Location(String locationCode, String locationName, String locationDescription) {
        this.locationCode = locationCode;
        this.locationName = locationName;
        this.locationDescription = locationDescription;
    }
}
