package com.smit.rar.dao;

import com.smit.rar.model.UserLocationId;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import java.util.List;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
public class UserLocationDAO {

    List<UserLocationId> userLocationIds;
}
