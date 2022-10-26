<?php

namespace tests\Unit\Application\Services\Help;

use Application\Services\Help\GetHelpsByType;
use Domain\Repositories\HelpRepositoryInterface;
use Domain\VOs\Contracts\TypeVoInterface;
use Illuminate\Support\Facades\App;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class GetHelpsByTypeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = Mockery::mock(stdClass::class, HelpRepositoryInterface::class);
        $this->typeVoMock = Mockery::mock(stdClass::class, TypeVoInterface::class);
        $this->getHelpsByType = new GetHelpsByType(
            $this->repositoryMock,
            $this->typeVoMock,
        );
    }
    public function testGetHelpByTypeApplication()
    {
        //Arrange
        App::shouldReceive('makeWith')
            ->once()
            ->andReturn($this->typeVoMock);

        $this->repositoryMock->shouldReceive('findAllByType')
            ->once()
            ->andReturn('anything');

        //Act
        $result = $this->getHelpsByType->execute();


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
