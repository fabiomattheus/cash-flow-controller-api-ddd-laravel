<?php

namespace Tests\Unit\Presentation\Controllers\Api;

use Mockery;
use PHPUnit\Framework\TestCase;
use Presentation\Contracts\Help\CreateHelpInterface;
use Presentation\Contracts\Help\DeleteHelpInterface;
use Presentation\Contracts\Help\GetAllHelpsInterface;
use Presentation\Contracts\Help\GetHelpByIdInterface;
use Presentation\Contracts\Help\GetHelpsByTypeInterface;
use Presentation\Contracts\Help\UpdateHelpInterface;
use Presentation\Controllers\Api\HelpApiController;

class HelpApiControllerTest extends TestCase
{
    protected function setUp(): void
    {
        $this->getAllHelpsMock = Mockery::mock(stdClass::class, GetAllHelpsInterface::class);
        $this->getHelpByIdMock = Mockery::mock(stdClass::class, GetHelpByIdInterface::class);
        $this->getHelpsByTypeMock = Mockery::mock(stdClass::class, GetHelpsByTypeInterface::class);
        $this->createHelpMock = Mockery::mock(stdClass::class, CreateHelpInterface::class);
        $this->deleteHelpMock = Mockery::mock(stdClass::class, DeleteHelpInterface::class);
        $this->updateHelpMock = Mockery::mock(stdClass::class, UpdateHelpInterface::class);
        $this->helpController = new HelpApiController(
            $this->deleteHelpMock,
            $this->getAllHelpsMock,
            $this->getHelpByIdMock,
            $this->getHelpsByTypeMock,
            $this->updateHelpMock,
            $this->createHelpMock
        );
    }
    public function testGetAllHelps()
    {
        //     //Arrange
        $this->getAllHelpsMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //act    
        $result = $this->helpController->getAll();
        $this->assertSame(
            'anything',
            $result
        );
    }

    public function testGetHelpById()
    {
        //Arrange
        $this->getHelpByIdMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->helpController->getById();

        //Assert
        $this->assertSame(
            'anything',
        $result);
    }

    public function testGetHelpsByType()
    {
        //Arrange
        $this->getHelpsByTypeMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->helpController->getByType();

        //Assert
        $this->assertSame(
            'anything',
        $result);
    }

    public function testCreateHelp()
    {
        //Arrange
        $this->createHelpMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->helpController->create();
        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }

    public function testUpdateHelp()
    {
        //Arrange
        $this->updateHelpMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->helpController->update();
        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }

    public function testDeleteHelp()
    {
        //Arrange
        $this->deleteHelpMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act 
        $result = $this->helpController->destroy();
        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }
}
