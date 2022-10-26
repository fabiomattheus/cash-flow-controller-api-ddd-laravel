<?php

namespace Tests\Feature\Domain\Repositories;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\Aggregates\Address;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AddressRepositoryTest extends TestCase
{

    protected $repository;
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make('Infrastructure\Repositories\AddressRepository');
        $this->request = App::make(Request::class);
    }

    /** @test */
    // public function should_update_address_requester_with_success()
    // {
    //     Carbon::setTestNow(now());
    //     /** @var Requester $requester*/
    //     $requester = $this->requester()->create();
    //     $result = $this->repository->update(json_decode(json_encode($this->address()->setAddressableType('Requester')->setAddressableId($requester->id)->create()), true));
    //     $this->assertSame($result, 1);
    // }

      /** @test */
      public function should_update_address_tenant_with_success()
      {
          Carbon::setTestNow(now());
          /** @var Tenant $tenant*/
          $tenant = $this->Tenant()->create();
          $result = $this->repository->update(json_decode(json_encode($this->address()->setAddressableType('Tenant')->setAddressableId($tenant->id)->create()), true));
          $this->assertSame($result, 1);
      }

    /** @test */
    public function should_update_address_tenant_with_Error()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $tenant = $this->tenant()->create();
        $result = $this->repository->update(json_decode(json_encode($this->address()->setId(null)->setAddressableType('Tenant')->setAddressableId($tenant->id)->make()), true));
        $this->assertSame($result, 0);
    }

       /** @test */
       public function should_update_address_requester_with_Error()
       {
           Carbon::setTestNow(now());
           /** @var Requester $requester*/
           $requester = $this->Requester()->create();
           $result = $this->repository->update(json_decode(json_encode($this->address()->setId(null)->setAddressableType('requester')->setAddressableId($requester->id)->make()), true));
           $this->assertSame($result, 0);
       }

    /** @test */
    public function delete_address_tenant_should_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $tenant = $this->tenant()->create();
        $address = $this->address()->setAddressableType('Tenant')->setAddressableId($tenant->id)->make();
        $callback = $this->address()->create($address->getAttributes());
        $result = $this->repository->delete($callback->id);
        $this->assertSame($result, 1);
    }

     /** @test */
     public function delete_address_requester_should_return_number_1()
     {
         Carbon::setTestNow(now());
         /** @var Requester $requester*/
         $requester = $this->requester()->create();
         $address = $this->address()->setAddressableType('Requester')->setAddressableId($requester->id)->make();
         $callback = $this->address()->create($address->getAttributes());
         $result = $this->repository->delete($callback->id);
         $this->assertSame($result, 1);
     }


    /** @test */
    public function delete_address_tenant_should_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $result = $this->repository->delete('877998877');
        $this->assertSame($result, 0);
    }

    /** @test */
    public function delete_address_requester_should_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var Requester $requester*/
        $result = $this->repository->delete('877998877');
        $this->assertSame($result, 0);
    }



    /** @test */
    public function find_by_id_address_tenant_should_return_a_object()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $tenant = $this->tenant()->create();
        $address = $this->address()->setAddressableType('Tenant')->setAddressableId($tenant->id)->make();
        $callback = $this->address()->create($address->getAttributes());
        $result = $this->repository->findById($callback->id);
        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertDatabaseHas(
            'addresses',
            $callback->getAttributes()
        );
    }

     /** @test */
     public function find_by_id_address_requester_should_return_a_object()
     {
         Carbon::setTestNow(now());
         /** @var Requester $requester*/
         $requester = $this->requester()->create();
         $address = $this->address()->setAddressableType('Requester')->setAddressableId($requester->id)->make();
         $callback = $this->address()->create($address->getAttributes());
         $result = $this->repository->findById($callback->id);
         $this->assertNotNull($result);
         $this->assertIsObject($result);
         $this->assertDatabaseHas(
             'addresses',
             $callback->getAttributes()
         );
     }

    /** @test */
    public function find_by_id_address_tenant_should_return_Error()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $this->expectException(ModelNotFoundException::class);
        $this->repository->findById('12345678', true);
    }

     /** @test */
     public function find_by_id_address_requester_should_return_Error()
     {
         Carbon::setTestNow(now());
         /** @var Requester $requester*/
         $this->expectException(ModelNotFoundException::class);
         $this->repository->findById('12345678', true);
     }

    /** @test */
    public function should_create_address_tenant_and_return_success()
    {
        Carbon::setTestNow(now());
        $tenant = $this->tenant()->create();
        $address = $this->address()->setAddressableType('Tenant')->setAddressableId($tenant->id)->make();
        $result = $this->repository->create($address->getAttributes());
        $this->assertNotNull($result);
    }

      /** @test */
      public function should_create_address_requester_and_return_success()
      {
          Carbon::setTestNow(now());
          $requester = $this->Requester()->create();
          $address = $this->address()->setAddressableType('Requester')->setAddressableId($requester->id)->make();
          $result = $this->repository->create($address->getAttributes());
          $this->assertNotNull($result);
      }

    /** @test */
    public function should_return_error_because_state_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->Address()->setState(null)->make()), true));
    }


    /** @test */
    public function should_return_error_because_city_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->Address()->setCity(null)->make()), true));
    }


    /** @test */
    public function should_return_error_because_addressable_id_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->Address()->setAddressableId(null)->make()), true));
    }

       /** @test */
       public function should_return_error_because_addressable_type_is_null()
       {
           $this->expectException(QueryException::class);
           Carbon::setTestNow(now());
           $this->repository->create(json_decode(json_encode($this->Address()->setAddressableType(null)->make()), true));
       }

          /** @test */
    public function should_return_error_because_complement_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->Address()->setComplement(null)->make()), true));
    }

       /** @test */
       public function should_return_error_because_lat_is_null()
       {
           $this->expectException(QueryException::class);
           Carbon::setTestNow(now());
           $this->repository->create(json_decode(json_encode($this->Address()->setLat(null)->make()), true));
       }

          /** @test */
    public function should_return_error_because_long_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->Address()->setLong(null)->make()), true));
    }

       /** @test */
       public function should_return_error_because_district_is_null()
       {
           $this->expectException(QueryException::class);
           Carbon::setTestNow(now());
           $this->repository->create(json_decode(json_encode($this->Address()->setDistrict(null)->make()), true));
       }

          /** @test */
    public function should_return_error_because_type_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->Address()->setType(null)->make()), true));
    }

       /** @test */
       public function should_return_error_because_zip_code_is_null()
       {
           $this->expectException(QueryException::class);
           Carbon::setTestNow(now());
           $this->repository->create(json_decode(json_encode($this->Address()->setZipCode(null)->make()), true));
       }

          /** @test */
    public function should_return_error_because_street_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->Address()->setStreet(null)->make()), true));
    }

    /** @test */
    public function should_destroy_address_tenant_and_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $tenant = $this->tenant()->create();
        $address = $this->address()->setAddressableType('Tenant')->setAddressableId($tenant->id)->make();
        $callback = $this->address()->create($address->getAttributes());
        $this->request->merge(['id' => $callback->id]);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_destroy_address_requester_and_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var Requester $requester*/
        $requester = $this->requester()->create();
        $address = $this->address()->setAddressableType('Requester')->setAddressableId($requester->id)->make();
        $callback = $this->address()->create($address->getAttributes());
        $this->request->merge(['id' => $callback->id]);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_destroy_address_tenant_and_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $this->request->merge(['id' => '1234567']);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 0);
    }


     /** @test */
     public function should_destroy_address_requester_and_return_number_0()
     {
         Carbon::setTestNow(now());
         /** @var Requester $requester*/
         $this->request->merge(['id' => '1234567']);
         $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
         $this->assertSame($result, 0);
     }

}
