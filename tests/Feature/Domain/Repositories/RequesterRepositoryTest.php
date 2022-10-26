<?php

namespace Tests\Feature\Domain\Repositories;

use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class RequesterRepositoryTest extends TestCase
{
    protected $repository;
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make('Infrastructure\Repositories\RequesterRepository');
        $this->request = App::make(Request::class);
        $this->legalPerson = $this->legalPerson()->create();
        $this->physicalPerson = $this->physicalPerson()->create();
    }

    /** @test */
    public function should_create_requester_and_return_success()
    {
        Carbon::setTestNow(now());
        $requester = $this->Requester()->make();
        $result = $this->repository->create($requester->getAttributes());
        $this->assertNotNull($result);
    }
    /** @test */
    public function should_update_Requester_legal_person_with_success()
    {
        Carbon::setTestNow(now());
        /** @var HelpRequest $helpRequest*/
        $result = $this->repository->update(json_decode(json_encode($this->Requester()->setPersonableId($this->legalPerson->id)->setPersonableType('LegalPerson')->create()), true));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_update_requester_physical_person_with_success()
    {
        Carbon::setTestNow(now());
        /** @var HelpRequest $helpRequest*/
        $result = $this->repository->update(json_decode(json_encode($this->Requester()->setPersonableId($this->physicalPerson->id)->setPersonableType('PhysicalPerson')->create()), true));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_update_requester_legal_person_with_Error()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $result = $this->repository->update(json_decode(json_encode($this->Requester()->setId(null)->setPersonableId($this->legalPerson->id)->setPersonableType('LegalPerson')->make()), true));
        $this->assertSame($result, 0);
    }

    /** @test */
    public function should_update_requester_physical_person_with_Error()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $result = $this->repository->update(json_decode(json_encode($this->Requester()->setId(null)->setPersonableId($this->physicalPerson->id)->setPersonableType('PhysicalPerson')->make()), true));
        $this->assertSame($result, 0);
    }
}
