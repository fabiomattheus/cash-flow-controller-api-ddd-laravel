<?php

namespace Tests\Unit\Presentation\Controllers\Api\CashFlow;

use Mockery;
use PHPUnit\Framework\TestCase;

use Presentation\Contracts\CashFlow\FindCashFlowByIdAppServiceInterface;
use Presentation\Contracts\CashFlow\FindCashFlowByIdDomServiceInterface;
use Presentation\Controllers\Api\CashFlow\FindCashFlowByIdApiController;

class FindCashFlowByIdConrollerTest extends TestCase
{
    protected $findCashFlowByIdMock;
    protected $findCashFlowByIdController;
    protected function setUp(): void
    {
        $this->findCashFlowByIdMock = Mockery::mock(FindCashFlowByIdDomServiceInterface::class);
        $this->findCashFlowByIdController = new FindCashFlowByIdApiController(
            $this->findCashFlowByIdMock
        );
    }
    
    public function testAddCashFlow()
    {
        //Arrange
        $this->findCashFlowByIdMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->findCashFlowByIdController->findById();
        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }
}
