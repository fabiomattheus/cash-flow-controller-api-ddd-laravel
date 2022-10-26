<?php

namespace Domain\Entities;

use Domain\Entities\Help;
use Domain\Aggregates\Chat;
use Domain\Entities\Contracts\HelpRequestEntityInterface;
use Domain\Entities\Requester;
use Domain\Entities\PurchaseItem;
use Illuminate\Database\Eloquent\Model;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property uuid $id
 * @property string $identifier
 * @property foreignUuid $help_id
 * @property foreignUuid $requester_id
 * @property foreignUuid $purchase_item_id
 * @property Carbon $created_at
 * @property Carbon $update_at
 */
class HelpRequest extends Model implements HelpRequestEntityInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;

    protected $fillable = [
        'identifier',
        'status',
        'help_id',
        'requester_id',
        'purchase_item_id',
    ];

    /**
     * @return array
     */
    private static function getRules()
    {

        return [
            'identifier' => 'required',
            'status' => 'required',
            'help_id' => 'required',
            'requester_id' => 'required',
            'purchase_item_id' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }

    public function help()
    {
        return $this->belongsTo(Help::class);
    }

    public function requester()
    {
        return $this->belongsTo(Requester::class);
    }

    public function purchaseItem()
    {
        return $this->hasOne(PurchaseItem::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

}
