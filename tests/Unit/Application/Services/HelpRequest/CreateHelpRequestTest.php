<?php

namespace tests\Unit\Application\Services\HelpRequest;

use Mockery;
use stdClass;
use Domain\Dto\Dto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Domain\Dto\Contracts\DtoInterface;
use Application\Services\HelpRequest\CreateHelpRequest;
use Domain\Aggregates\Contracts\ChatAggregateInterface;
use Domain\Repositories\HelpRequestRepositoryInterface;
use Domain\Entities\Contracts\HelpRequestEntityInterface;
use Presentation\Contracts\Requester\CreateRequesterInterface;
use Application\Services\Contracts\TEntity\StoreImagesInterface;
use Application\Services\Contracts\HelpRequest\GenerateCodeInterface;
use Application\Services\Contracts\ChatFile\CreateChatFilePathsInterface;
use Application\Services\Contracts\TEntity\StoreFilesInterface;
use Domain\Entities\Contracts\PurchaseItemEntityInterface;

class CreateHelpRequestTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->helpRequestEntityMock = Mockery::mock(stdClass::class, HelpRequestEntityInterface::class);
        $this->helpRequestRepositoryMock = Mockery::mock(stdClass::class, HelpRequestRepositoryInterface::class);
        $this->chatAggregateMock = Mockery::mock(stdClass::class, ChatAggregateInterface::class);
        $this->purchaseItemAggregateMock = Mockery::mock(stdClass::class, PurchaseItemEntityInterface::class);
        $this->storeImagesMock = Mockery::mock(stdClass::class, StoreFilesInterface::class);
        $this->generateCodeMock = Mockery::mock(stdClass::class, GenerateCodeInterface::class);
        $this->dto = Mockery::mock(stdClass::class, 'alias:DtoInterface');
        $this->createRequesterMock = Mockery::mock(stdClass::class, CreateRequesterInterface::class);
        $this->createChatFilePathsMock = Mockery::mock(stdClass::class, CreateChatFilePathsInterface::class);
        $this->request = new Request();
        $this->createHelpRequest = new CreateHelpRequest(
            $this->helpRequestEntityMock,
            $this->purchaseItemAggregateMock,
            $this->helpRequestRepositoryMock,
            $this->storeImagesMock,
            $this->generateCodeMock,
            $this->chatAggregateMock,
            $this->createChatFilePathsMock,
        );
        stdClass::class;
        $this->callBack = new stdClass;
        $this->callBack->id = (string) Str::uuid();
        $this->callBack->url = (string) Str::uuid();
    }

    public function testHelpApplication()
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
            ->andReturn($this->dto);

       $request = App::shouldReceive('make')
            ->once()
            ->andReturn($this->request);

        $this->generateCodeMock->shouldReceive('execute')
            ->once()
            ->andReturn();

        $this->dto->shouldReceive('fromRequest')
            ->andReturn( json_decode(json_encode($this->callBack), true));

        $this->helpRequestRepositoryMock->shouldReceive('createPurchaseItem')
            ->andReturn($this->callBack);
    

        $this->helpRequestRepositoryMock->shouldReceive('create')
            ->andReturn($this->callBack);
            
        $this->request->merge(['Chat'=>['anything']]); 

        $this->helpRequestRepositoryMock->shouldReceive('createChat')
            ->andReturn($this->callBack);

       $this->helpRequestRepositoryMock->shouldReceive('createChatImages')
            ->andReturn($this->callBack);

        $this->createChatFilePathsMock->shouldReceive('execute')
            ->once()
            ->andReturn(['anything']);

        $this->storeImagesMock->shouldReceive('execute')
            ->once()
            ->andReturn(['url']);

        $this->dto->shouldReceive('toJson')
            ->once()
            ->andReturn('anything');



        //act
        $result = $this->createHelpRequest->execute();

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
