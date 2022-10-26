<?php

namespace Tests\Feature\Domain\Repositories;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class PhysicalPersonRepositoryTest extends TestCase
{
    protected $repository;
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make('Infrastructure\Repositories\PhysicalPersonRepository');
        $this->request = App::make(Request::class);
    }

    /** @test */
    public function should_update_physical_person_with_success()
    {
        Carbon::setTestNow(now());
        /** @var PhysicalPerson $physicalPerson*/
        $result = $this->repository->update(json_decode(json_encode($this->PhysicalPerson()->create()), true));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_update_physical_person_with_Error()
    {
        Carbon::setTestNow(now());
        /** @var PhysicalPerson $physicalPerson*/
        $result = $this->repository->update(json_decode(json_encode($this->PhysicalPerson()->setId(null)->make()), true));
        $this->assertSame($result, 0);
    }

    /** @test */
    public function delete_should_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var PhysicalPerson $physicalPerson*/
        $callback = $this->PhysicalPerson()->create();
        $result = $this->repository->delete($callback->id);
        $this->assertSame($result, 1);
    }

    /** @test */
    public function delete_should_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var PhysicalPerson $physicalPerson*/
        $result = $this->repository->delete('877998877');
        $this->assertSame($result, 0);
    }


    /** @test */
    public function find_by_id_should_return_a_object()
    {
        Carbon::setTestNow(now());
        /** @var PhysicalPerson $physicalPerson*/
        $callback = $this->PhysicalPerson()->create();
        $result = $this->repository->findById($callback->id);
        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertDatabaseHas(
            'physical_persons',
            $callback->getAttributes()
        );
    }

    /** @test */
    public function find_by_id_should_return_Error()
    {
        Carbon::setTestNow(now());
        /** @var PhysicalPerson $physicalPerson*/
        $this->expectException(ModelNotFoundException::class);
        $this->repository->findById('12345678', true);
    }

    /** @test */
    public function should_create_physical_person_and_return_success()
    {
        Carbon::setTestNow(now());
        $result = $this->repository->create(json_decode(json_encode($this->PhysicalPerson()->make()), true));
        $this->assertNotNull($result);
    }

    /** @test */
    public function should_return_error_because_name_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->PhysicalPerson()->setName(null)->make()), true));
    }

    /** @test */
    public function should_return_error_because_last_name_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->PhysicalPerson()->setLastName(null)->make()), true));
    }

    /** @test */
    public function should_return_error_because_cpf_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->PhysicalPerson()->setCpf(null)->make()), true));
    }

     /** @test */
     public function should_return_error_because_mother_name_is_null()
     {
         $this->expectException(QueryException::class);
         Carbon::setTestNow(now());
         $this->repository->create(json_decode(json_encode($this->PhysicalPerson()->setMotherName(null)->make()), true));
     }


     /** @test */
     public function should_return_error_because_father_name_is_null()
     {
         $this->expectException(QueryException::class);
         Carbon::setTestNow(now());
         $this->repository->create(json_decode(json_encode($this->PhysicalPerson()->setFatherName(null)->make()), true));
     }

     /** @test */
     public function should_return_error_because_birth_date_is_null()
     {
         $this->expectException(QueryException::class);
         Carbon::setTestNow(now());
         $this->repository->create(json_decode(json_encode($this->PhysicalPerson()->setBirthDate(null)->make()), true));
     }

    /** @test */
    public function should_destroy_and_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var PhysicalPerson $physicalPerson*/
        $callback = $this->PhysicalPerson()->create();
        $this->request->merge(['id' => $callback->id]);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_destroy_and_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var PhysicalPerson $physicalPerson*/
        $callback = $this->PhysicalPerson()->create();
        $this->request->merge(['id' => '1234567']);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 0);
    }
}
