<?php

namespace Tests\Feature\Api\Help;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\Help;
use Domain\Entities\HelpRequest;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;


class GetApiHelpRequestByIdTest extends TestCase
{
    private  function findHelpRequest(HelpRequest $helpRequest = null): TestResponse
    {
        return $this->getJson("/api/v1/help-request/find/{$helpRequest->id}", ['Accept' => 'application/json']);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        /** @var HelpRequest $helpRequest*/
        $this->tenant = $this->tenant()->create();
        $this->purchaseItem = $this->PurchaseItem()->setTenantId($this->tenant->id)->create();
        $this->requester = $this->requester()->create();
        $this->help = $this->help()->create();
        $this->helpRequest = $this->HelpRequest()->setPurchaseItemId($this->purchaseItem)->setRequesterId( $this->requester->id)->setHelpId( $this->help->id)->create();
    }

    /** @test */
    public function it_should_find_help_request_by_id()
    {
        //Arrange
          $this->findHelpRequest($this->helpRequest)
            //Assert
            ->assertStatus(Response::HTTP_OK);

    }
}
