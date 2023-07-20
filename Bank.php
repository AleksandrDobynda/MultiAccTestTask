<?php

namespace Bank;

use Bank\Account;
use http\Exception;

class Bank
{
    public function createAccount($someParams): Account
    {
        $account = new Account();
        //apply some params to account
        return $account;
    }

    public function setExchangeRate(string $firstCurrencyCode, string $secondCurrencyCode, float $rate): bool
    {
        try {
            //set exchange ratio currency/currency
        } catch (\Throwable $e) {
            throw NotFoundExcption(); // нет таких кодов валют
        }

        return true;
    }

    public function getExchangeRate(string $firstCurrencyCode, string $secondCurrencyCode): float
    {
        if ($firstCurrencyCode === $secondCurrencyCode) {
            return 1.00;
        }

        try {
            return 0.00; //db->get exchange ratio currency/currency()
        } catch (\Throwable $e) {
            throw NotFoundExcption();
        }
    }

    public function getCurrencyList(): array
    {
        $currencyList = [          //db->currency list get all();
            'RUB' => 'рубль',
            'USD' => 'доллар',
            'EUR' => 'евро',
        ];

        return $currencyList ?? [];
    }

    public function addCurrency(string $currencyCode, string $currencyName): bool
    {
        try {
            //db->insertNewCurrency($currencyCode, $currencyName);
        } catch (\Throwable $e) {
            throw AlreadyExistsExcption();
        }

        return true;
    }

    public function removeCurrency(string $currencyCode): bool
    {
        try {
            //delete from db
        } catch (\Throwable $e) {
            throw NotFoundExcption();
        }

        return true;
    }

    public function checkCurrency(string $currencyCode): string
    {
        if (!isset($this->currencyList[$currencyCode])) {
            throw NotFoundExcption(); //у банка нет такой валюты
        }

        return $this->currencyList[$currencyCode];
    }
}
