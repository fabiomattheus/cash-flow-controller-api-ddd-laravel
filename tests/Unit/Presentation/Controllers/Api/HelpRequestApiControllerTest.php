<?php

namespace Tests\Unit\Presentation\Controllers\Api;

use Illuminate\Http\Response;
use Mockery;
use PHPUnit\Framework\TestCase;
use Presentation\Contracts\HelpRequest\CreateHelpRequestInterface;
use Presentation\Contracts\HelpRequest\GetHelpRequestByIdInterface;
use Presentation\Contracts\HelpRequest\GetHelpRequestsByCustomerIdInterface;
use Presentation\Controllers\Api\HelpRequestApiController;

class HelpRequestApiControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->getHelpRequestByIdMock = Mockery::mock(stdClass::class, GetHelpRequestByIdInterface::class);
        $this->createHelpRequestMock = Mockery::mock(stdClass::class, CreateHelpRequestInterface::class);
        $this->HelpRequestController = new HelpRequestApiController(
            $this->getHelpRequestByIdMock,
            $this->createHelpRequestMock,
        );
    }

    public function testHelpRequestById()
    {
        //Arrange
        $this->getHelpRequestByIdMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->HelpRequestController->getById();

        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }

    public function testCreateHelp()
    {
        //Arrange
        $this->createHelpRequestMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->HelpRequestController->create();
        //Assert
        $this->assertSame(
            'anything',
            $result
        );//use Tests\TestCase;
    }
}
