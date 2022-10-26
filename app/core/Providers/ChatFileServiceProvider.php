<?php

namespace App\Providers;

use Application\Services\Contracts\ChatFile\CreateChatFilePathsInterface;
use Domain\Aggregates\ChatFile;
use Domain\Aggregates\Contracts\ChatFileAggregateInterface;
use Domain\Services\ChatFile\CreateChatFilePaths;
use Illuminate\Support\ServiceProvider;

class ChatFileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ChatFileAggregateInterface::class, ChatFile::class);
        $this->app->bind(CreateChatFilePathsInterface::class, CreateChatFilePaths::class);
          
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
