<?php

namespace App\Service;

class RandomNumber
{
    public function getRandomNumber()
    {
        return rand(1, 100);
    }
}