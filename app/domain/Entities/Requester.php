<?php

namespace Domain\Entities;

use Domain\Aggregates\Address;
use Domain\Aggregates\Contact;
use Domain\Entities\Contracts\RequesterEntityInterface;
use Domain\Entities\HelpRequest;
use Illuminate\Database\Eloquent\Model;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property uuid $id
 * @property string $photo
 * @property string $personable_type
 * @property uuid $personable_id
 * @property Carbon $created_at
 * @property Carbon $update_at
 */

Relation::enforceMorphMap([
    'Requester' => 'Domain\Entities\Requester',
    'Tenant' => 'Domain\Entities\Tenant'
]);

class Requester extends Model implements RequesterEntityInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;

    protected $fillable = [
        'photo',
        'personable_id',
        'personable_type'
    ];

    /**
     * @return array
     */
    private static function getRules()
    {

        return [
            'photo' => 'required',
            'personable_id' => 'required',
            'personable_type' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }

    public function helpRequests()
    {
        return $this->hasMany(HelpRequest::class);
    }

    public function personable()
    {
        return $this->morphTo();
    }

    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
