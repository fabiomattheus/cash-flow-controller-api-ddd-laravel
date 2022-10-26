<?php

namespace Domain\Entities;

use Illuminate\Http\Request;
use Domain\Aggregates\Tenant;
use Domain\Entities\Requester;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Domain\Entities\Contracts\LegalPersonEntityInterface;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property string $corporate_name
 * @property string $fantasy_name
 * @property string $cnpj
 * @property string $stateRegistration
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

 Relation::enforceMorphMap([
    'Requester' => 'Domain\Entities\Store',
    'Tenant' => 'Domain\Entities\Tenant'
]);

class LegalPerson extends Model implements LegalPersonEntityInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;


    protected $table = 'legal_persons';

    protected $fillable = [
        'corporate_name',
        'fantasy_name',
        'cnpj',
        'state_registration',
    ];

    /**
     * @return array
     */
    private static function getRules()
    {
        $request = App::make(Request::class);
        return [
            'corporate_name' => 'required|unique:legal_persons,corporate_name,',
            'fantasy_name' => 'required|unique:legal_persons,fantasy_name,',
            'cnpj' => 'required|cnpj|unique:legal_persons,cnpj,',
            'state_registration' => 'nullable'
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }

    public function requester()
    {
        return $this->morphOne(Requester::class, 'personable');
    }

    public function tenant()
    {
        return $this->morphOne(Tenant::class, 'personable');
    }

}
