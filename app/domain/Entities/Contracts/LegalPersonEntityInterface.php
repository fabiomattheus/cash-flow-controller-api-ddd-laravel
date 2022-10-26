<?php

namespace Domain\Entities\Contracts;

interface LegalPersonEntityInterface
{
    public function rules();
    public function requester();
    public function tenant();

}
