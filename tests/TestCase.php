<?php

namespace Tests;

use Domain\Aggregates\CashFlowBalance;
use Domain\Entities\CashFlow;
use Domain\Entities\Departament;
use Tests\Builders\ChatBuilder;
use Tests\Builders\HelpBuilder;
use Tests\Builders\TenantBuilder;
use Tests\Builders\AddressBuilder;
use Tests\Builders\ContactBuilder;
use Tests\Builders\ChatFileBuilder;
use Tests\Builders\RequesterBuilder;
use Tests\Builders\HelpRequestBuilder;
use Tests\Builders\LegalPersonBuilder;
use Tests\Builders\PurchaseItemBuilder;
use Tests\Builders\PhysicalPersonBuilder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Builders\CashFlowBalanceBuilder;
use Tests\Builders\CashFlowBuilder;
use Tests\Builders\DepartamentBuilder;
use Tests\Builders\EmployeeBuilder;
use Tests\Builders\OperationTypeBuilder;

abstract class TestCase extends BaseTestCase
{
  // use CreatesApplication;
  use CreatesApplication, DatabaseTransactions, DatabaseMigrations;

    public function CashFlow(): CashFlowBuilder{
        return new CashFlowBuilder;
    }

    public function cashFlowBalance(): CashFlowBalanceBuilder{
        return new CashFlowBalanceBuilder();
    }

    public function Departament(): DepartamentBuilder{
        return new DepartamentBuilder;
    }

    public function operationType(): OperationTypeBuilder{
        return new OperationTypeBuilder;
    }

    public function employee(): EmployeeBuilder{
        return new EmployeeBuilder;
    }
}