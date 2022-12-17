<?php

namespace App\Services;

use App\Models\Play;
use App\Models\User;

class PlaysService
{
    public function store(int $userId)
    {
        $number = rand(1, 1000);
        $isWin = $this->checkIfWin($number);
        if ($isWin) {
            $price = $this->calculatePrice($number);
        }else{
            $price = 0;
        }

        return Play::create([
            'user_id' => $userId,
            'number' => $number,
            'is_win' => $isWin,
            'price' => $price,
        ]);

    }

    private function checkIfWin(int $number): bool
    {
        if ($number % 2 == 0) {
            return true;
        } else {
            return false;
        }
    }

    private function calculatePrice(int $number): int
    {
        if ($number > 900) {
            return ($number / 100) * 70;
        } elseif ($number > 600) {
            return ($number / 100) * 50;
        } elseif ($number > 300) {
            return ($number / 100) * 30;
        } elseif ($number < 300) {
            return ($number / 100) * 10;
        }
    }

    public function getHistory(int $userId)
    {
        return Play::where('user_id', $userId)->take(3)->orderBy('id', 'desc')->get();
    }


}
