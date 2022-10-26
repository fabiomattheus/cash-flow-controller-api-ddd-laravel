<?php

namespace Tests\Feature\Api\Help;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\Help;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;


class GetByIdApiHelpTest extends TestCase
{
    private  function findHelp(Help $help = null): TestResponse
    {
        return $this->getJson("/api/v1/help/find/{$help->id}", ['Accept' => 'application/json']);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $this->help = $this->help()->create();
    }

    /** @test */
    public function it_should_delete_help()
    {
        //Arrange
        $result = $this->findHelp($this->help)
            //Assert    
            ->assertStatus(Response::HTTP_OK);
        // $this->assertSame(json_encode(
        //     [
        //         "id" => $this->help->id,
        //         "label" => $this->help->label,
        //         "description" => $this->help->description,
        //         "type" => $this->help->type,
        //         "requisition_type" => $this->help->requisition_type,
        //         "parent_id" => $this->help->parent_id,
        //         "created_at" => now(),
        //         "updated_at" => now()
                
        //       ],
        // ),$result->getContent(), '');
    }
}

