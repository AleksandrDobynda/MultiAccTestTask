<?php

namespace Bank\Tests;

use Bank\Account;
use Bank\Bank;

class BankTest
{
    private Bank $bank;
    private Account $account;

    public function __construct()
    {
        $this->bank = new Bank();
        //подгрузка тестовой бд/моков
    }

    public function testSetExchangeRate()
    {
        //1. передаем параметры в неподходящего типа, проверям наличие соответствующей ошбки
        //2. передаем код валюты которой нет в банке - ловим ошибку
        //3. передаем неверный код валюты  - ловим ошибку
        //4. проверяем как прошла запись в бд - требуемое значение
    }

    public function testGetExchangeRate()
    {
        //1. передаем параметры в неподходящего типа, проверям наличие соответствующей ошбки
        //2. передаем код валюты которой нет в банке - ловим ошибку
        //3. передаем неверный код валюты  - ловим ошибку
        //4. проверка соответствия значения в тестовой базе/моке и того что мы получаем от $this->bank->getExchangeRate();
    }

    public function testGetCurrencyList()
    {
        //1. Проверяем что мы получаем тип данных - массив в при разных заполненных данных в моках/тестовой базе
        //2. Проверяем соответствие данных в тестовой базе и полученном масииве
    }

    public function testAddCurrency()
    {
        //1. передаем параметры в неподходящего типа, проверям наличие соответствующей ошбки
        //2. передаем код валюты которой нет в банке - ловим ошибку
        //3. передаем неверный код валюты  - ловим ошибку
    }

    public function testRemoveCurrency()
    {
        //1. передаем параметры в неподходящего типа, проверям наличие соответствующей ошбки
        //2. передаем код валюты которой нет в банке - ловим ошибку
        //3. передаем неверный код валюты  - ловим ошибку
        //4. тут еще зависит от требований бизнес логики - разрешено ли удаление пока есть счета людей в этой валюте
        // и требуемая обработка такой ситуации
    }

    public function testСheckCurrency()
    {
        //1. передаем параметры в неподходящего типа, проверям наличие соответствующей ошбки
        //2. передаем код валюты которой нет в банке - ловим ошибку
        //3. передаем неверный код валюты  - ловим ошибку
    }
}
