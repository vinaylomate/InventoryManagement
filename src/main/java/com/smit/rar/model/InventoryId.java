package com.smit.rar.model;

import lombok.*;

import javax.persistence.Column;
import javax.persistence.Embeddable;
import java.io.Serializable;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@EqualsAndHashCode
@Embeddable
public class InventoryId implements Serializable {

    @Column(
            name = "product_register_id"
    )
    private Long productRegisterId;

    @Column(
            name = "location_id"
    )
    private Long locationId;
}
