<?php

namespace App;

class Cart
{

    public static function totalItems()
    {
        if(session()->has('cartItems')) {
            return count(session('cartItems'));
        }

        return 0;

    }

    public static function totalPrice()
    {
        $totalPrice = 0;

        if (session()->has('cartItems')) {

            $allItems = session('cartItems');

            foreach($allItems as $item) {
                $totalPrice = $totalPrice + $item['price'];
            }

        }

        return $totalPrice;
    }
}
