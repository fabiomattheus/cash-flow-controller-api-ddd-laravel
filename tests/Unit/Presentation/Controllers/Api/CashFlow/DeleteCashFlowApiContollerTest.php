<?php

namespace Tests\Unit\Presentation\Controllers\Api\CashFlow;

use Mockery;
use PHPUnit\Framework\TestCase;
use Presentation\Contracts\CashFlow\DeleteCashFlowDomServiceInterface;
use Presentation\Controllers\Api\CashFlow\DeleteCashFlowApiController;

class DeleteCashFlowApiContollerTest extends TestCase
{
    protected $deleteCashFlowMock;
    protected $deleteCashController;
    protected function setUp(): void
    {
        $this->deleteCashFlowMock = Mockery::mock(DeleteCashFlowDomServiceInterface::class);
        $this->deleteCashController = new DeleteCashFlowApiController(
            $this->deleteCashFlowMock
        );
    }

    public function testDeleteCashFlow()
    {
        //Arrange
        $this->deleteCashFlowMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->deleteCashController->delete();
        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }
}
