<?php

namespace Bank;

class Account
{
    private Bank $bank;
    private int $accountId;
    private string $mainCurrency;
    private array $currencyList = [];

    public function __construct(int $accountId = null)
    {
        if ($accountId) {
            $this->accountId = $accountId;
            $this->mainCurrency = ''; //db get main currency of this acc
            $this->currencyList = []; //db get currency list of this acc
        } else {
            $this->mainCurrency = ''; //db get default main currency
        }

        $this->bank = new Bank();
    }

    public function addCurrency(string $currencyCode): bool
    {
        try {
            //add currency $currencyCode to account - err if no this currency code in db
        } catch (\Throwable $exception) {
            throw NotFoundExcption();
        }

        return true;
    }

    public function removeCurrency(string $currencyCode): bool
    {
        try {
            //remove currency $currencyCode from account - err if no this currency code in db
        } catch (\Throwable $exception) {
            throw NotFoundExcption();
        }

        return true;
    }

    public function setMainCurrency(string $currencyCode): bool
    {
        try {
            //set as main $currencyCode
        } catch (\Throwable $exception) {
            throw NotFoundExcption();
        }

        return true;
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

    public function putMoneyInAccount(string $currencyCode, float $amount): bool
    {
        if (isset($this->currencyList[$currencyCode])) {
            try {
                $balance = 0;//get from db
                $balance += $amount;
                //db->write new $balance
            } catch (\Throwable $exception) {
                throw NotFoundExcption();
            }

            return true;
        }

        return false;
    }

    public function getAccountBalance(string $currencyCode = null): float
    {
        $currencyCode = $currencyCode ?? $this->mainCurrency;

        if (!isset($this->currencyList[$currencyCode])) {
            throw NotFoundExcption();
        }

        return $balance = 0.00; //db->getAccountBalance($this->accountId, $currencyCode);
    }

    public function getFullAccountBalance(string $currencyCode = null): float
    {
        $currencyCode = $currencyCode ?? $this->mainCurrency;

        if (!isset($this->currencyList[$currencyCode])) {
            throw NotFoundExcption(); //у клиента нет счета в такой валюте
        }

        $sum = 0.00;

        foreach ($this->currencyList as $code => $name) {
            $balance = $this->getAccountBalance($code);
            $sum += $balance * $this->bank->getExchangeRate($currencyCode, $code);
        }

        return $sum;
    }
}