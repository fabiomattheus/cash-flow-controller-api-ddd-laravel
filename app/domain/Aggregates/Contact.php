<?php

namespace Domain\Aggregates;

use Application\Services\Contracts\ChatFile\DistinctAggregateInterface;
use Illuminate\Database\Eloquent\Model;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Domain\Aggregates\Contracts\ContactAggregateInterface;

Relation::enforceMorphMap([
    'Requester' => 'Domain\Entities\Requester',
    'Tenant' => 'Domain\Entities\Tenant'
]);

/**
 * @property uuid $id
 * @property string $phone
 * @property string $cell_phone
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $update_at
 */

class Contact extends Model implements ContactAggregateInterface
{
    use HasFactory, GeneratePrimaryKeyUuid;

    protected $fillable = [
        'phone',
        'cell_phone',
        'email',
        'contactable_id',
        'contactable_type',
    ];

    /**
     * @return array
     */
    private static function getRules()
    {
        return [
            'phone' => 'nullable',
            'cell_phone' => 'required',
            'email' => 'required|email',
            'contactable_id' => 'required',
            'contactable_type' => 'required',
        ];
    }

    /**
     * @return array
     */

     public function rules()
     {
        return self::getRules();
     }

     public function contactable()
     {
        return $this->morphto;
     }
}


