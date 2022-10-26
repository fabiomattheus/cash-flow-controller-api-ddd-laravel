<?php

namespace Tests\Feature\Api\Help;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\Help;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;


class DeleteApiHelpTest extends TestCase
{
    private  function deleteHelp(Help $help = null): TestResponse
    {
        return $this->deleteJson("/api/v1/help/destroy/",$help->getAttributes(), ['Accept' => 'application/json']);
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
      //  dd($this->help);
        //Arrange
        $this->help()->setId($this->help->id)->make();
        $this->deleteHelp($this->help)

            //Assert
            ->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing(
            'helps',
            [json_encode($this->help->getAttributes())]
        );
    }
}
