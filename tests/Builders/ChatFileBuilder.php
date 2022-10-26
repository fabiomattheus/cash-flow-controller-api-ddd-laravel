<?php

namespace Tests\Builders;

use Domain\Aggregates\ChatFile;

class ChatFileBuilder
{
    protected $attributes = [];

    public function setFilePath($filePath = null): self
    {
        $this->attributes['file_path'] = $filePath;
        return $this;
    }

    public function setChatId($chatId = null): self
    {
        $this->attributes['chat_id'] = $chatId;
        return $this;
    }

    public function create($quantity = null)
    {
        return ChatFile::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return ChatFile::factory($quantity)->make($this->attributes);
    }
}
