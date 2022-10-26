<?php

namespace Tests\Feature\Api\Help;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\Help;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;


class CreateApiHelpTest extends TestCase
{
    private  function createHelp(Help $help = null): TestResponse
    {
        
        return $this->postJson('/api/v1/help/create', $help->getAttributes(), ['Accept' => 'application/json']);
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $this->help = $this->help()->make();
    }

    /** @test */
    public function it_should_create_help()
    {
        //Arrange
        $this->createHelp($this->help)
            //Assert    
            ->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('helps', 
        $this->help->getAttributes()
    );

    }
}
