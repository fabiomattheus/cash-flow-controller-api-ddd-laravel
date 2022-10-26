<?php

namespace Domain\VOs;
use Domain\VOs\AbstractValueObject;
use Domain\VOs\Contracts\IdVoInterface ;

class IdVo extends AbstractValueObject implements IdVoInterface
{
    /**
     * Rules
     *
     * @var array
     */
    public $rules = [
        'id' => 'required|string',
    ];
}
