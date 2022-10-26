<?php

use Domain\Entities\Contracts\RequesterEntityInterface;
use Domain\Repositories\RequesterRepositoryInterface;
use Domain\Services\Contracts\TEntity\GetRequesterByIdInterface;
use Domain\Services\Requester\CreateRequester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use Presentation\Contracts\Contact\CreateContactInterface;
use Presentation\Contracts\TypePerson\TypePersonInterface;

class CreateRequesterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->contactMock = Mockery::mock(\stdClass::class, CreateContactInterface::class);
        $this->typePersonMock = Mockery::mock(\stdClass::class, TypePersonInterface::class);
        $this->repositoryMock = Mockery::mock(\stdClass::class, RequesterRepositoryInterface::class);
        $this->requesterEntityMock = Mockery::mock(\stdClass::class, RequesterEntityInterface::class);
        $this->getRequesterById = Mockery::mock(\stdClass::class, GetRequesterByIdInterface::class);

        $this->request = new Request();
        $this->dto = Mockery::mock(stdClass::class, 'alias:Domain\Dto\Contracts\DtoInterface');
        $this->createRequester = new CreateRequester(
            $this->contactMock,
            $this->typePersonMock,
            $this->repositoryMock,
            $this->requesterEntityMock,
            $this->getRequesterById

        );
        stdClass::class;
        $this->callBack = new stdClass;
        $this->callBack->id = (string) Str::uuid();
        $this->callBack->name = 'teste';
    }
    public function testCreateRequesterDomainWithoutRequester()
    {
        //Arrange
        App::shouldReceive('make')
            ->once()
            ->andReturn($this->request);

        DB::shouldReceive('beginTransaction')
            ->once()
            ->andReturn();

        DB::shouldReceive('commit')
            ->once()
            ->andReturn();

        $this->getRequesterById->shouldReceive('execute')
            ->once()
            ->andReturn($this->callBack);

        $this->typePersonMock->shouldReceive('execute')
            // ->once()
            ->andReturn();

        $this->dto->shouldReceive('fromRequest')
            ->andReturn(json_decode(json_encode($this->callBack), true));

        $this->repositoryMock->shouldReceive('create')
            //  ->once()
            ->andReturn('anything');

        $this->contactMock->shouldReceive('execute')
            ->andReturn('anything');

        //Act
        $result = $this->createRequester->execute();

        //Assert
        $this->assertSame(
            null,
            $result
        );
    }

    // public function testCreateRequesterDomainWithRequester()
    // {
    //     //Arrange
    //     App::shouldReceive('make')
    //         ->once()
    //         ->andReturn($this->request);

    //     DB::shouldReceive('beginTransaction')
    //         ->once()
    //         ->andReturn();

    //     DB::shouldReceive('commit')
    //         ->once()
    //         ->andReturn();


    //     $this->getRequesterById->shouldReceive('execute')
    //         ->once()
    //         ->andReturn(null);

    //     $this->typePersonMock->shouldReceive('execute')
    //         ->once()
    //         ->andReturn();

    //     $this->dto->shouldReceive('fromRequest')
    //         ->andReturn(json_decode(json_encode($this->callBack), true));

    //     $this->repositoryMock->shouldReceive('create')
    //         ->once()
    //         ->andReturn('anything');

    //     $this->contactMock->shouldReceive('execute')
    //         ->once()
    //         ->andReturn('anything');

    //     //Act
    //     $result = $this->createRequester->execute();

    //     //Assert
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
