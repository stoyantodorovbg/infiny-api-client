<?php

namespace App\Data\Interfaces;

interface MassStore
{
    /**
     * Provides a format for mass store
     *
     * @return array
     */
    public function massStoreFormat(): array;
}
