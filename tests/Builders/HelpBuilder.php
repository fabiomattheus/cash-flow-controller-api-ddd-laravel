<?php

namespace Tests\Builders;

use Domain\Entities\Help;

class HelpBuilder
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

    public function setRequisitionType($requisitionType = null): self
    {
        $this->attributes['requisition_type'] = $requisitionType;
        return $this;
    }
    public function setParentId($parentId = null): self
    {
        $this->attributes['parent_id'] = $parentId;
        return $this;
    }

    public function setDescription($description = null): self
    {
        $this->attributes['description'] = $description;
        return $this;
    }

    public function setType($type = null): self
    {
        $this->attributes['type'] = $type;
        return $this;
    }



    public function create($quantity = null)
    {
        return Help::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return Help::factory($quantity)->make($this->attributes);
    }
}
