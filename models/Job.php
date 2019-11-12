<?php namespace Bookrr\Keeprr\Models;

use Model;

/**
 * Job Model
 */
class Job extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'bookrr_keeprr_jobs';

    protected $guarded = ['*'];

    protected $fillable = [];

    protected $rules = [
        'name' => 'required'
    ];

    public $belongsToMany = [
        'task' => [
            \Bookrr\Keeprr\Models\Task::class,
            'table' => 'bookrr_keeprr_jobtask_pivot',
            'key'   => 'job_id'
        ]
    ];
}
