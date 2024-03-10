package com.smit.rar.model;

import lombok.*;

import javax.persistence.Column;
import javax.persistence.Embeddable;
import java.io.Serializable;

@Embeddable
@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
@EqualsAndHashCode
public class UserLocationId implements Serializable {

    @Column(
            name = "location_id"
    )
    private Long locationId;

    @Column(
            name = "user_id"
    )
    private Long userId;
}
