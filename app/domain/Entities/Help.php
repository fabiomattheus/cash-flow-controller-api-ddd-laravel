<?php

namespace Domain\Entities;

use Domain\Entities\HelpRequest;
use Illuminate\Database\Eloquent\Model;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Domain\Entities\Contracts\HelpEntityInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * @property uuid $id
 * @property string $label
 * @property string $description
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $update_at
 */
class Help extends Model implements HelpEntityInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;

    protected $fillable = [
        'label',
        'description',
        'type',
        'requisition_type',
        'parent_id'
      ];

    /**
     * @return array
     */
    private static function getRules()
    {
        $request = App::make(Request::class);

        return [
            'label' => 'required|unique:helps,label'. $request->id ?? null,
            'description' => 'required',
            'type' => 'required',
            'requisition_type'=> 'required',
            'parent_id' => 'sometimes|required',
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }

    public function helpRequests()
    {
        return $this->hasMany(HelpRequest::class);
    }

    public function children()
    {
        return $this->hasMany(Help::class, 'parent_id', 'id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

}
