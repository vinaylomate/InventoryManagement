package com.smit.rar.service;

import com.smit.rar.dao.UserDAO;
import com.smit.rar.dao.UserLocationDAO;
import com.smit.rar.model.*;
import com.smit.rar.repository.*;
import com.smit.rar.security.config.PasswordConfig;
import com.smit.rar.security.jwt.JwtService;
import com.smit.rar.security.jwt.TokenEncryptDecrypt;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

@Service
@AllArgsConstructor
public class UserService {

    private final UserRepository userRepository;
    private final JwtService jwtService;
    private final TokenEncryptDecrypt tokenEncryptDecrypt;
    private final PasswordEncoder passwordEncoder;
    private final UserLocationRepository userLocationRepository;
    private final LocationRepository locationRepository;
    public ResponseEntity<User> addUser(User user) {

        user.setPassword(passwordEncoder.encode(user.getPassword()));
        String[] page = user.getPage().split(",");
        String[] subPage = user.getSubPage().split(",");
        Long[] pages = new Long[page.length];
        Long[] subPages = new Long[subPage.length];
        for(int i = 0; i < page.length; i++) {
            pages[i] = Long.valueOf(page[i]);
        }
        for(int i = 0; i < subPage.length; i++) {
            subPages[i] = Long.valueOf(subPage[i]);
        }
        user.setPages(pages);
        user.setSubPages(subPages);
        userRepository.save(user);
        for(Long id : user.getLocations()) {
            Location location = locationRepository.findById(id).get();
            UserLocation userLocation = new UserLocation(new UserLocationId(id, user.getUserId()), location, user);
            userLocationRepository.save(userLocation);
        }
        return ResponseEntity.ok(user);
    }

    public ResponseEntity<Map<String, Object>> login(User user) {

        String token;
        User loginRequest = userRepository.findByUserName(user.getUsername());
        if(loginRequest != null && loginRequest.getUsername() != null) {
            token = jwtService.generateToken(user.getUsername());
        } else {
            throw new IllegalArgumentException("User not Found");
        }
        token = tokenEncryptDecrypt.encrypt(token);
        Map<String, Object> map = new HashMap<>();
        map.put("token", token);
        map.put("User", loginRequest);
        return ResponseEntity.ok(map);
    }

    public void addAdmin() {
        if(userRepository.findByUserName("admin") != null)
            return;
        User user = new User();
        user.setUsername("admin");
        user.setPassword(passwordEncoder.encode("123"));
        user.setUserRole(UserRole.ADMIN);
        user.setCreate(1L);
        user.setView(1L);
        user.setDelete(1L);
        user.setEdit(1L);
        Long[] pages = {1L,2L,3L,4L,5L};
        Long[] subPages = {1L,2L,3L,4L};
        Long[] locations = {1L,2L,3L,4L,5L,6L,7L,8L,9L,10L,11L,12L,13L,14L};
        user.setPages(pages);
        user.setSubPages(subPages);
        for(Long id : locations) {
            Location location = locationRepository.findById(id).isPresent() ? locationRepository.findById(id).get() : null;
            if(location == null) continue;
            UserLocation userLocation = new UserLocation(new UserLocationId(id, user.getUserId()), location, user);
            userLocationRepository.save(userLocation);
        }
        userRepository.save(user);
    }

    public String addAllUser(UserDAO userDAO) {

        for(User user : userDAO.getUsers()) {
            user.setPassword(passwordEncoder.encode(user.getPassword()));
            String[] page = user.getPage().split(",");
            if(!user.getSubPage().equals("-1")) {
                String[] subPage = user.getSubPage().split(",");
                Long[] subPages = new Long[subPage.length];
                for(int i = 0; i < subPage.length; i++) {
                    subPages[i] = Long.valueOf(subPage[i]);
                }
                user.setSubPages(subPages);
            }
            Long[] pages = new Long[page.length];
            for(int i = 0; i < page.length; i++) {
                pages[i] = Long.valueOf(page[i]);
            }
            user.setPages(pages);
        }
        userRepository.saveAll(userDAO.getUsers());
        return "done";
    }

    public String addAllUserLocation(UserLocationDAO userLocationDAO) {

        for(UserLocationId userLocationId : userLocationDAO.getUserLocationIds()) {
            User user = userRepository.findById(userLocationId.getUserId()).get();
            Location location = locationRepository.findById(userLocationId.getLocationId()).get();
            UserLocation userLocation = new UserLocation(userLocationId, location, user);
            userLocationRepository.save(userLocation);
        }
        return "done";
    }

    public ResponseEntity<List<User>> getUsers() {

        return ResponseEntity.ok(userRepository.findAll());
    }

    public ResponseEntity<List<Location>> getUserLocations(Long userId) {

        return ResponseEntity.ok(userLocationRepository.getLocationByUser(userId));
    }

    public ResponseEntity<String> deleteUser(Long userId) {

        userRepository.deleteById(userId);
        return ResponseEntity.ok("delete successfully");
    }
}
