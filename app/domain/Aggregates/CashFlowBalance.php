<?php

namespace Domain\Aggregates;

use Domain\Aggregates\Contracts\CashFlowBalanceAggregateInterface;
use Domain\Entities\CashFlow;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property double $balance
 * @property foreignUuid $cash_flow_id
 * @property Carbon $created_at
 * @property Carbon $update_at
 */

class CashFlowBalance extends Model implements CashFlowBalanceAggregateInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;
    protected $fillable = [
        'balance',
        'cash_flow_id'
    ];

    /**
     * @return array
     */
    private static function getRules()
    {
        return [
            'cash_flow_id' => 'required|uuid',
            'balance' => 'required|numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ];
    }

    /**
     * @return array
     */
    public function rules()
{
        return self::getRules();
    }

    public function cashFlow()
    {
        return $this->belongsTo(CashFlow::class);
    }


}
