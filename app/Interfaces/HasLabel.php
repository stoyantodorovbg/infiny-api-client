<?php

namespace App\Interfaces;

interface HasLabel
{
    /**
     * Label text
     *
     * @return string
     */
    public function label(): string;
}
