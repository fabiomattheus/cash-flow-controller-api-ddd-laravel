<?php

namespace Tests\Builders;

use Domain\Entities\HelpRequest;

class HelpRequestBuilder
{
    protected $attributes = [];

    public function setIdentifier($identifier = null): self
    {
        $this->attributes['identifier'] = $identifier;
        return $this;
    }

    public function setStatus($status = null): self
    {
        $this->attributes['status'] = $status;
        return $this;
    }

    public function setId($id = null): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function setHelpId($help_id = null): self
    {
        $this->attributes['help_id'] = $help_id;
        return $this;
    }

    public function setRequesterId($requester_id = null): self
    {
        $this->attributes['requester_id'] = $requester_id;
        return $this;
    }

    public function setPurchaseItemId($purchase_item_id = null): self
    {
        $this->attributes['purchase_item_id'] = $purchase_item_id;
        return $this;
    }

    public function create($quantity = null)
    {
        return HelpRequest::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return HelpRequest::factory($quantity)->make($this->attributes);
    }
}
