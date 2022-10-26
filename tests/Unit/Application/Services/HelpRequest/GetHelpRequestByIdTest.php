<?php

namespace tests\Unit\Application\Services\HelpRequest;

use Application\Services\HelpRequest\GetHelpRequestById;
use Domain\Repositories\HelpRequestRepositoryInterface;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\TestCase;

class GetHelpRequestByIdTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = \Mockery::mock(\stdClass::class, HelpRequestRepositoryInterface::class);
        $this->idVoMock = \Mockery::mock(\stdClass::class, IdVoInterface::class);
        $this->getHelpRequestById = new GetHelpRequestById(
            $this->repositoryMock,
            $this->idVoMock,
        );
    }
    public function testGetRequestHelpByIdApplication()
    {
        //Arrange
        App::shouldReceive('makeWith')
            ->once()
            ->andReturn($this->idVoMock);

        $this->repositoryMock->shouldReceive('findOrFailVoWithRelations')
            ->once()
            ->andReturn('anything');

        //Act
        $result = $this->getHelpRequestById->execute();

        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}
