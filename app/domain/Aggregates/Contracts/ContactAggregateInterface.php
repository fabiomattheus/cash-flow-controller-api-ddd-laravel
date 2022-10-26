<?php

namespace Domain\Aggregates\Contracts;

interface ContactAggregateInterface
{
    public function rules();
    public function contactable();
}
