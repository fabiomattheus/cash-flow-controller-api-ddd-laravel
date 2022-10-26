<?php

namespace Tests\Unit\Application\Services\Help;

use Application\Services\Help\DeleteHelp;
use Domain\Repositories\HelpRepositoryInterface;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class DeleteHelpTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = Mockery::mock(stdClass::class, HelpRepositoryInterface::class);
        $this->idVoMock = Mockery::mock(stdClass::class, IdVoInterface::class);
        $this->dto = Mockery::mock(stdClass::class, 'alias:Domain\Dto\Contracts\DtoInterface');
        $this->deleteHelp = new DeleteHelp(
            $this->repositoryMock,
        );
    }

    public function testDeleteHelpApplication()
    {
        //Arrange
        DB::shouldReceive('beginTransaction')
            ->once()
            ->andReturn();
        DB::shouldReceive('commit')
            ->once()
            ->andReturn();

        App::shouldReceive('makeWith')
            ->once()
            ->andReturn($this->idVoMock);

        $this->repositoryMock->shouldReceive('destroy')
            ->once()
            ->andReturn();

        $this->dto->shouldReceive('toJson')
            ->once()
            ->andReturn('anything');
        
        App::shouldReceive('makeWith')
            ->once()
            ->andReturn($this->dto);
      
        //Act
        $result = $this->deleteHelp->execute();

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
