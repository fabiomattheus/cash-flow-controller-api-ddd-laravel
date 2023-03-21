<?php

namespace Tests\Feature\Domain\Services\CashFlow;

use Domain\Services\CashFlow\GenerateCodeCashFlowDomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class GenerateCodeCashFlowDomServiceTest extends TestCase
{
    protected $generateCode;
    protected $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->generateCode = $this->app->make(GenerateCodeCashFlowDomService::class);
        $this->request = App::make(Request::class);
    }

    /** @test */
    public function generating_code_for_identifier(){
        $this->generateCode->execute();
        $this->assertNotNull($this->request->identifier);
    }

}
