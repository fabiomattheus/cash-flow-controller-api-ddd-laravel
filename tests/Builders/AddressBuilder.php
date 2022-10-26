<?php

namespace Tests\Builders;

use Domain\Aggregates\Address;

class AddressBuilder
{
    protected $attributes = [];

    public function setId($id = null): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function setStreet($street = null): self
    {
        $this->attributes['street'] = $street;
        return $this;
    }

    public function setDistrict($district = null): self
    {
        $this->attributes['district'] = $district;
        return $this;
    }

    public function setLat($lat = null): self
    {
        $this->attributes['lat'] = $lat;
        return $this;
    }

    public function setLong($long = null): self
    {
        $this->attributes['long'] = $long;
        return $this;
    }

    public function setZipCode($zip_code = null): self
    {
        $this->attributes['zip_code'] = $zip_code;
        return $this;
    }

    public function setComplement($complement = null): self
    {
        $this->attributes['complement'] = $complement;
        return $this;
    }


    public function setNumber($number = null): self
    {
        $this->attributes['number'] = $number;
        return $this;
    }



    public function setCity($city = null): self
    {
        $this->attributes['city'] = $city;
        return $this;
    }



    public function setState($state = null): self
    {
        $this->attributes['state'] = $state;
        return $this;
    }



    public function setType($type = null): self
    {
        $this->attributes['type'] = $type;
        return $this;
    }

    public function setAddressableType($type = null): self
    {
        $this->attributes['addressable_type'] = $type;
        return $this;
    }

    public function setAddressableId($id = null): self
    {
        $this->attributes['addressable_id'] = $id;
        return $this;
    }

    public function create($quantity = null)
    {
        return Address::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return Address::factory($quantity)->make($this->attributes);
    }
}
