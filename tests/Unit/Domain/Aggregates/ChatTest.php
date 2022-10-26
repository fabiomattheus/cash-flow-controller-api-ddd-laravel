<?php

namespace Tests\Unit\Domain\Aggregates;

use Domain\Aggregates\Chat;
use Domain\Aggregates\Contracts\ChatAggregateInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;


class ChatTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new Chat();

    }

    public function test_fillable()
    {
        $expected = [
            'note',
            'help_request_id',
        ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            ChatAggregateInterface::class,
            $this->model
        );
    }


    public function test_rules()
    {
        $expected = [
            'note' => 'required',
            'help_request_id' => 'required',
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }
}
