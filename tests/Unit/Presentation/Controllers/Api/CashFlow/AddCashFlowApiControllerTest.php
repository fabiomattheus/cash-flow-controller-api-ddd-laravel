<?php

namespace Tests\Unit\Presentation\Controllers\Api\CashFlow;

use Mockery;
use PHPUnit\Framework\TestCase;

use Presentation\Contracts\CashFlow\AddCashFlowAppServiceInterface;
use Presentation\Controllers\Api\CashFlow\AddCashFlowApiController;

class AddCashFlowApiControllerTest extends TestCase
{
    protected $addCashFlowMock;
    protected $addCashController;
    protected function setUp(): void
    {
        $this->addCashFlowMock = Mockery::mock(AddCashFlowAppServiceInterface::class);
        $this->addCashController = new AddCashFlowApiController(
            $this->addCashFlowMock
            
        );
    }
    
    public function testAddCashFlow()
    {
        //Arrange
        $this->addCashFlowMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->addCashController->add();
        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }
}
