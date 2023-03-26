<?php

namespace Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rules\Enum;

use Domain\Aggregates\CashFlowBalance;
use Domain\Aggregates\OperationType;
use Domain\Entities\Contracts\CashFlowEntityInterface;
use Domain\Entities\Enums\CashFlowTypeEnum;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Http\Request;


/**
 * @property uuid $id
 * @property string $identifier
 * @property string $note
 * @property string $description
 * @property string $type
 * @property date  $movimentation_date 
 * @property double $value
 * @property foreignUuid $departament_id
 * @property foreignUuid $opreation_note_id
 * @property foreignUuid $cash_flow_balance_id
 * @property foreignUuid employee_id
 * @property Carbon $created_at
 * @property Carbon $update_at
 */

class CashFlow extends Model implements CashFlowEntityInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;

    protected $fillable = [
        'identifier',
        'note',
        'description',
        'type',
        'movimentation_date',
        'value',
        'departament_id',
        'operation_type_id',
        'employee_id'
    ];
    

    /**
     * @return array
     */
    private static function getRules()
    {
        $request = App::make(Request::class);

        return [
            'identifier' => 'required|string|unique:cash_flows,identifier,' . $request->id ?? null,
            'note' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:all,credit,debit',
            'movimentation_date' => 'required|date',
            'value' => 'required|numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'departament_id' => 'required|uuid',
            'operation_type_id' => 'required|uuid',
            'employee_id' => 'required|uuid'
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }

    public function oprationType()
    {
        return $this->hasOne(OperationType::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id');
    }

    public function balance()
    {
        return $this->hasOne(CashFlowBalance::class);
    }

    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }
}
