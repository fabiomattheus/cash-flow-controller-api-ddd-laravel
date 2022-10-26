<?php

namespace Tests\Builders;

use Domain\Aggregates\Contact;

class ContactBuilder
{
    protected $attributes = [];

    public function setPhone($phone = null): self
    {
        $this->attributes['phone'] = $phone;
        return $this;
    }

    public function setCellPhone($cellPhone = null): self
    {
        $this->attributes['cell_phone'] = $cellPhone;
        return $this;
    }

    public function setEmail($email = null): self
    {
        $this->attributes['email'] = $email;
        return $this;
    }

    public function setContactableType($contactableType = null): self
    {
        $this->attributes['contactable_type'] = $contactableType;
        return $this;
    }

    public function setContactableId($contactableId = null): self
    {
        $this->attributes['contactable_id'] = $contactableId;
        return $this;
    }

    public function setId($id = null): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function create($quantity = null)
    {
        return Contact::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return Contact::factory($quantity)->make($this->attributes);
    }
}
