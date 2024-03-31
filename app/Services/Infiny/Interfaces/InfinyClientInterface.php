<?php

namespace App\Services\Infiny\Interfaces;

use Illuminate\Http\Client\Response;

interface InfinyClientInterface
{
    /**
     * Get Services
     *
     * @return Response
     */
    public function services(): Response;

    /**
     * Get Service details
     *
     * @param int $serviceId
     * @return Response
     */
    public function serviceDetails(int $serviceId): Response;
}
