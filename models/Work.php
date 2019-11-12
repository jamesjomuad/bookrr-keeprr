<?php namespace Bookrr\Keeprr\Models;

use Model;

/**
 * Work Model
 */
class Work extends Model
{
    use \October\Rain\Database\Traits\SoftDelete;

    public $table = 'bookrr_keeprr_works';

    protected $guarded = ['*'];

    protected $fillable = [
        'title',
        'priority',
        'status'
    ];

    public $belongsTo = [
        'booking' => [
            \Bookrr\Keeprr\Models\Booking::class,
            'key' => 'book_id'
        ]
    ];

    public $belongsToMany = [
        'task' => [
            \Bookrr\Keeprr\Models\Task::class,
            'table' => 'bookrr_keeprr_worktask_pivot',
            'key'   => 'work_id',
            'pivot' => ['status','priority','note'],
            'timestamps' => true
        ]
    ];


    #
    #   Options
    #
    public function getPriorityOptions()
    {
        return [
            1 => 'None',
            2 => 'Low',
            3 => 'Mid',
            4 => 'High'
        ];
    }

    public function getStatusOptions()
    {
        return [
            1 => 'Open',
            2 => 'Ongoing',
            3 => 'Issue',
            4 => 'QA',
            5 => 'Done'
        ];
    }
}

