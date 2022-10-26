<?php

namespace Tests\Feature\Domain\Repositories;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Entities\Help;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class LegalPersonRepositoryTest extends TestCase
{
    protected $repository;
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make('Infrastructure\Repositories\LegalPersonRepository');
        $this->request = App::make(Request::class);
    }

    /** @test */
    public function should_update_legal_person_with_success()
    {
        Carbon::setTestNow(now());
        /** @var LegalPerson $legalPerson*/
        $result = $this->repository->update(json_decode(json_encode($this->LegalPerson()->create()), true));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_update_legal_person_with_Error()
    {
        Carbon::setTestNow(now());
        /** @var LegalPerson $legalPerson*/
        $result = $this->repository->update(json_decode(json_encode($this->LegalPerson()->setId(null)->make()), true));
        $this->assertSame($result, 0);
    }

    /** @test */
    public function delete_should_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var LegalPerson $legalPerson*/
        $callback = $this->LegalPerson()->create();
        $result = $this->repository->delete($callback->id);
        $this->assertSame($result, 1);
    }

    /** @test */
    public function delete_should_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var LegalPerson $LegalPerson*/
        $result = $this->repository->delete('877998877');
        $this->assertSame($result, 0);
    }


    /** @test */
    public function find_by_id_should_return_a_object()
    {
        Carbon::setTestNow(now());
        /** @var LegalPerson $legalPerson*/
        $callback = $this->LegalPerson()->create();
        $result = $this->repository->findById($callback->id);
        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertDatabaseHas(
            'legal_persons',
            $callback->getAttributes()
        );
    }

    /** @test */
    public function find_by_id_should_return_Error()
    {
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $this->expectException(ModelNotFoundException::class);
        $this->repository->findById('12345678', true);
    }

    /** @test */
    public function should_create_legal_person_and_return_success()
    {
        Carbon::setTestNow(now());
        $result = $this->repository->create(json_decode(json_encode($this->LegalPerson()->make()), true));
        $this->assertNotNull($result);
    }

    /** @test */
    public function should_return_error_because_corporate_name_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->LegalPerson()->setCorporateName(null)->make()), true));
    }

    /** @test */
    public function should_return_error_because_fantasy_name_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->LegalPerson()->setFantasyName(null)->make()), true));
    }

    /** @test */
    public function should_return_error_because_cnpj_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->LegalPerson()->setCnpj(null)->make()), true));
    }

    /** @test */
    public function should_destroy_and_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var LegalPerson $legalPerson*/
        $callback = $this->LegalPerson()->create();
        $this->request->merge(['id' => $callback->id]);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_destroy_and_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var LegalPerson $legalPerson*/
        $callback = $this->LegalPerson()->create();
        $this->request->merge(['id' => '1234567']);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 0);
    }
}
