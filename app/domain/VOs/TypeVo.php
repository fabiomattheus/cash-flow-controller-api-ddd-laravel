<?php

namespace Domain\VOs;

use Domain\VOs\AbstractValueObject;
use Domain\VOs\Contracts\TypeVoInterface ;

class TypeVo extends AbstractValueObject implements TypeVoInterface
{
    /**
     * Rules
     *
     * @var array
     */
    public $rules = [      
       'type' => 'required|in:all,credit,debit',
    ];
}
