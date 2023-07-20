<?php

namespace Bank;

use Bank\Bank;

class Account
{
    private Bank $bank;
    private int $accountId;
    private string $mainCurrency;
    private array $currencyList = [
        'RUB' => 'рубль',
        'USD' => 'доллар',
        'EUR' => 'евро',
    ];

    public function __construct(int $accountId = null)
    {
        if ($accountId) {
            $this->accountId = $accountId;
            $this->mainCurrency = ''; //db get main currency of this acc
            $this->currencyList = []; //db->getCurrencyList($this->accountId) ?? [];
        } else {
            //insert new account in db
            $this->accountId = ''; //db get id
            $this->mainCurrency = ''; //db get default main currency
        }

        $this->bank = new Bank();
    }

    public function addCurrency(string $currencyCode): bool
    {
        $currencyName = $this->bank->checkCurrency($currencyCode);
        //db->add currency $currencyCode to account()
        $this->currencyList[$currencyCode] = $currencyName;

        return true;
    }

    public function removeCurrency(string $currencyCode): bool
    {
        if ($currencyCode !== $this->mainCurrency) { //переводим деньги на основной счет
            $balance = $this->getAccountBalance($currencyCode);
            $exchangeRatio = $this->bank->getExchangeRate($currencyCode, $this->mainCurrency);
            $this->putMoneyInAccount($this->mainCurrency, $balance * $exchangeRatio);
        }

        //db->remove currency $currencyCode from account()
        unset($this->currencyList[$currencyCode]);

        return true;
    }

    public function setMainCurrency(string $currencyCode): bool
    {
        $this->bank->checkCurrency($currencyCode);
        $this->checkCurrency($currencyCode);
        //db->set as main acc $currencyCode()
        $this->mainCurrency = $currencyCode;

        return true;
    }

    public function getCurrencyList(): array
    {
        return $this->currencyList;
    }

    public function putMoneyInAccount(string $currencyCode, float $amount): void
    {
        $balance = $this->getAccountBalance($currencyCode);
        $balance += $amount;
        //db->write new balance($balance)
    }

    public function getMoneyFromAccount(string $currencyCode, float $amount): bool
    {
        $balance = $this->getAccountBalance();

        if ($amount <= $balance) {
            $newBalance = $balance - $amount;
            //db->writeNewBalance();
        } else {
            throw NotEnoughtMoneyExcption(); //у клиента недостаточно денег
        }

        return true;
    }

    public function getAccountBalance(string $currencyCode = null): float
    {
        $currencyCode = $currencyCode ?? $this->mainCurrency;
        $this->checkCurrency($currencyCode);

        return 0.00; //db->getAccountBalance($this->accountId, $currencyCode);
    }

    public function getFullAccountBalance(string $currencyCode = null): float
    {
        $currencyCode = $currencyCode ?? $this->mainCurrency;
        $this->checkCurrency($currencyCode);
        $sum = 0.00;

        foreach ($this->currencyList as $code => $name) {
            $balance = $this->getAccountBalance($code);
            $sum += $balance * $this->bank->getExchangeRate($currencyCode, $code);
        }

        return $sum;
    }

    private function checkCurrency(string $currencyCode): void
    {
        if (!isset($this->currencyList[$currencyCode])) {
            throw NotFoundExcption(); //у клиента нет счета в такой валюте
        }
    }
}