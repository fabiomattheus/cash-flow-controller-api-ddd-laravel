<?php

namespace Tests\Builders;

use Domain\Aggregates\Chat;

class ChatBuilder
{
    protected $attributes = [];

    public function setId($id = null): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function setNote($note = null): self
    {
        $this->attributes['note'] = $note;
        return $this;
    }

    public function setHelpRequestId($helpRequestId = null): self
    {
        $this->attributes['help_request_id'] = $helpRequestId;
        return $this;
    }

    public function create($quantity = null)
    {
        return Chat::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return Chat::factory($quantity)->make($this->attributes);
    }
}
