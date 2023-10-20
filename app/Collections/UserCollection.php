<?php

namespace App\Collections;

use App\Models\User;

class UserCollection extends TypedCollection
{
    protected string $type = User::class;
}