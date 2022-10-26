<?php

namespace Tests\Feature\Api\HelpRequest;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Aggregates\Chat;
use Domain\Aggregates\ChatFile;
use Domain\Entities\HelpRequest;
use Domain\Entities\PurchaseItem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;


class CreateApiHelpRequestTest extends TestCase
{
    private  function createHelpRequest(HelpRequest $helpRequest, PurchaseItem $purchaseItem, Chat $chat): TestResponse
    {
        $data = Arr::add($helpRequest->getAttributes(), 'PurchaseItem', $purchaseItem->getAttributes());
        $data = Arr::add($data, 'Chat', $chat->getAttributes());
        $data = array_merge($data, ['attachments' => [UploadedFile::fake()->image('avatar.jpeg', 110, 110)->size(100)]]);
        return $this->postJson('/api/v1/help-request/create', $data, ['Accept' => 'application/json']);
    }

    public function setUp(): void
    {
        //Arrange
        parent::setUp();
        $this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        Storage::fake('public');
        /** @var HelpRequest $helpRequest*/
        $this->tenant = $this->tenant()->create();
        $this->purchaseItem = $this->purchaseItem()->setTenantId($this->tenant->id)->make();
        $this->requester = $this->requester()->create();
        $this->help = $this->help()->create();
        $this->helpRequest = $this->helpRequest()
            ->setHelpId($this->help->id)
            ->setRequesterId($this->requester->id)->make();
        $this->chat = $this->chat()->make();
    }

    /** @test */
    public function it_should_create_help_request()
    {
        //Act
        $this->createHelpRequest($this->helpRequest, $this->purchaseItem, $this->chat)
            //Assert
            ->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas(
            'help_requests',
            [
                "status" => $this->helpRequest->status,
                "help_id" => $this->helpRequest->help_id,
                "requester_id" => $this->helpRequest->requester_id
            ]
        );
        $this->assertDatabaseHas(
            'purchase_items',
            $this->purchaseItem->getAttributes()
        );
        $this->assertDatabaseHas(
            'chats',
            ['note' => $this->chat->note,]
        );
    }
}
