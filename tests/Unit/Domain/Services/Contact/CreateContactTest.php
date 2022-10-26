<?php

namespace Tests\Unit\Domain\Services\Contact;

use Domain\Aggregates\Contracts\ContactAggregateInterface;
use Domain\Repositories\ContactRepositoryInterface;
use Domain\Services\Contact\CreateContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;
use Domain\Dto\Contracts\DtoInterface;

class CreateContactTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = Mockery::mock(stdClass::class, ContactRepositoryInterface::class);
        $this->contactMock = Mockery::mock(stdClass::class, ContactAggregateInterface::class);
        $this->dto = Mockery::mock(stdClass::class, 'alias:DtoInterface');
        $this->request = new Request();
        $this->createContact = new CreateContact(
            $this->repositoryMock,
            $this->contactMock
        );
    }

    public function testCreateContactsDomain()
    {
        $this->request->merge(
            ['contacts' => ['anything'],]
        );
        App::shouldReceive('make')
            ->once()
            ->andReturn($this->request);
        App::shouldReceive('makeWith')
            ->once()
            ->andReturn($this->dto);

        $this->dto->shouldReceive('fromRequest')
            ->andReturn(['anything' => 'anything']);

        $this->repositoryMock->shouldReceive('create')
            ->andReturn('anything');


        $result = $this->createContact->execute();
        $this->assertSame(
            null,
            $result
        );
    }


    // public function testCreateContactDomain()
    // {
    //     $this->request->merge(['contacts' => null]);

    //     App::shouldReceive('make')
    //         ->once()
    //         ->andReturn($this->request);


    //     $this->dto->shouldReceive('fromRequest')
    //         ->andReturn(['anything']);


    //         $this->repositoryMock->shouldReceive('create')
    //         ->andReturn(null);

    //     $result = $this->createContact->execute();

    //     $this->assertSame(
    //         null,
    //         $result
    //     );
    // }
    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
