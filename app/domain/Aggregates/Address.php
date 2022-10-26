<?php

namespace Domain\Aggregates;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Domain\Aggregates\Contracts\AddressAggregateInterface;
use Domain\Traits\GeneratePrimaryKeyUuid;

/**
 * @property uuid $id
 * @property string $street
 * @property string $district
 * @property string $lat
 * @property string $long
 * @property string $zip_code
 * @property string $complement
 * @property string $number
 * @property string $city
 * @property string $state
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $update_at
 */

 class Address extends Model implements AddressAggregateInterface
{
    use GeneratePrimaryKeyUuid;
    use HasFactory;
    protected $fillable = [
        'street',
        'district',
        'lat',
        'long',
        'zip_code',
        'complement',
        'number',
        'city',
        'state',
        'type',
        'addressable_type',
        'addressable_id'
    ];

    /**
     * @return array
     */
    private static function getRules()
    {
        return [
        'street'=> 'required',
        'district' => 'required',
        'lat' => 'required',
        'long' => 'required',
        'zip_code' => 'required',
        'complement' => 'required',
        'number' => 'nullable',
        'city' => 'required',
        'state' => 'required',
        'type' => 'required',
        'addressable_type' => 'required',
        'addressable_id' => 'required'
        ];
    }

    /**
     * @return array
     */

     public function rules()
     {
        return self::getRules();
     }

     public function addressable()
     {
        return $this->morphto;
     }
}

