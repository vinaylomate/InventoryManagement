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
@Table(name = "rack")
public class Rack {

    @Id
    private Long rackId;

    @Column(
            name = "rack_number"
    )
    private String rackNumber;

    @Column(
            name = "is_deleted"
    )
    private Boolean isDeleted = false;

    @ManyToOne
    @JoinColumn(
            name = "user_id",
            referencedColumnName = "user_id",
            foreignKey = @ForeignKey(
                    name = "user_rack_fk"
            )
    )
    private User user;

    @ManyToOne
    @JoinColumn(
            name = "product_type_id",
            referencedColumnName = "product_type_id",
            foreignKey = @ForeignKey(
                    name = "product_type_rack_fk"
            )
    )
    private ProductType productType;

    public Rack(String rackNumber) {
        this.rackNumber = rackNumber;
    }
}
