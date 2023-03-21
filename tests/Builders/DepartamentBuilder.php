<?php

namespace Tests\Builders;

use Domain\Entities\Departament;

class DepartamentBuilder
{
    protected $attributes = [];
    
    public function setId($id = null): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }
    
    public function setTitle($title = null): self
    {
        $this->attributes['title'] = $title;
        return $this;
    }
    
    public function create($quantity = null)
    {
        return Departament::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return Departament::factory($quantity)->make($this->attributes);
    }
}
