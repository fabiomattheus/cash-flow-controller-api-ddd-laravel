<?php

namespace Domain\Dto\Contracts;

interface DtoInterface
{
    public static function fromRequest($model, bool $isAggregate = false);
    public static function toJson(int $statusCode,  String $message, Iterable $response = []);
}