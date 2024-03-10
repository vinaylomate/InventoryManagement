package com.smit.rar.model;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import javax.persistence.*;

@Setter
@Getter
@AllArgsConstructor
@NoArgsConstructor
@Entity
@Table(name = "inventory")
public class Inventory {

    @EmbeddedId
    private InventoryId inventoryId;

    @ManyToOne
    @MapsId("product_register_id")
    @JoinColumn(
            name = "product_register_id"
    )
    private ProductRegister productRegister;

    @ManyToOne
    @MapsId("location_id")
    @JoinColumn(
            name = "location_id"
    )
    private Location location;

    @Column(
            name = "qty"
    )
    private Double qty;
}
