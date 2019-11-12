<?php namespace Bookrr\Keeprr\Models;

use Model;

/**
 * Task Model
 */
class Task extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'bookrr_keeprr_tasks';

    protected $guarded = ['*'];

    protected $fillable = [];

    protected $rules = [
        'name' => 'required'
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
