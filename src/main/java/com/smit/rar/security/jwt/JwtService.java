package com.smit.rar.security.jwt;

import com.smit.rar.model.User;
import com.smit.rar.repository.UserRepository;
import lombok.AllArgsConstructor;
import org.springframework.http.HttpHeaders;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.stereotype.Service;

import javax.transaction.Transactional;
import java.time.LocalDate;
import java.util.Random;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

@Service
@AllArgsConstructor
public class JwtService {

    private final UserRepository userRepository;

    @Transactional
    public String generateToken(String username) {

        StringBuilder temp = new StringBuilder(username);
        Random random = new Random();

        for(int i = 0; i < username.length(); i++) {

            char ch = username.charAt(i);
            if((((i*i*i*i)+2904)&1) == 0) ch += 1;
            if(username.charAt(i) >= 'a' && username.charAt(i) <= 'z') {
                if(ch > 'z') {
                    ch = (char) (96+(ch-'z'));
                }
            } else if(username.charAt(i) >= '0' && username.charAt(i) <= '9') {
                if(ch > '9') {
                    ch = (char) (47+(ch-'9'));
                }
            }
            temp.setCharAt(i,ch);
        }

        return "Kay be RUDRA"+ temp + "RUDRA"+random.nextGaussian()+"samapti"+ LocalDate.now().plusDays(7);
    }

    @Transactional
    public User decryptToken(String token) {

        int index = token.indexOf("samapti")+7;
        LocalDate time = LocalDate.parse(token.substring(index));

        if(LocalDate.now().isAfter(time)) {
            throw new IllegalStateException("Token Expired");
        }

        String[] arr = token.split("RUDRA");

        StringBuilder sb = new StringBuilder(arr[1]);

//        String pattern = "^[a-z0-9._]+$";
//        Pattern regex = Pattern.compile(pattern);
//        Matcher matcher = regex.matcher(arr[1]);
//        if(!matcher.matches()) {
//            throw new IllegalStateException("Username is not valid");
//        }

        for(int i = 0; i < arr[1].length(); i++) {

            char ch = arr[1].charAt(i);
            if((((i*i*i*i)+2904)&1) == 0) ch -= 1;
            if(arr[1].charAt(i) >= 'a' && arr[1].charAt(i) <= 'z') {
                if(ch < 'a') {
                    ch = (char) (123-('a'-ch));
                }
            } else if(arr[1].charAt(i) >= '0' && arr[1].charAt(i) <= '9') {
                if(ch < '0') {
                    ch = (char) (58-('0'-ch));
                }
            }
            sb.setCharAt(i,ch);
        }
        return userRepository.findByUserName(sb.toString());
    }

    public String getAuthorizationHeader() {
        return HttpHeaders.AUTHORIZATION;
    }
}
