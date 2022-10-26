<?php


namespace Tests\Unit\Application\Services\Help;

use Application\Services\Help\CreateHelp;
use Application\Services\Help\UpdateHelp;
use Domain\Entities\Contracts\HelpEntityInterface;
use Domain\Repositories\HelpRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class UpdateHelpTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = Mockery::mock(stdClass::class, HelpRepositoryInterface::class);
        $this->helpMock = Mockery::mock(stdClass::class, HelpEntityInterface::class);
        $this->dto = Mockery::mock(stdClass::class, 'alias:Domain\Dto\Contracts\OtdInterface');
        $this->updateHelp = new UpdateHelp(
            $this->repositoryMock,
            $this->helpMock
        );
    }

    public function testUpdateHelpApplication()
    {
        //Arrange

        DB::shouldReceive('beginTransaction')
            ->once()
            ->andReturn();
        DB::shouldReceive('commit')
            ->once()
            ->andReturn();
        $this->dto->shouldReceive('fromRequest')
            ->andReturn(['anything' => 'anything']);

        $this->repositoryMock->shouldReceive('update')
            ->andReturn();

        $this->dto->shouldReceive('toJson')
            ->andReturn('anything');

        //Act
        $result = $this->updateHelp->execute();


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
