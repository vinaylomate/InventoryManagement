package com.smit.rar.model;

import com.fasterxml.jackson.annotation.JsonIgnore;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;
import org.checkerframework.checker.units.qual.C;

import javax.persistence.*;
import java.util.List;

@Setter
@Getter
@AllArgsConstructor
@NoArgsConstructor
@Entity
@Table(name = "company")
public class Company {

    @Id
    @Column(name = "company_id")
    private Long companyId;

    @Column(
            name = "company_code"
    )
    private String companyCode;

    @Column(
            name = "company_name"
    )
    private String companyName;

    @Column(
            name = "company_description"
    )
    private String companyDescription;

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
                    name = "user_company_fk"
            )
    )
    private User user;

    @JsonIgnore
    @OneToMany(
            cascade = CascadeType.ALL,
            mappedBy = "company"
    )
    private List<Location> locations;

    @JsonIgnore
    @OneToMany(
            cascade = CascadeType.ALL,
            mappedBy = "company"
    )
    private List<ProductRegister> productRegisters;

    // for excel upload stock
    public Company(Long companyId, String companyCode, String companyName, String companyDescription, Long userId) {
        this.companyId = companyId;
        this.companyCode = companyCode;
        this.companyName = companyName;
        this.companyDescription = companyDescription;
        this.userId = userId;
    }

    public Company(String companyCode, String companyName, String companyDescription) {
        this.companyCode = companyCode;
        this.companyName = companyName;
        this.companyDescription = companyDescription;
    }
}
