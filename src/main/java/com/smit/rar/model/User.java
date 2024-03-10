package com.smit.rar.model;

import com.fasterxml.jackson.annotation.JsonIgnore;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;
import org.checkerframework.checker.units.qual.C;
import org.springframework.security.core.GrantedAuthority;
import org.springframework.security.core.userdetails.UserDetails;

import javax.persistence.*;
import java.util.Collection;
import java.util.List;
import java.util.Map;

@Entity
@Table(name = "rar_user")
@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
public class User implements UserDetails {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(
            name = "user_id",
            updatable = false,
            nullable = false
    )
    private Long userId;

    @Column(
            name = "username",
            nullable = false
    )
    private String username;

    @Column(
            name = "password",
            nullable = false
    )
    private String password;

    @Column(
            name = "show_password"
    )
    private String showPassword;

    @Column(
            name = "is_deleted"
    )
    private Boolean isDeleted = false;

    @Column(
            name = "pages"
    )
    private Long[] pages;

    @Column(
            name = "subPages"
    )
    private Long[] subPages;

    @Column(
            name = "locations"
    )
    private Long[] locations;

    @Column(
            name = "create"
    )
    private Long create;

    @Column(
            name = "view"
    )
    private Long view;

    @Column(
            name = "delete"
    )
    private Long delete;

    @Column(
            name = "edit"
    )
    private Long edit;

    @Column(
            name = "user_role"
    )
    private UserRole userRole;

    @Transient
    private String page;

    @Transient
    private String subPage;

    @Transient
    private String token;

    @JsonIgnore
    @OneToMany(
            mappedBy = "user",
            cascade = CascadeType.ALL
    )
    private List<UserLocation> userLocations;

    public User(String username, String password, Long[] locations, Long create, Long view, Long delete, Long edit, String page, String subPage, String userRole) {
        this.username = username;
        this.password = password;
        this.locations = locations;
        this.create = create;
        this.view = view;
        this.delete = delete;
        this.edit = edit;
        this.page = page;
        this.subPage = subPage;
        this.userRole = UserRole.valueOf(userRole);
    }

    public User(Long userId, String username, String password, Long create, Long view, Long delete, Long edit, UserRole userRole, String page, String subPage) {
        this.userId = userId;
        this.username = username;
        this.password = password;
        this.create = create;
        this.view = view;
        this.delete = delete;
        this.edit = edit;
        this.userRole = userRole;
        this.page = page;
        this.subPage = subPage;
    }

    public User(String username, String password) {
        this.username = username;
        this.password = password;
    }

    @Override
    public Collection<? extends GrantedAuthority> getAuthorities() {
        return null;
    }

    @Override
    public boolean isAccountNonExpired() {
        return true;
    }

    @Override
    public boolean isAccountNonLocked() {
        return true;
    }

    @Override
    public boolean isCredentialsNonExpired() {
        return true;
    }

    @Override
    public boolean isEnabled() {
        return true;
    }
}
