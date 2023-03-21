<?php

namespace Tests\Feature\Domain\Repositories;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Aggregates\CashFlowBalance;
use Domain\Entities\CashFlow;
use Domain\VOs\Contracts\DateVOInterface;
use Domain\VOs\Contracts\IdVoInterface;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Infrastructure\Repositories\Eloquent\CashFlowEloquentRepository;

class CashFlowRepositoryTest extends TestCase
{
    protected $repository;
    protected $request;
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(CashFlowEloquentRepository::class);
        $this->request = App::make(Request::class);
    }

    /** @test */
    public function should_update_cash_flow_with_success()
    {
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $result = $this->repository->update(json_decode(json_encode($this->cashFlow()->create()), true));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_update_cash_flow_with_Error()
    {
        Carbon::setTestNow(now());
        $this->expectException(ErrorException::class);
        /** @var CashFlow $cashFlow*/
        $this->cashFlow()->create();
        $this->repository->update(json_decode(json_encode($this->cashFlow()->make()), true));
    }

    /** @test */
    public function delete_should_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $callback = $this->cashFlow()->create();
        $result = $this->repository->delete($callback->id);
        $this->assertSame($result, 1);
    }

    /** @test */
    public function delete_should_return_zero_because_dont_find_id()
    {
        Carbon::setTestNow(now());
        $result = $this->repository->delete('877998877');
        $this->assertSame($result, 0);
    }


    /** @test */
    public function find_by_id_should_return_a_cash_flow_object()
    {
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $callback = $this->cashFlow()->create();
        $result = $this->repository->findById($callback->id);
        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertDatabaseHas(
            'cash_flows',
            $callback->getAttributes()
        );
    }

    /** @test */
    public function find_by_id_should_return_model_not_found_exception()
    {
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $this->expectException(ModelNotFoundException::class);
        $this->repository->findById('12345678', true);
    }

    /** @test */
    public function should_create_cashFlow_and_return_success()
    {
        Carbon::setTestNow(now());
        $result = $this->repository->create(json_decode(json_encode($this->cashFlow()->make()), true));
        $this->assertNotNull($result);
    }

    /** @test */
    public function should_create_cash_flow_balance_with_success()
    {
        Carbon::setTestNow(now());
        /** @var CashFlowBalance $cashFlowBalance*/
        $result = $this->repository->updateBalance(json_decode(json_encode($this->cashFlowBalance()->create()), true));
        $this->assertNotNull($result);
    }

    /** @test */
    public function should_return_error_because_note_is_null()
    {
         /** @var CashFlow $cashFlow*/
      $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
      $this->repository->create(json_decode(json_encode($this->cashFlow()->setNote(null)->make()), true));
    
    }

    /** @test */
    public function should_destroy_and_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $callback = $this->cashFlow()->create();
        $this->request->merge(['id' => $callback->id]);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_destroy_and_return_number_0()
    {
        Carbon::setTestNow(now());
        $this->request->merge(['id' => '1234567']);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 0);
    }

   
    /** @test */
    public function should_return_colletion_find_all_cash_flow_by_date_with_success()
     {
         Carbon::setTestNow(now());
           /** @var CashFlow $cashFlow*/
         $callback = $this->cashFlow()->setType('credit')->create();
         $date = Carbon::now()->format('Y-m-d');
         $this->request->merge(['type' => $callback->type, 'initialDate'=> $date, 'finalDate'=> $date]);
         $type = App::makeWith('Domain\VOs\Contracts\TypeVoInterface');
         $date = App::makeWith(DateVOInterface::class);
         $result = $this->repository->findAllByDate($date, $type, 1, 1);
         $this->assertTrue($result->contains('id', $callback->id));
     }

    /** @test */
    public function should_return_validation_because_initial_date_is_required()
    {
        $this->expectException(ValidationException::class);
        Carbon::setTestNow(now());
        /** @var CashFlow $cashFlow*/
        $callback = $this->cashFlow()->setType('credit')->create();
        $date = Carbon::now()->format('Y-m-d');
        $this->request->merge(['type' => $callback->type, 'initialDate'=> null, 'finalDate'=> $date]);
        $type = App::makeWith('Domain\VOs\Contracts\TypeVoInterface');
        $date = App::makeWith('Domain\VOs\Contracts\DateVOInterface');    
        $this->repository->findAllByDate($date, $type, 1, 1);
    }

    /** @test */
    public function should_return_validation_exception_because_type_is_required()
    {
        $this->expectException(ValidationException::class);
        Carbon::setTestNow(now());
        $date = Carbon::now()->format('Y-m-d');
        $this->request->merge(['type' => null, 'initialDate'=> $date, 'finalDate'=> $date]);
        $type = App::makeWith('Domain\VOs\Contracts\TypeVoInterface');
        $date = App::makeWith('Domain\VOs\Contracts\DateVOInterface');    
        $this->repository->findAllByDate($date, $type, 1, 1);
    }
}
