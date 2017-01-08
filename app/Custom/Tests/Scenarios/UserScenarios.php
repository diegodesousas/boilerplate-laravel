<?php

namespace App\Custom\Tests\Scenarios;

use App\Model\User;

class UserScenarios
{
    public function user($attributes = [])
    {
        return factory(User::class)->create($attributes);
    }
}