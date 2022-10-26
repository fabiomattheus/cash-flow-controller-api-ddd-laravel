<?php

namespace Domain\Services\ChatFile;

use Application\Services\Contracts\ChatFile\CreateChatFilePathsInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Domain\Repositories\HelpRequestRepositoryInterface as Repository;
use Domain\Aggregates\Contracts\ChatFileAggregateInterface as ChatFileAggregate;
use Domain\Dto\Contracts\DtoInterface;

class CreateChatFilePaths implements CreateChatFilePathsInterface
{
    protected $repository;
    protected $chatFileAggregate;
    protected $dto;

    public function __construct(
        Repository $repository,
        ChatFileAggregate $chatFileAggregate,
    ) {
        $this->repository = $repository;
        $this->chatFileAggregate = $chatFileAggregate;
    }

    public function execute(iterable $paths): void
    {
        $request = App::make(Request::class);
        if (!empty($paths)) {
            foreach ($paths as $path) {
                $request->merge(['file_path' => $path]);
                $this->repository->createChatFilePaths(App::makeWith(DtoInterface::class)::fromRequest($this->chatFileAggregate));
            }
        }
    }
}
