<?php

namespace Tests\Unit\Presentation\Controllers\Api\CashFlow;

use Mockery;
use PHPUnit\Framework\TestCase;

use Presentation\Contracts\CashFlow\FindAllCashFlowsByDateDomServiceInterface;
use Presentation\Controllers\Api\CashFlow\FindAllCashFlowsByDateApiController;

class FindAllCashFlowsByDateTest extends TestCase
{
    protected $findAllCashFlowsByDateMock;
    protected $findCashFlowByIdController;
    protected function setUp(): void
    {
        $this->findAllCashFlowsByDateMock = Mockery::mock(FindAllCashFlowsByDateDomServiceInterface::class);
        $this->findCashFlowByIdController = new FindAllCashFlowsByDateApiController(
            $this->findAllCashFlowsByDateMock
        );
    }
    
    public function testFindAllCashFlowsByDate()
    {
        //Arrange
        $this->findAllCashFlowsByDateMock->shouldReceive('execute')
            ->once()
            ->andReturn('anything');
        //Act
        $result = $this->findCashFlowByIdController->findAllByDate();
        //Assert
        $this->assertSame(
            'anything',
            $result
        );
    }
}
