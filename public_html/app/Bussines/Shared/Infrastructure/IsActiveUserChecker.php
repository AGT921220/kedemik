<?php

namespace App\Bussines\Shared\Infrastructure;

class IsActiveUserChecker
{
    public function __invoke()
    {
        if (auth()->user()) {
            return true;
        }
        return false;
    }
}
