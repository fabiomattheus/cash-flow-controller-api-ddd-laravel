<?php

namespace Tests\Builders;

use Domain\Aggregates\CashFlowBalance;

class CashFlowBalanceBuilder
{
    protected $attributes = [];

    public function setBalance($balance = null): self
    {
        $this->attributes['balance'] = $balance;
        return $this;
    }
    
    public function setCashFlowId($cashFlowId = null): self
    {
        $this->attributes['cash_flow_id'] = $cashFlowId;
        return $this;
    }

    public function setId($id = null): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function create($quantity = null)
    {
        return CashFlowBalance::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return CashFlowBalance::factory($quantity)->make($this->attributes);
    }
}
