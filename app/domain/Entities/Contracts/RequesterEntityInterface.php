<?php

namespace Domain\Entities\Contracts;

interface RequesterEntityInterface
{
    public function rules();
    public function helpRequests();
    public function personable();
    public function contact();
    public function addresses();

}
