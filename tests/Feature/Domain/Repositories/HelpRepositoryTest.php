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
use Illuminate\Validation\ValidationException;

class HelpRepositoryTest extends TestCase
{
    protected $repository;
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make('Infrastructure\Repositories\HelpRepository');
        $this->request = App::make(Request::class);
    }

    /** @test */
    public function should_update_help_with_success()
    {
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $result = $this->repository->update(json_decode(json_encode($this->help()->create()), true));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_update_help_with_Error()
    {
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $this->help()->create();
        $result = $this->repository->update(json_decode(json_encode($this->help()->setId(null)->make()), true));
        $this->assertSame($result, 0);
    }

    /** @test */
    public function delete_should_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $callback = $this->help()->create();
        $result = $this->repository->delete($callback->id);
        $this->assertSame($result, 1);
    }

    /** @test */
    public function delete_should_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $callback = $this->help()->create();
        $result = $this->repository->delete('877998877');
        $this->assertSame($result, 0);
    }


    /** @test */
    public function find_by_id_should_return_a_object()
    {
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $callback = $this->help()->create();
        $result = $this->repository->findById($callback->id);
        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertDatabaseHas(
            'helps',
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
    public function should_create_help_and_return_success()
    {
        Carbon::setTestNow(now());
        $result = $this->repository->create(json_decode(json_encode($this->help()->make()), true));
        $this->assertNotNull($result);
    }

    /** @test */
    public function should_return_error_because_label_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->help()->setLabel(null)->make()), true));
    }

    /** @test */
    public function should_destroy_and_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $callback = $this->help()->create();
        $this->request->merge(['id' => $callback->id]);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_destroy_and_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $callback = $this->help()->create();
        $this->request->merge(['id' => '1234567']);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 0);
    }


    /** @test */
    public function should_find_help_by_type()
    {
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $callback = $this->help()->setType('purchase')->create();
        $this->request->merge(['type' => $callback->type]);
        App::makeWith('Domain\VOs\Contracts\TypeVoInterface');
        $result = $this->repository->findAllByType(App::makeWith('Domain\VOs\Contracts\TypeVoInterface'), 1, 1);
        $this->assertNotNull($result);
    }

    /** @test */
    public function should_return_validation_error_find_help_by_type()
    {
        $this->expectException(ValidationException::class);
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $this->help()->create();
        $this->request->merge(['type' => null]);
        $this->repository->findAllByType(App::makeWith('Domain\VOs\Contracts\TypeVoInterface'));
    }

    public function should_return_query_error_find_help_by_type()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        /** @var Help $help*/
        $this->request->merge(['type' => null]);
        $this->repository->findAllByType(App::makeWith('Domain\VOs\Contracts\TypeVoInterface'));
    }
}
