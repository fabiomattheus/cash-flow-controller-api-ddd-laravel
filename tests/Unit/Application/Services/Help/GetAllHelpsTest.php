<?php

namespace Tests\Unit\Application\Services\Help;

use Application\Services\Help\GetAllHelps;
use Domain\Entities\Contracts\HelpEntityInterface;
use Domain\Repositories\HelpRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

class GetAllHelpsTest extends TestCase
{


    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = \Mockery::mock(\stdClass::class, HelpRepositoryInterface::class);
        $this->helpMock = \Mockery::mock(\stdClass::class, HelpEntityInterface::class);
        $this->request = new Request();

        $this->getAllHelps = new GetAllHelps(
            $this->repositoryMock,
            $this->helpMock
        );
    }

    public function testGetAllHelpsApplication()
    {
        //Arrange
        DB::shouldReceive('beginTransaction')
            ->andReturn();

        DB::shouldReceive('commit')
            ->andReturn();

        App::shouldReceive('make')
            ->once()
            ->andReturn($this->request);

        $this->repositoryMock->shouldReceive('getAll')
            ->andReturn( ['anything'=> 'anything']);

        //Act
        $result = $this->getAllHelps->execute();

        //Assert
        $this->assertSame(
            ['anything'=> 'anything'],
            $result
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}
