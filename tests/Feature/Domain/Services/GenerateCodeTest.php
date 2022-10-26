<?php

namespace Tests\Feature\Domain\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class GenerateCodeTest extends TestCase
{
    protected $generateCode;

    public function setUp(): void
    {
        parent::setUp();
        $this->generateCode = $this->app->make('Domain\Services\HelpRequest\GenerateCode');
        $this->request = App::make(Request::class);
    }

    /** @test */
    public function generating_code_for_identifier(){
        $this->generateCode->execute();
        $this->assertNotNull($this->request->identifier);
    }

}
