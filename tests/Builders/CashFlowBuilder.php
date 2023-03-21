<?php

namespace Tests\Builders;

use Domain\Entities\CashFlow;

class CashFlowBuilder
{
    protected $attributes = [];

    public function setIdentifier($identifier = null): self
    {
        $this->attributes['identifier'] = $identifier;
        return $this;
    }

    public function setDescription($description = null): self
    {
        $this->attributes['description'] = $description;
        return $this;
    }

    public function setNote($note = null): self
    {
        $this->attributes['note'] = $note;
        return $this;
    }

    public function setType($type = null): self
    {
        $this->attributes['type'] = $type;
        return $this;
    }

    public function setValue($value = null): self
    {
        $this->attributes['value'] = $value;
        return $this;
    }

    public function setMovimentationDate($movimentationDate = null): self
    {
        $this->attributes['movimentation_date'] = $movimentationDate;
        return $this;
    }

    public function setEmployeeId($employeeId = null): self
    {
        $this->attributes['employee_id'] = $employeeId;
        return $this;
    }

    public function setOperationTypeId($operationTypeId = null): self
    {
        $this->attributes['operation_type_id'] = $operationTypeId;
        return $this;
    }

    public function setDepartamentId($departamentId = null): self
    {
        $this->attributes['departament_id'] = $departamentId;
        return $this;
    }

    public function create($quantity = null)
    {
        return CashFlow::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return CashFlow::factory($quantity)->make($this->attributes);
    }
}
