<?php

namespace Tests\Feature\Domain\Repositories;

use Tests\TestCase;
use Carbon\Carbon;
use Domain\VOs\Contracts\IdVoInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class ContactRepositoryTest extends TestCase
{

    protected $repository;
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make('Infrastructure\Repositories\ContactRepository');
        $this->request = App::make(Request::class);
    }

    /** @test */
    public function should_update_contact_requester_with_success()
    {
        Carbon::setTestNow(now());
        /** @var Requester $requester*/
        $requester = $this->requester()->create();
        $result = $this->repository->update(json_decode(json_encode($this->Contact()->setContactableType('Requester')->setContactableId($requester->id)->create()), true));
        $this->assertSame($result, 1);
    }

      /** @test */
      public function should_update_contact_tenant_with_success()
      {
          Carbon::setTestNow(now());
          /** @var Tenant $tenant*/
          $tenant = $this->Tenant()->create();
          $result = $this->repository->update(json_decode(json_encode($this->Contact()->setContactableType('Tenant')->setContactableId($tenant->id)->create()), true));
          $this->assertSame($result, 1);
      }

    /** @test */
    public function should_update_contact_tenant_with_Error()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $tenant = $this->tenant()->create();
        $result = $this->repository->update(json_decode(json_encode($this->contact()->setId(null)->setContactableType('Tenant')->setContactableId($tenant->id)->make()), true));
        $this->assertSame($result, 0);
    }

       /** @test */
       public function should_update_contact_requester_with_Error()
       {
           Carbon::setTestNow(now());
           /** @var Requester $requester*/
           $requester = $this->Requester()->create();
           $result = $this->repository->update(json_decode(json_encode($this->contact()->setId(null)->setContactableType('requester')->setContactableId($requester->id)->make()), true));
           $this->assertSame($result, 0);
       }

    /** @test */
    public function delete_contact_tenant_should_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $tenant = $this->tenant()->create();
        $contact = $this->contact()->setContactableType('Tenant')->setContactableId($tenant->id)->make();
        $callback = $this->contact()->create($contact->getAttributes());
        $result = $this->repository->delete($callback->id);
        $this->assertSame($result, 1);
    }

     /** @test */
     public function delete_contact_requester_should_return_number_1()
     {
         Carbon::setTestNow(now());
         /** @var Requester $requester*/
         $requester = $this->requester()->create();
         $contact = $this->contact()->setContactableType('Requester')->setContactableId($requester->id)->make();
         $callback = $this->contact()->create($contact->getAttributes());
         $result = $this->repository->delete($callback->id);
         $this->assertSame($result, 1);
     }


    /** @test */
    public function delete_contact_tenant_should_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $result = $this->repository->delete('877998877');
        $this->assertSame($result, 0);
    }

    /** @test */
    public function delete_contact_requester_should_return_number_0()
    {
        Carbon::setTestNow(now());
        /** @var Requester $requester*/
        $result = $this->repository->delete('877998877');
        $this->assertSame($result, 0);
    }



    /** @test */
    public function find_by_id_contact_tenant_should_return_a_object()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $tenant = $this->tenant()->create();
        $contact = $this->contact()->setContactableType('Tenant')->setContactableId($tenant->id)->make();
        $callback = $this->contact()->create($contact->getAttributes());
        $result = $this->repository->findById($callback->id);
        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertDatabaseHas(
            'contacts',
            $callback->getAttributes()
        );
    }

     /** @test */
     public function find_by_id_contact_requester_should_return_a_object()
     {
         Carbon::setTestNow(now());
         /** @var Requester $requester*/
         $requester = $this->requester()->create();
         $address = $this->contact()->setContactableType('Requester')->setContactableId($requester->id)->make();
         $callback = $this->contact()->create($address->getAttributes());
         $result = $this->repository->findById($callback->id);
         $this->assertNotNull($result);
         $this->assertIsObject($result);
         $this->assertDatabaseHas(
             'contacts',
             $callback->getAttributes()
         );
     }

    /** @test */
    public function find_by_id_contact_tenant_should_return_Error()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $this->expectException(ModelNotFoundException::class);
        $this->repository->findById('12345678', true);
    }

     /** @test */
     public function find_by_id_contact_requester_should_return_Error()
     {
         Carbon::setTestNow(now());
         /** @var Requester $requester*/
         $this->expectException(ModelNotFoundException::class);
         $this->repository->findById('12345678', true);
     }

    /** @test */
    public function should_create_contact_tenant_and_return_success()
    {
        Carbon::setTestNow(now());
        $tenant = $this->tenant()->create();
        $address = $this->contact()->setContactableType('Tenant')->setContactableId($tenant->id)->make();
        $result = $this->repository->create($address->getAttributes());
        $this->assertNotNull($result);
    }

      /** @test */
      public function should_create_contact_requester_and_return_success()
      {
          Carbon::setTestNow(now());
          $requester = $this->Requester()->create();
          $address = $this->contact()->setContactableType('Requester')->setContactableId($requester->id)->make();
          $result = $this->repository->create($address->getAttributes());
          $this->assertNotNull($result);
      }

    /** @test */
    public function should_return_error_because_cell_phone_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->contact()->setCellPhone(null)->make()), true));
    }


    /** @test */
    public function should_return_error_because_email_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->contact()->setEmail(null)->make()), true));
    }




    /** @test */
    public function should_return_error_because_contactable_id_is_null()
    {
        $this->expectException(QueryException::class);
        Carbon::setTestNow(now());
        $this->repository->create(json_decode(json_encode($this->contact()->setContactableId(null)->make()), true));
    }


   /** @test */
   public function should_return_error_because_contactable_type_is_null()
   {
       $this->expectException(QueryException::class);
       Carbon::setTestNow(now());
       $this->repository->create(json_decode(json_encode($this->contact()->setContactableType(null)->make()), true));
   }


    /** @test */
    public function should_destroy_contact_tenant_and_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var Tenant $tenant*/
        $tenant = $this->tenant()->create();
        $contact = $this->contact()->setContactableType('Tenant')->setContactableId($tenant->id)->make();
        $callback = $this->contact()->create($contact->getAttributes());
        $this->request->merge(['id' => $callback->id]);
        $result = $this->repository->destroy(App::makeWith(IdVoInterface::class));
        $this->assertSame($result, 1);
    }

    /** @test */
    public function should_destroy_contact_requester_and_return_number_1()
    {
        Carbon::setTestNow(now());
        /** @var Requester $requester*/
        $requester = $this->requester()->create();
        $contact = $this->contact()->setContactableType('Requester')->setContactableId($requester->id)->make();
        $callback = $this->contact()->create($contact->getAttributes());
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
