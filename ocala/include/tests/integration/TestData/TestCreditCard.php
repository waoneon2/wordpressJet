<?php

class TestCreditCard
{
    public static function validVisaCreditCard()
    {
        $validVisaCreditCard = new HpsCreditCard();
        $validVisaCreditCard->cvv = "123";
        $validVisaCreditCard->expMonth = "12";
        $validVisaCreditCard->expYear = "2025";
        $validVisaCreditCard->number = "4012002000060016";
        return $validVisaCreditCard;
    }
    public static function validVisaMUT()
    {
        return "CT25M708HKe55S4a613i0016";
    }


    public static function validMastercardCreditCard()
    {
        $creditCard = new HpsCreditCard();
        $creditCard->cvv = "123";
        $creditCard->expMonth = "12";
        $creditCard->expYear = "2025";
        $creditCard->number = "5473500000000014";
        return $creditCard;
    }
    public static function validMastercardMUT()
    {
        return "w4nucu08708ScCxlFCPM0014";
    }

    public static function validDiscoverCreditCard()
    {
        $creditCard = new HpsCreditCard();
        $creditCard->cvv = "123";
        $creditCard->expMonth = "12";
        $creditCard->expYear = "2025";
        $creditCard->number = "6011000990156527";
        return $creditCard;
    }

    public static function validDiscoverMUT()
    {
        return "Hl4mgB08bzY3CEIoHfaa6527";
    }
    public static function validAmexCreditCard()
    {
        $creditCard = new HpsCreditCard();
        $creditCard->cvv = "1234";
        $creditCard->expMonth = "12";
        $creditCard->expYear = "2025";
        $creditCard->number = "372700699251018";
        return $creditCard;
    }
    public static function validAmexMUT()
    {
        return "DhIQTo08cwS7f5NG5dHC1018";
    }

    public static function validJCBCreditCard()
    {
        $creditCard = new HpsCreditCard();
        $creditCard->cvv = "123";
        $creditCard->expMonth = "12";
        $creditCard->expYear = "2025";
        $creditCard->number = "3566007770007321";
        return $creditCard;
    }

    public static function invalidCreditCard()
    {
        $creditCard = new HpsCreditCard();
        $creditCard->cvv = "123";
        $creditCard->expMonth = "12";
        $creditCard->expYear = "2025";
        $creditCard->number = "12345";
        return $creditCard;
    }
    public static function invalidMUT()
    {
        return "Hl4mgB08bzY3CEIoHfsdfsdfdsfaa6527";
    }
    public static function NullMUT()
    {
        return null;
    }

    public static function validCreditCardWithBlankExpMonth()
    {
        $validVisaCreditCard = new HpsCreditCard();
        $validVisaCreditCard->cvv = "123";
        $validVisaCreditCard->expMonth = "";
        $validVisaCreditCard->expYear = "2025";
        $validVisaCreditCard->number = "4012002000060016";
        return $validVisaCreditCard;
    }

    public static function validGsbCardEcommerce()
    {
        $card = new HpsCreditCard();
        $card->number = '6277220572999800';
        $card->expMonth = "12";
        $card->expYear = "2049";

        return $card;
    }
}
