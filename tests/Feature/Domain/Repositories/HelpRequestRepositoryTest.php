<?php

namespace Tests\Feature\Domain\Repositories;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Http\Request;
use Domain\Entities\HelpRequest;
use Illuminate\Support\Facades\App;
use Domain\VOs\Contracts\idVoInterface;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HelpRequestRepositoryTest extends TestCase
{
    protected $repository;
    // public function setUp(): void
    // {
    //     parent::setUp();
    //     $this->repository = $this->app->make('Infrastructure\Repositories\HelpRequestRepository');
    //     $this->request = App::make(Request::class);
    //     $this->helpRequest = $this->HelpRequest()->create();
    //     $this->help = $this->help()->create();
    //     $this->legalPerson = $this->legalPerson()->create();
    //     $this->physicalPerson = $this->physicalPerson()->create();
    //     $this->chat = $this->chat()->create();
    //     $this->requester = $this->requester()->create();
    //     $this->tenant = $this->tenant()->create();
    //     $this->purchaseItem = $this->purchaseItem()->setTenantId($this->tenant->id)->create();
    // }

    public function setUp(): void
    {
        //Arrange
        parent::setUp();
        $this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        /** @var HelpRequest $helpRequest*/
        $this->request = App::make(Request::class);
        $this->repository = $this->app->make('Infrastructure\Repositories\HelpRequestRepository');
        $this->tenant = $this->tenant()->create();
        $this->purchaseItem = $this->purchaseItem()->setTenantId($this->tenant->id)->create();
        $this->requester = $this->requester()->create();
        $this->help = $this->help()->create();
        $this->helpRequest = $this->helpRequest()
            ->setPurchaseItemId($this->purchaseItem->id)
            ->setHelpId($this->help->id)
            ->setRequesterId($this->requester->id)->make();
        $this->chat = $this->chat()->setHelpRequestId($this->helpRequest->id)->make();
    }



    /** @test */
    public function should_update_help_request_with_success()
    {
        Carbon::setTestNow(now());
        /** @var HelpRequest $helpRequest*/
        $result = $this->repository->update(json_decode(json_encode($this->HelpRequest()->setHelpId($this->help->id)->setRequesterId($this->requester->id)->setPurchaseItemId($this->purchaseItem->id)->create()), true));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_update_help_request_tenant_with_Error()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $result = $this->repository->update(json_decode(json_encode($this->HelpRequest()->setId(null)->setHelpId($this->help->id)->setRequesterId($this->requester->id)->setPurchaseItemId($this->purchaseItem->id)->make()), true));
        $this->assertSame($result, 0);
    }

    /** @test */
    public function delete_help_request_should_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var Requester $requester*/
        $helpRequest = $this->helpRequest()->setId(null)->setHelpId($this->help->id)->setRequesterId($this->requester->id)->setPurchaseItemId($this->purchaseItem->id)->make();
        $callback = $this->helpRequest()->create($helpRequest->getAttributes());
        $result = $this->repository->delete($callback->id);
        $this->assertSame($result, 1);
    }


    /** @test */
    public function delete_help_request_should_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $result = $this->repository->delete('877998877');
        $this->assertSame($result, 0);
    }

    /** @test */
    public function find_by_id_help_request_should_return_a_object()
    {
        Carbon::setTestNow(now());
        /** @var HelpRequest $helpRequest*/
        $helpRequest = $this->helpRequest()->setId(null)->setHelpId($this->help->id)->setRequesterId($this->requester->id)->setPurchaseItemId($this->purchaseItem->id)->make();
        $callback = $this->HelpRequest()->create($helpRequest->getAttributes());
        $result = $this->repository->findById($callback->id);
        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertDatabaseHas(
            'help_requests',
            $callback->getAttributes()
        );
    }

    /** @test */
    public function find_by_id_help_request_should_return_Error()
    {
        Carbon::setTestNow(now());
        /** @var HelpRequest $helpRequest*/
        $this->expectException(ModelNotFoundException::class);
        $this->repository->findById('12345678', true);
    }


    /** @test */
    public function should_create_request_help_and_return_success()
    {
        Carbon::setTestNow(now());
        $result = $this->repository->create($this->helpRequest()->make()->getAttributes());
        $this->assertNotNull($result);
    }


    /** @test */
    public function should_return_error_because_identifier_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->helpRequest()->setIdentifier(null)->make()), true));
    }


    /** @test */
    public function should_return_error_because_help_id_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->helpRequest()->setHelpId(null)->make()), true));
    }


    /** @test */
    public function should_return_error_because_requester_id_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->helpRequest()->setRequesterId(null)->make()), true));
    }


    /** @test */
    public function should_return_error_because_purchase_item_id_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->helpRequest()->setPurchaseItemId(null)->make()), true));
    }

    /** @test */
    public function should_destroy_help_request_tenant_and_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $helpRequest = $this->helpRequest()->make();
        $callback = $this->helpRequest()->create($helpRequest->getAttributes());
        $this->request->merge(['id' => $callback->id]);
        $result = $this->repository->destroy(App::makeWith('Domain\VOs\Contracts\IdVoInterface'));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_destroy_address_tenant_and_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var HelpRequest $helpRequest*/
        $this->request->merge(['id' => '1234567']);
        $result = $this->repository->destroy(App::makeWith('Domain\VOs\Contracts\IdVoInterface'));
        $this->assertSame($result, 0);
    }

    /** @test */
    public function should_create_chat_and_return_success()
    {
        Carbon::setTestNow(now());
        $this->helpRequest = $this->helpRequest()
            ->setPurchaseItemId($this->purchaseItem->id)
            ->setHelpId($this->help->id)
            ->setRequesterId($this->requester->id)->create();
        $chat = $this->chat()->setHelpRequestId($this->helpRequest->id)->make();
        $result = $this->repository->createChat($chat->getAttributes());
        $this->assertNotNull($result);
    }

    /** @test */
    public function should_create_chat_files_and_return_success()
    {
        Carbon::setTestNow(now());
        $this->helpRequest = $this->helpRequest()
        ->setPurchaseItemId($this->purchaseItem->id)
        ->setHelpId($this->help->id)
        ->setRequesterId($this->requester->id)->create();
        $chat = $this->chat()->setHelpRequestId($this->helpRequest->id)->create();
   
        $result = $this->repository->createChatFilePaths($this->chatFile()->setChatId($chat->id)->make()->getAttributes());
        $this->assertNotNull($result);
    }

    /** @test */
    public function should_create_purchase_item_and_return_success()
    {
        Carbon::setTestNow(now());
        $result = $this->repository->createPurchaseItem($this->purchaseItem()->make()->getAttributes());
        $this->assertNotNull($result);
    }

     /** @test */
     public function get_requests_by_requester_id_should_return_object()
     {
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $requester = $this->requester()->create();
        $this->helpRequest()->setRequesterId($requester->id)->create(10);
        $this->request->merge(['id' => $requester->id]);
        $result = $this->repository->getRequestsByRequesterId(10, 1, App::makeWith('Domain\VOs\Contracts\IdVoInterface'));
        $this->assertNotNull($result);
     }

}
