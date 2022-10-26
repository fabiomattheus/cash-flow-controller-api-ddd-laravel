<?php

namespace Application\Services\Contracts\ChatFile;

interface CreateChatFilePathsInterface
{
    public function execute(iterable $paths);
}
