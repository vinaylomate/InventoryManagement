package com.smit.rar;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.autoconfigure.security.servlet.UserDetailsServiceAutoConfiguration;
import org.springframework.context.annotation.Bean;
import org.springframework.web.SpringServletContainerInitializer;
import org.springframework.web.filter.CorsFilter;
import org.springframework.web.cors.CorsConfiguration;
import org.springframework.web.cors.UrlBasedCorsConfigurationSource;
import org.springframework.web.servlet.config.annotation.CorsRegistry;


@SpringBootApplication(exclude= {UserDetailsServiceAutoConfiguration.class})
public class RarApplication {

    public static void main(String[] args) {
		SpringApplication.run(RarApplication.class, args);
	}
}
