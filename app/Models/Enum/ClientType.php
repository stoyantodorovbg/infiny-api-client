<?php

namespace App\Models\Enum;

use App\Interfaces\HasLabel;

enum ClientType: string implements HasLabel
{
    case EPSILON = 'epsilon';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
