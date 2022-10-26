<?php

namespace Tests\Unit\Domain\Aggregates;

use Domain\Aggregates\ChatFile;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ChatFileTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new ChatFile();
    }

    public function test_fillable()
    {
        $expected = [
            'file_path',
            'chat_id',
        ];

        $fillable =  $this->model->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function test_rules()
    {
        $expected = [
            'file_path' => 'required',
            'chat_id' => 'required',
        ];

        $rules =  $this->model->rules();

        $this->assertEquals($expected, $rules);
    }
}