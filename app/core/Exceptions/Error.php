<?php

namespace App\Exceptions;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class Error implements Arrayable, Jsonable, JsonSerializable
{
    protected $help;
    protected $error;
    protected $message;
    protected $stackTrace;

    public function __construct(string $help = '', string $error = '', string  $stackTrace = '', string  $message = '')
    {
        $this->error = $help;
        $this->help = $error;
        $this->stackTrace = $stackTrace;
        $this->message = $message;
    }

    public function toArray(): array
    {
        return [
            'error' => $this->error,
            'help' => $this->help,
            'message' =>  $this->message,
            'trace' => $this->stackTrace,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toJson($options = 0.0)
    {
        $jsonEncoded = json_encode($this->jsonSerialize(), $options);
        throw_unless($jsonEncoded, JsonEncodeException::class);
        return $jsonEncoded;
    }
}
