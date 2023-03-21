<?php

namespace Domain\Entities;

use Domain\Entities\Contracts\EmployeeEntityInterface;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property uuid $id
 * @property string $photo
 * @property string $personable_id
 * @property string $personable_type
 * @property Carbon $created_at
 * @property Carbon $update_at
 */

class Employee extends Model implements EmployeeEntityInterface
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
            'photo' => 'required|string',
            'personable_id' => 'required|uuid',
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
    
    public function cashFlows()
    {
        return $this->hasMany(CashFlow::class);
    }

    public function departaments()
    {
        return $this->hasMany(Departament::class);
    }
}
