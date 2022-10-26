<?php

namespace Tests\Feature\Domain\Dto;

use Carbon\Carbon;
use Domain\Dto\Contracts\OtdInterface;
use Domain\Dto\Dto;
use Domain\Entities\Help;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Arg;
use ReflectionClass;

class DtoTest extends TestCase
{
    protected $repository;
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make('Infrastructure\Repositories\HelpRequestRepository');
        $this->entity = App::make(Help::class);
        $this->dto = App::make(OtdInterface::class);
        $this->request = App::make(Request::class);
        $this->help = $this->help()->setLabel('Reclamações')->make();
        $this->helpRequest = $this->helpRequest()->setHelpId($this->help->id)->setPurchaseItemId('123')->setRequesterId('123')->make();
        $this->helpWithoutLabel = $this->help()->setLabel(null)->make();
        $this->chat = $this->Chat()->setHelpRequestId($this->help->id)->make();
        $this->tenant = $this->tenant()->create();
        $this->reflection = new ReflectionClass($this->entity);
    }

    /** @test */
    public function aggregates_should_return_data()
    {
        $this->request->replace([
            'label' => 'value',
            'description' => 'value',
            'type' => 'value',
            'requisition_type' => 'value',
            'parent_id' => 'value',
            'Help' => $this->help->getAttributes(),
            'Chat' => $this->chat->getAttributes(),
            'Tenant' => $this->tenant->getAttributes(),
        ]);

        Carbon::setTestNow(now());
        $data = Arr::only($this->request->all(), $this->reflection->getShortName());
        $teste =  $this->dto->fromRequest($this->entity, true);   
        $this->assertSame($teste, $data[$this->reflection->getShortName()]);
        
    }

    /** @test */
    public function entities_should_return_data()
    {
        $this->request->replace([
            'label' => 'value',
            'description' => 'value',
            'type' => 'value',
            'requisition_type' => 'value',
            'parent_id' => 'value',
            'Help' => $this->help->getAttributes(),
            'Chat' => $this->chat->getAttributes(),
            'Tenant' => $this->tenant->getAttributes(),
        ]);

        Carbon::setTestNow(now());
        $data = $this->request->only($this->entity->getFillable());
        $teste =  $this->dto->fromRequest($this->entity);
        $this->assertSame($teste, $data);
    }

     /** @test */
     public function should_return_aggregate_data_with_unique_label()
     {
         $this->help = $this->help()->create();
         $this->request->replace([
             'label' => 'value',
             'description' => 'value',
             'type' => 'value',
             'requisition_type' => 'value',
             'parent_id' => 'value',
             'Help' => $this->help->getAttributes(),
             'Chat' => $this->chat->getAttributes(),
             'Tenant' => $this->tenant->getAttributes(),
         ]);
         Carbon::setTestNow(now());
         $data = Arr::only($this->request->all(), $this->reflection->getShortName());
         $teste =  $this->dto->fromRequest($this->entity, true);
         $this->assertSame($teste, $data[$this->reflection->getShortName()]);
     }

     /** @test */
    public function should_return_entities_data_with_unique_label()
    {
        $help = $this->help = $this->help()->create();
        $this->request->replace([
            'id'=> $help->id,
            'label' => 'value',
            'description' => 'value',
            'type' => 'value',
            'requisition_type' => 'value',
            'parent_id' => 'value',
            'Help' => $this->help->getAttributes(),
            'Chat' => $this->chat->getAttributes(),
            'Tenant' => $this->tenant->getAttributes(),
        ]);

        Carbon::setTestNow(now());
        $data = $this->request->only($this->entity->getFillable());
        $teste =  $this->dto->fromRequest($this->entity);
        $this->assertSame($teste, $data);
    }

        /** @test */
    public function should_return_validation_exception_error()
    {
        $this->expectException(ValidationException::class);
        $this->request->replace([
            'label' => 'value',
            'description' => 'value',
            'type' => 'value',
            'requisition_type' => 'value',
            'parent_id' => 'value',
            'Help' => $this->helpWithoutLabel->getAttributes(),
            'Chat' => $this->chat->getAttributes(),
            'Tenant' => $this->tenant->getAttributes(),
        ]);

        Carbon::setTestNow(now());
        $data = Arr::only($this->request->all(), $this->reflection->getShortName());
        $teste =  $this->dto->fromRequest($this->entity, true);
    }

    /** @test */
    // public function should_return_success_message()
    // {
    //     Carbon::setTestNow(now());
    //     $dto = $this->dto->toJson(['token' => '123', 'help'=>[
    //     $this->help->getAttributes()]
    //     ], Response::HTTP_CREATED);
    //     $this->assertSame(json_encode(
    //         ["token"=>"123","help"=>[[
    //             "label"=>"Reclamações",
    //             "description"=>"text",
    //             "type"=>"sale",
    //             "requisition_type"=>"customer",
    //             "parent_id"=>"Menu",]]],
    //     ), $dto->getContent(), '');
    // }
}
