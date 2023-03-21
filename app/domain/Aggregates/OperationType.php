<?php

namespace Domain\Aggregates;

use Domain\Aggregates\Contracts\OperationTypeAggregateInterface;
use Domain\Entities\CashFlow;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * @property uuid $id
 * @property string $label
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $update_at
 */

class OperationType extends Model implements OperationTypeAggregateInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;

    protected $fillable = [
        'label',
        'description'
    ];

    /**
     * @return array
     */
    private static function getRules()
    {
       $request = App::make(Request::class);
     
        return [
            'label' => 'required|string|min:3|max:500|unique:operation_types,label,' . $request->id ?? null,
            'description' => 'required|string|min:3|max:500',
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
