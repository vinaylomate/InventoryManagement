package com.smit.rar.controller;

import com.smit.rar.dao.UserDAO;
import com.smit.rar.dao.UserLocationDAO;
import com.smit.rar.model.Location;
import com.smit.rar.model.User;
import com.smit.rar.service.UserService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Map;

@RestController
@AllArgsConstructor
public class UserController {

    private final UserService userService;

    @PostMapping("/manage/add/user")
    private ResponseEntity<User> addUser(@RequestBody User user) {
        return userService.addUser(user);
    }

    @PostMapping("/login")
    private ResponseEntity<Map<String, Object>> login(@RequestBody User user) {
        return userService.login(user);
    }

    @PostMapping("/manage/addAll/user")
    private String addAllUser(@RequestBody UserDAO userDAO) {
        return userService.addAllUser(userDAO);
    }

    @PostMapping("/manage/addAll/userLocation")
    private String addAllUserLocation(@RequestBody UserLocationDAO userLocationDAO) {
        return userService.addAllUserLocation(userLocationDAO);
    }

    @GetMapping("/manage/get/users")
    private ResponseEntity<List<User>> getUsers() {
        return userService.getUsers();
    }

    @GetMapping("/manage/get/userLocations/{userId}")
    private ResponseEntity<List<Location>> getUserLocations(@PathVariable(name = "userId") Long userId) {
        return userService.getUserLocations(userId);
    }

    @DeleteMapping("/manage/delete/user/{userId}")
    private ResponseEntity<String> deleteUser(@PathVariable(name = "userId") Long userId) {
        return userService.deleteUser(userId);
    }
}
