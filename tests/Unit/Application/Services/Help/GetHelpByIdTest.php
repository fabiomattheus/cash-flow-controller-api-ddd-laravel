<?php

namespace tests\Unit\Application\Services\Help;

use Application\Services\Help\GetHelpById;
use Domain\Repositories\HelpRepositoryInterface;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Support\Facades\App;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class GetHelpByIdTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = Mockery::mock(stdClass::class, HelpRepositoryInterface::class);
        $this->idVoMock = Mockery::mock(stdClass::class, IdVoInterface::class);
        $this->getHelpById = new GetHelpById(
            $this->repositoryMock,
            $this->idVoMock,
        );
    }

    public function testGetHelpByIdApplication()
    {
        //Arrange
        App::shouldReceive('makeWith')
                    ->once()
                    ->andReturn($this->idVoMock);

        $this->repositoryMock->shouldReceive('findOrFailVoWithRelations')
            ->once()
            ->andReturn('anything');

        //Act
        $result = $this->getHelpById->execute();

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
