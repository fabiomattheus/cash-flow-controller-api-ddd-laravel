<?php

namespace tests\Feature\Domain\Services\ChateFile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class CreateChatFilePathsTest extends TestCase
{
    protected $generateCode;

    public function setUp(): void
    {
        parent::setUp();
        $this->chatFilePaths = $this->app->make('Domain\Services\ChatFile\CreateChatFilePaths');
        $this->request = App::make(Request::class);
        $this->helpRequest = $this->helpRequest()->create();
        $this->chat = $this->chat()->setHelpRequestId($this->helpRequest->id)->create();
        
    }

    /** @test */
    public function create_file_paths()
    { 
        $this->request->replace([
            'chat_id' => $this->chat->id,
            'url' =>  $this->chat->url,
            'help_request_id"'=> $this->chat->help_request_id
        ]);
        $return = $this->chatFilePaths->execute(['path1', 'path2', 'path3']);

        $this->assertNull($return);
    }
}
