<?php

namespace Domain\Aggregates;

use Domain\Entities\Help;
use Domain\Entities\HelpRequest;
use Domain\Aggregates\ChatHelpFile;
use Domain\Aggregates\Contracts\ChatAggregateInterface;
use Illuminate\Database\Eloquent\Model;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Domain\Traits\GenerateUrlUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property uuid $id
 * @property string $note
 * @property string $url
 * @property foreignUuid $help_id
 * @property Carbon $created_at
 * @property Carbon $update_at
 */

class Chat extends Model implements ChatAggregateInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;
    use GenerateUrlUuid;

    protected $fillable = [
        'note',
        'help_request_id',
    ];

    /**
     * @return array
     */
    private static function getRules()
    {

        return [
            'note' => 'required',
            'help_request_id' => 'required', 
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }

    public function helpRequest()
    {
        return $this->belongsTo(HelpRequest::class);
    }

    public function chatHelpFiles()
    {
        return $this->hasMany(ChatHelpFile::class);
    }
}





