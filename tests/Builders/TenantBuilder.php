<?php

namespace Tests\Builders;


use Domain\Aggregates\Tenant;

class TenantBuilder
{
    protected $attributes = [];

    public function setLogo($logo = null): self
    {
        $this->attributes['logo'] = $logo;
        return $this;
    }

    public function setId($id = null): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function setPersonableId($personable_id = null): self
    {
        $this->attributes['personable_id'] = $personable_id;
        return $this;
    }

    public function setPersonableType($personable_type = null): self
    {
        $this->attributes['personable_type'] = $personable_type;
        return $this;
    }

    public function create($quantity = null)
    {
        return Tenant::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return Tenant::factory($quantity)->make($this->attributes);
    }
}
