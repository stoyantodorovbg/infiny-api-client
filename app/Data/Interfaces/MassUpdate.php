<?php

namespace App\Data\Interfaces;

interface MassUpdate
{
    /**
     * Provides a format for mass update
     *
     * @return array
     */
    public function massUpdateFormat(): array;
}
