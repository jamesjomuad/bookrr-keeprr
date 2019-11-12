<?php namespace Bookrr\Keeprr\Models;

use Model;

/**
 * Customer Model
 */
class Customer extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    public $table = 'bookrr_keeprr_users';

    public $rules = [
        'phone'     => 'required|regex:/^([-a-z0-9_ ])+$/i|min:6'
    ];

    protected $guarded = ['*'];

    protected $fillable = ['address','phone','birth_date'];

    #
    #   Relation
    #
    public $belongsTo = [
        'user' => [
            \Backend\Models\User::class,
            'key'    => 'user_id',
            'delete' => true
        ]
    ];

    #
    #   Set Default Query
    #
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);
        $query->isCustomer();
        return $query;
    }

    #
    #   Scopes
    #
    public function scopeIsCustomer($query)
    {
        return $query->with('user')
        ->whereHas('user.role',function($q){
            $q->where('code','customer');
        });
    }

    #
    #   Events
    #
    public function afterDelete()
    {
        $this->user()->delete();
    }

}
