<?php

namespace Tests\Feature\Domain\Services;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\UploadedFile;

use function PHPUnit\Framework\assertIsArray;

class StoreFilesTest extends TestCase
{
    protected $repository;
    public function setUp(): void
    {
        parent::setUp();
        $this->request = App::make(Request::class);
        $this->storeFiles = $this->app->make('Domain\Services\TEntity\StoreFiles');
    }

    /** @test */
    public function should_store_type_files_jpg()
    {
        Carbon::setTestNow(now());
        $this->request->replace([
            'model' => 'help_request',
            'url' => '123',
            'attachments' => [UploadedFile::fake()->image('avatar.jpeg', 110, 110)->size(100)]
        ]);

        $return = $this->storeFiles->execute();
        $this->assertIsArray($return);     
    }

    /** @test */
    public function should_store_type_files_pdf()
    {
        Carbon::setTestNow(now());
        $this->request->replace([
            'model' => 'help_request',
            'url' => '123',
            'attachments' => [UploadedFile::fake()->create('document.pdf', 12)]
        ]);

        $return = $this->storeFiles->execute();
        $this->assertIsArray($return);  
    }



}
