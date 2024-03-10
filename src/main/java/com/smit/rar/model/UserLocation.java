package com.smit.rar.model;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import javax.persistence.*;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@Entity
@Table(name = "user_location")
public class UserLocation {

    @EmbeddedId
    private UserLocationId userLocationId;

    @ManyToOne
    @MapsId("location_id")
    @JoinColumn(
            name = "location_id"
    )
    private Location location;

    @ManyToOne
    @MapsId("user_id")
    @JoinColumn(
            name = "user_id"
    )
    private User user;
}
