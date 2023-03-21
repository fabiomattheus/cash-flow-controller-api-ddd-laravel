<?php

namespace Tests\Builders;

use Domain\Aggregates\OperationType;

class OperationTypeBuilder
{
    protected $attributes = [];
    
    public function setId($id = null): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function setLabel($label = null): self
    {
        $this->attributes['label'] = $label;
        return $this;
    }

    public function setDescription($description = null): self
    {
        $this->attributes['description'] = $description;
        return $this;
    }
    
    public function create($quantity = null)
    {
        return OperationType::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return OperationType::factory($quantity)->make($this->attributes);
    }
}
