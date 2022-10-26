<?php

namespace Tests\Builders;

use Domain\Entities\PhysicalPerson;

class PhysicalPersonBuilder
{
    protected $attributes = [];

    public function setName($name = null): self
    {
        $this->attributes['name'] = $name;
        return $this;
    }

    public function setLastName($last_name = null): self
    {
        $this->attributes['last_name'] = $last_name;
        return $this;
    }

    public function setCpf($cpf = null): self
    {
        $this->attributes['cpf'] = $cpf;
        return $this;
    }

    public function setId($id = null): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function setMotherName($mother_name = null): self
    {
        $this->attributes['mother_name'] = $mother_name;
        return $this;
    }

    public function setFatherName($father_name = null): self
    {
        $this->attributes['father_name'] = $father_name;
        return $this;
    }

    public function setBirthDate($birth_date = null): self
    {
        $this->attributes['birth_date'] = $birth_date;
        return $this;
    }

    public function create($quantity = null)
    {
        return PhysicalPerson::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return PhysicalPerson::factory($quantity)->make($this->attributes);
    }
}
