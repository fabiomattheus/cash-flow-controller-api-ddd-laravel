<?php

namespace Tests\Unit\Domain\Services\TEntity;

use Domain\Entities\Contracts\LegalPersonEntityInterface;
use Domain\Entities\Contracts\PhysicalPersonEntityInterface;
use Domain\Repositories\LegalPersonRepositoryInterface;
use Domain\Repositories\PhysicalPersonRepositoryInterface;
use Domain\Services\TEntity\CreateTypePerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class CreateTypePersonTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->physicalEntity = Mockery::mock(stdClass::class, PhysicalPersonEntityInterface::class);
        $this->legalEntity = Mockery::mock(stdClass::class, LegalPersonEntityInterface::class);
        $this->physicalRepository = Mockery::mock(stdClass::class, PhysicalPersonRepositoryInterface::class);
        $this->legalRepository = Mockery::mock(stdClass::class, LegalPersonRepositoryInterface::class);
        $this->dto = Mockery::mock(stdClass::class, 'alias:Domain\Dto\Contracts\DtoInterface'); //when used in static method class
        $this->request = new Request();
        $this->createTypePerson = new CreateTypePerson(
            $this->legalEntity,
            $this->physicalEntity,
            $this->physicalRepository,
            $this->legalRepository,
            $this->dto
        );
        stdClass::class;
        $this->callBack = new stdClass;
        $this->callBack->id = (string) Str::uuid();
        $this->callBack->cpf = 'anything';

    }

    public function testCreateTypePersonPhysicalDomain()
    {

        $this->request->merge(['cpf' => 'anything']);

        App::shouldReceive('make')
            ->once()
            ->andReturn($this->request);


        $this->dto->shouldReceive('fromRequest')
            ->andReturn( json_decode(json_encode($this->callBack), true));

        $this->physicalRepository->shouldReceive('create')
            ->andReturn(['anything']);

        $result = $this->createTypePerson->execute();

        $this->assertSame(
            ['anything'],
            $result
        );
    }

    public function testCreateTypePersonLegalDomain()
    {

        $this->request->merge(['cnpj' => 'anything']);

        App::shouldReceive('make')
            ->once()
            ->andReturn($this->request);


        $this->dto->shouldReceive('fromRequest')
            ->andReturn( json_decode(json_encode($this->callBack), true));

        $this->legalRepository->shouldReceive('create')
            ->andReturn(['anything']);

        $result = $this->createTypePerson->execute();

        $this->assertSame(
            ['anything'],
            $result
        );
    }


    public function testCreateTypePersonExeptionDomain()
    {

        $this->request->merge(['cnpj' => null]);

        App::shouldReceive('make')
            ->once()
            ->andReturn($this->request);


        $this->dto->shouldReceive('fromRequest')
            ->andReturn( json_decode(json_encode($this->callBack), true));

        $this->legalRepository->shouldReceive('create')
            ->andReturn(['anything']);

        $result = $this->createTypePerson->execute();

        $this->assertSame(
            ['anything'],
            $result
        );
    }
}
