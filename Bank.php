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
            Throw NotFoundExcption();
        }

        return true;
    }

    public function getExchangeRate(string $firstCurrencyCode, string $secondCurrencyCode): float
    {
        if ($firstCurrencyCode === $secondCurrencyCode) {
            return 1.00;
        }

        try {
            return 0.00; //get exchange ratio currency/currency
        } catch (\Throwable $e) {
            Throw NotFoundExcption();
        }
    }

    public function getCurrencyList(): array
    {
        //get from db
        $currencyList = [
            'RUB' => 'рубль',
            'USD' => 'доллар',
            'EUR' => 'евро',
        ];

        return $currencyList ?? [];
    }

    public function addCurrency(string $currencyCode, string $currencyName): bool
    {
        try {
            //add
        } catch (\Throwable $e) {
            Throw NotFoundExcption();
        }

        return true;
    }

    public function removeCurrency(string $currencyCode): bool
    {
        try {
            //delete from db
        } catch (\Throwable $e) {
            Throw NotFoundExcption();
        }

        return true;
    }
}