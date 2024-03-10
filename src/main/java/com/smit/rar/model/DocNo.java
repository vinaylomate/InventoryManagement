package com.smit.rar.model;

import com.fasterxml.jackson.annotation.JsonIgnore;
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
@Table(name = "doc_no")
public class DocNo {

    @Id
    @Column(name = "doc_no_id")
    private Long docNoId;

    @Column(
            name = "doc_no",
            nullable = false
    )
    private String docNo;

    @ManyToOne
    @JoinColumn(
            name = "location_id",
            referencedColumnName = "location_id",
            foreignKey = @ForeignKey(
                    name = "location_stock_register_fk"
            )
    )
    private Location location;

    @Column(
            name = "is_used"
    )
    private Boolean isUsed = false;

    public DocNo(Long docNoId, String docNo) {
        this.docNoId = docNoId;
        this.docNo = docNo;
    }

    public DocNo(String docNo) {
        this.docNo = docNo;
    }
}
