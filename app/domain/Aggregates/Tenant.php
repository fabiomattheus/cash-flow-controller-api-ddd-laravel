<?php

namespace Domain\Aggregates;

use Domain\Aggregates\Contracts\TenantAggregateInterface;
use Domain\Entities\PurchaseItem;
use Illuminate\Database\Eloquent\Model;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property uuid $id
 * @property string $logo
 * @property string $personable_type
 * @property uuid $personable_id 
 * @property Carbon $created_at
 * @property Carbon $update_at
 */
 
Relation::enforceMorphMap([
    'PhysicalPerson' => 'Domain\Entities\PhysicalPerson',
    'LegalPerson' => 'Domain\Entities\LegalPerson',
    'Address' => 'Domain\Entities\Address',
]);


class Tenant extends Model implements TenantAggregateInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;

    protected $fillable = [
        'logo',
        'personable_id',
        'personable_type'
   
    ];

    /**
     * @return array
     */
    private static function getRules()
    {

        return [
            'logo' => 'required',
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

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
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
