<?php

namespace App\Models\Enum;

use App\Interfaces\HasLabel;

enum ClientEnvironment: int implements HasLabel
{
    case DEMO = 1;

    public function label(): string
    {
        return ucfirst(strtolower($this->name));
    }
}
