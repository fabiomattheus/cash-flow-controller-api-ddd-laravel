<?php

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\Contracts\HelpRequestEntityInterface;
use Domain\Entities\HelpRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;


class HelpRequestTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new HelpRequest();
    }

    public function test_fillable()
    {
        $expected = [ 
            'identifier',
            'status',
            'help_id',
            'requester_id',
            'purchase_item_id',
    ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            HelpRequestEntityInterface::class,
            $this->model
        );
    }

    public function test_rules()
    {
        $expected = [
            'identifier' => 'required',
            'status' => 'required',
            'help_id' => 'required',
            'requester_id' => 'required',
            'purchase_item_id' => 'required',
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }

    }