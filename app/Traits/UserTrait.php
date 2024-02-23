<?php

namespace App\Traits;

trait UserTrait
{

    public function generateUserName()
    {
        return rand(1000000000, 9999999999);
    }
}
