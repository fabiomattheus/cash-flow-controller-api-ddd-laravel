<?php

namespace Tests\Unit\Presentation\Controllers\Api\CashFlow;

use Mockery;
use PHPUnit\Framework\TestCase;

use Presentation\Contracts\CashFlow\DelegateCashFlowUpdateAppServiceInterface;
use Presentation\Controllers\Api\CashFlow\UpdateCashFlowApiController;

class UpdateCashFlowApiControllerTest extends TestCase
{
    protected $updateCashFlowMock;
    protected $updateCashController;
    protected function setUp(): void
    {
        $this->updateCashFlowMock = Mockery::mock(DelegateCashFlowUpdateAppServiceInterface::class);
        $this->updateCashController = new UpdateCashFlowApiController(
            $this->updateCashFlowMock
        );
    }
    
    public function testAddCashFlow()
    {
        //Arrange
        $this->updateCashFlowMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->updateCashController->update();
        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }
}
