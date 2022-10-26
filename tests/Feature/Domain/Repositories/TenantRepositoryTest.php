<?php

namespace Tests\Feature\Domain\Repositories;

use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class TenantRepositoryTest extends TestCase
{
    protected $repository;
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make('Infrastructure\Repositories\TenantRepository');
        $this->request = App::make(Request::class);
        $this->legalPerson = $this->legalPerson()->create();
        $this->physicalPerson = $this->physicalPerson()->create();
    }
 /** @test */
 public function should_create_tenant_and_return_success()
 {
     Carbon::setTestNow(now());
     $tenant = $this->Tenant()->make();
     $result = $this->repository->create($tenant->getAttributes());
     $this->assertNotNull($result);
 }

 /** @test */
 public function should_update_tenant_legal_person_with_success()
 {
     Carbon::setTestNow(now());
     /** @var HelpRequest $helpRequest*/
     $result = $this->repository->update(json_decode(json_encode($this->Tenant()->setId()->setPersonableId($this->legalPerson->id)->setPersonableType('LegalPerson')->create()), true));
     $this->assertSame($result, 1);
 }

 /** @test */
 public function should_update_tenant_physical_person_with_success()
 {
     Carbon::setTestNow(now());
     /** @var HelpRequest $helpRequest*/
     $result = $this->repository->update(json_decode(json_encode($this->Tenant()->setId()->setPersonableId($this->physicalPerson->id)->setPersonableType('PhysicalPerson')->create()), true));
     $this->assertSame($result, 1);
 }

 /** @test */
 public function should_update_tenant_legal_person_with_Error()
 {
     Carbon::setTestNow(now());
     /** @var Tenant $tenant*/
     $result = $this->repository->update(json_decode(json_encode($this->Tenant()->setId(null)->setPersonableId($this->legalPerson->id)->setPersonableType('LegalPerson')->make()), true));
     $this->assertSame($result, 0);
 }

 /** @test */
 public function should_update_tenant_physical_person_with_Error()
 {
     Carbon::setTestNow(now());
     /** @var Tenant $tenant*/
     $result = $this->repository->update(json_decode(json_encode($this->Tenant()->setId(null)->setPersonableId($this->physicalPerson->id)->setPersonableType('PhysicalPerson')->make()), true));
     $this->assertSame($result, 0);
 }

}
