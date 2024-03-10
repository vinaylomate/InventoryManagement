package com.smit.rar.security.jwt;

import com.google.common.base.Strings;
import com.smit.rar.model.User;
import com.sun.istack.NotNull;
import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.EqualsAndHashCode;
import lombok.extern.slf4j.Slf4j;

import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.web.authentication.WebAuthenticationDetailsSource;
import org.springframework.web.filter.OncePerRequestFilter;

import javax.servlet.FilterChain;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;

@EqualsAndHashCode(callSuper = true)
@Data
@Builder
@AllArgsConstructor
@Slf4j
public class JwtTokenVerifier extends OncePerRequestFilter {

    private final JwtService jwtService;
    private final TokenEncryptDecrypt tokenEncryptDecrypt;

    @Override
    protected void doFilterInternal(HttpServletRequest request,
                                    @NotNull HttpServletResponse response,
                                    @NotNull FilterChain filterChain) throws ServletException, IOException {

        String authorizationHeader = request.getHeader(jwtService.getAuthorizationHeader());

        authorizationHeader = tokenEncryptDecrypt.decrypt(authorizationHeader);

        log.info(authorizationHeader);

        if (Strings.isNullOrEmpty(authorizationHeader) || !authorizationHeader.startsWith("Kay be ")) {
            filterChain.doFilter(request, response);
            return;
        }

        String token = null;

        token = authorizationHeader.replace("Kay be ", "");

        User user = jwtService.decryptToken(token);

        if(user == null) throw new IllegalStateException(String.format("Token %s cannot be trusted ", token));

        UsernamePasswordAuthenticationToken usernamePasswordAuthenticationToken
                = new UsernamePasswordAuthenticationToken(user, null, null);

        // to get request information
        usernamePasswordAuthenticationToken.setDetails(new WebAuthenticationDetailsSource().buildDetails(request));

        SecurityContextHolder.getContext().setAuthentication(usernamePasswordAuthenticationToken);

        filterChain.doFilter(request,response);
    }
}
