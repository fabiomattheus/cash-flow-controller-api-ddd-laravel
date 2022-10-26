<?php

namespace Domain\Entities;

use Domain\Aggregates\Tenant;
use Domain\Entities\Contracts\PurchaseItemEntityInterface;
use Domain\Entities\HelpRequest;
use Illuminate\Database\Eloquent\Model;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property uuid $id
 * @property string $purchase_identifier
 * @property string $product_id
 * @property string $product_name
 * @property string $product_brand
 * @property string $product_amount
 * @property foreignUuid $tenant_id
 * @property Carbon $created_at
 * @property Carbon $update_at
 */
class PurchaseItem extends Model implements PurchaseItemEntityInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;

    protected $fillable = [
        'purchase_identifier',
        'product_id',
        'product_name',
        'product_brand',
        'product_amount',
        'tenant_id',
    ];

    /**
     * @return array
     */
    private static function getRules()
    {

        return [
            'purchase_identifier' => 'required',
            'product_id' => 'required',
            'product_name' => 'required',
            'product_brand' => 'required',
            'product_amount' => 'required|integer|min:1',
            'tenant_id' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function helpRequests()
    {
        return $this->belongsTo(HelpRequest::class);
    }
}
