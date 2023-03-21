<?php

namespace Domain\VOs;
use Domain\VOs\AbstractValueObject;
use Domain\VOs\Contracts\IdentifierVOInterface;

class IdentifierVO extends AbstractValueObject implements IdentifierVOInterface
{
    /**
     * Rules
     *
     * @var array
     */
    public $rules = [
        'identifier' => 'required|string',
    ];
}
