<?php

namespace Tests;

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

abstract class TestCase extends BaseTestCase
{
  // use CreatesApplication;
  use CreatesApplication, DatabaseTransactions, DatabaseMigrations;

    public function Contact(): ContactBuilder{
        return new ContactBuilder;
    }

    public function Address(): AddressBuilder{
        return new AddressBuilder;
    }

    public function Chat(): ChatBuilder{
        return new ChatBuilder;
    }

    public function ChatFile(): ChatFileBuilder{
        return new ChatFileBuilder;
    }

    public function Help(): HelpBuilder{
        return new HelpBuilder;
    }

    public function HelpRequest(): HelpRequestBuilder{
        return new HelpRequestBuilder;
    }

    public function LegalPerson(): LegalPersonBuilder{
        return new LegalPersonBuilder;
    }
    
    public function PhysicalPerson(): PhysicalPersonBuilder{
        return new PhysicalPersonBuilder;
    }

    public function PurchaseItem(): PurchaseItemBuilder{
        return new PurchaseItemBuilder;
    }

    public function Requester(): RequesterBuilder{
        return new RequesterBuilder;
    }

    public function Tenant(): TenantBuilder{
        return new TenantBuilder;
    }
}