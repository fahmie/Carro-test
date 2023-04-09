<?php

namespace App\Services\InternetServiceProvider;

interface InternetServiceProviderInterface
{
    public function setMonth($month);

    public function calculateTotalAmount();
}