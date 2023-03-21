<?php

namespace Domain\Entities;

use Domain\Aggregates\Contracts\DepartamentAggregateInterface;
use Domain\Traits\GeneratePrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * @property uuid $id
 * @property string $title
 * @property Carbon $created_at
 * @property Carbon $update_at
 */

class Departament extends Model implements DepartamentAggregateInterface
{
    use HasFactory;
    use GeneratePrimaryKeyUuid;

   /**
     * @return array
     */
    private static function getRules()
    {
        $request = App::make(Request::class);       
        return [
            'title' => 'required|string|min:1|max:200|unique:departaments,title,' . $request->id ?? null,
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
        'title'  
    ];
  
    public function cashFlow()
    {
        return $this->hasMany(CashFlow::class);
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
}
