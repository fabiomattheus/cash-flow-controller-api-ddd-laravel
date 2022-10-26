<?php

namespace Domain\Aggregates;

use Domain\Aggregates\Chat;
use Illuminate\Database\Eloquent\Model;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Domain\Aggregates\Contracts\ChatFileAggregateInterface;
use Domain\Traits\GenerateUrlUuid;

/**
 * @property uuid $id
 * @property string $file_path
 * @property foreignUuid $chat_id
 * @property Carbon $created_at
 * @property Carbon $update_at
 */
class ChatFile extends Model implements ChatFileAggregateInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;

    protected $table = 'chat_files';

    protected $fillable = [
        'file_path',
        'chat_id',
    ];

    /**
     * @return array
     */
    private static function getRules()
    {

        return [
            'file_path' => 'required',
            'chat_id' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }

    public function chat()
    {
        return $this->hasOne(Chat::class);
    }
}
