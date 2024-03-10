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
@Table(name = "entry")
public class Entry {

    @Id
    @Column(name = "entry_id")
    private Long entryId;

    @Column(
            name = "entry_name"
    )
    private String entryName;

    @Column(
            name = "entry_type"
    )
    private EntryType entryType;

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
                    name = "user_entry_fk"
            )
    )
    private User user;

    @JsonIgnore
    @OneToMany(
            cascade = CascadeType.ALL,
            mappedBy = "entry"
    )
    private List<StockRegister> stockRegisters;

    public Entry(Long entryId, String entryName, String entryType, Long userId) {
        this.entryId = entryId;
        this.entryName = entryName;
        this.entryType = EntryType.valueOf(entryType);
        this.userId = userId;
    }

    public Entry(String entryName, EntryType entryType) {
        this.entryName = entryName;
        this.entryType = entryType;
    }
}
