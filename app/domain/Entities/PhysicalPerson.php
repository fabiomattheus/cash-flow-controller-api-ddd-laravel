<?php

namespace Domain\Entities;

use Illuminate\Http\Request;
use Domain\Aggregates\Tenant;
use Domain\Entities\Contracts\PhysicalPersonEntityInterface;
use Domain\Entities\Requester;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property uuid $id
 * @property string $name
 * @property string $last_name
 * @property string $cpf
 * @property string $mother_name
 * @property string $father_name
 * @property Carbon $birth date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */


class PhysicalPerson extends Model implements PhysicalPersonEntityInterface
{

    use HasFactory;
    use GeneratePrimaryKeyUuid;

    protected $table = 'physical_persons';

    /**
     * @return array
     */
    private static function getRules()
    {
        $request = App::make(Request::class);
        return [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'cpf' => 'sometimes|required|cpf|unique:physical_persons,cpf,' . $request->id ?? null,
            'mother_name' => 'required|string',
            'father_name' => 'required|string',
            'birth_date' => 'required|date_format:Y-m-d'
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'cpf',
        'mother_name',
        'father_name',
        'birth_date'
    ];

    public function requester()
    {
        return $this->morphOne(Requester::class, 'personable');
    }

    public function tenant()
    {
        return $this->morphOne(Tenant::class, 'personable');
    }
}