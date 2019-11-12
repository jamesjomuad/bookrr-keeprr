<?php namespace Bookrr\Keeprr\Models;

use Model;

/**
 * Keepers Model
 */
class Keepers extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'bookrr_keeprr_users';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

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
        $query->isKeeper();
        return $query;
    }

    #
    #   Scopes
    #
    public function scopeIsKeeper($query)
    {
        return $query->with('user')
        ->whereHas('user.role',function($q){
            $q->where('code','keeper');
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
