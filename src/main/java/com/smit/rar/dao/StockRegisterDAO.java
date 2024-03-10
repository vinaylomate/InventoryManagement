package com.smit.rar.dao;

import com.smit.rar.model.StockRegister;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import java.util.List;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
public class StockRegisterDAO {

    List<StockRegister> stocks;
}
