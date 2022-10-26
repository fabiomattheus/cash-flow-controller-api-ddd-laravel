<?php

namespace Tests\Feature\Api\Help;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\Help;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;


class UpdateApiHelpTest extends TestCase
{
    private  function updateHelp(Help $help): TestResponse
    {
        return $this->putJson("/api/v1/help/update",$help->getAttributes(), ['Accept' => 'application/json']);
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
    public function it_should_create_help()
    {
        //Arrange
        $help = $this->help()->setId($this->help->id)->setLabel('Perguntas')->make();
        //act
        $this->updateHelp($help)
            //Assert    
            ->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('helps', 
        $help->getAttributes()
    );

    }
}
