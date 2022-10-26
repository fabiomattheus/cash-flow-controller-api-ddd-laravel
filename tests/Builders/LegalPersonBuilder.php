<?php

namespace Tests\Builders;

use Domain\Entities\LegalPerson;

class LegalPersonBuilder
{
    protected $attributes = [];

    public function setCorporateName($corporate_name = null): self
    {
        $this->attributes['corporate_name'] = $corporate_name;
        return $this;
    }

    public function setFantasyName($fantasy_name = null): self
    {
        $this->attributes['fantasy_name'] = $fantasy_name;
        return $this;
    }

    public function setId($id = null): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function setCnpj($cnpj = null): self
    {
        $this->attributes['cnpj'] = $cnpj;
        return $this;
    }

    public function setStateRegistration($stateRegistration = null): self
    {
        $this->attributes['stateRegistration'] = $stateRegistration;
        return $this;
    }

    public function create($quantity = null)
    {
        return LegalPerson::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return LegalPerson::factory($quantity)->make($this->attributes);
    }
}
