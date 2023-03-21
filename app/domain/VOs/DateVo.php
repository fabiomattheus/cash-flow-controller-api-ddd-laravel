<?php

namespace Domain\VOs;
use Domain\VOs\AbstractValueObject;
use Domain\VOs\Contracts\DateVOInterface;

class DateVo extends AbstractValueObject implements DateVOInterface
{
    /**
     * Rules
     *
     * @var array
     */
    public $rules = [
        'initialDate' => 'required|date',
        'finalDate' => 'nullable|date',
    ];
}
