<?php


namespace tests\Unit\Application\Services\Help;

use Application\Services\Help\GetHelpById;
use Domain\Repositories\RequesterRepositoryInterface;
use Domain\Services\Requester\GetRequesterById;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Support\Facades\App;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class GetRequestByIdTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = Mockery::mock(stdClass::class, RequesterRepositoryInterface::class);
        $this->idVoMock = Mockery::mock(stdClass::class, IdVoInterface::class);
        $this->getRequesterById = new GetRequesterById(
            $this->repositoryMock,
            $this->idVoMock,
        );
    }

    public function testGetRequesterByIdDomain()
    {
        //Arrange
        App::shouldReceive('makeWith')
            ->once()
            ->andReturn($this->idVoMock);

        $this->repositoryMock->shouldReceive('findWithValidation')
            ->once()
            ->andReturn('anything');

        //Act
        $result = $this->getRequesterById->execute();

        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}

