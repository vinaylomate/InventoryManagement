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
@Table(name = "uom")
public class UOM {

    @Id
    @Column(name = "uom_id")
    private Long uomId;

    @Column(
            name = "uom_name"
    )
    private String uomName;

    @Column(
            name = "uom_description"
    )
    private String uomDescription;

    @Column(
            name = "is_deleted"
    )
    private Boolean isDeleted = false;

    @Transient
    private Long userId;

    @ManyToOne
    @JoinColumn(
            name = "user_id",
            referencedColumnName = "user_id",
            foreignKey = @ForeignKey(
                    name = "user_uom_fk"
            )
    )
    private User user;

    @JsonIgnore
    @OneToMany(
            cascade = CascadeType.ALL,
            mappedBy = "uom"
    )
    private List<ProductRegister> productRegisters;

    public UOM(Long uomId, String uomName, String uomDescription, Long userId) {
        this.uomId = uomId;
        this.uomName = uomName;
        this.uomDescription = uomDescription;
        this.userId = userId;
    }

    public UOM(String uomName, String uomDescription) {
        this.uomName = uomName;
        this.uomDescription = uomDescription;
    }
}
