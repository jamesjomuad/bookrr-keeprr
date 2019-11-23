<?php namespace Bookrr\Keeprr\Models;

use Model;
use Bookrr\Keeprr\Models\Work;




class Booking extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'bookrr_keeprr_bookings';

    protected $guarded = ['*'];

    protected $dates = ['date_start','date_end'];

    protected $fillable = [
        'email',
        'phone',
        'num_bedroom',
        'num_bathroom',
        'status',
        'code',
        'zip',
        'date_start',
        'date_end',
        'promo_code',
        'note'
    ];

    protected $rules = [
        'zip'           => 'required',
        'num_bedroom'   => 'required',
        'num_bathroom'  => 'required'
    ];

    public $customMessages = [
        'zip.required' => 'Zip is required.',
        'num_bedroom.required' => 'Number of Bedroom field is required.',
        'num_bathroom.required' => 'Number of Bathroom field is required.',
    ];

    #
    # Relations
    #
    public $belongsTo = [
        'job' => \Bookrr\Keeprr\Models\Job::class
    ];

    public $hasOne = [
        'work' => [
            \Bookrr\Keeprr\Models\Work::class,
            'key' => 'book_id'
        ]
    ];

    public $statusOptions = [
        'pending' => 'Pending',
        'ready' => 'Ready for cleaning',
        'ongoing' => 'Ongoing',
        'done' => 'Done',
        'cancel' => 'Cancelled'
    ];



    #
    #   Options
    #
    public function getStatusOptions()
    {
        return $this->statusOptions;
    }

    #
    #   Scopes
    #
    public function scopePendings($query)
    {
        $query->where('status','pending');
        return $query;
    }

    public function scopeMonthOf($query,$timestamp)
    {
        $query->whereMonth('date_start',$timestamp->month)
            ->whereYear('date_start',$timestamp->year)
        ;

        $query->orWhere(function($nest) use($timestamp) {
            $nest->whereMonth('date_end',$timestamp->month)
                ->whereYear('date_start',$timestamp->year)
            ;
        });
        return $query;
    }

    #
    #   Events
    #
    // public function beforeCreate()
    // {
    //     $this->status = $this->statusOptions['pending'];
    //     $this->number = '#' . str_pad(uniqid(), 8, "0", STR_PAD_LEFT);
    // }

    public function filterFields($fields, $context = null)
    {
        if($this->job AND $this->job->id){
            $fields->status->value = 'ready';
        }
    }

    #
    #   Accessor
    #
    public function getNumberAttribute($value)
    {
        if(!$value)
        return '#' . hexdec(uniqid());
        return $value;
    }

    public function getStatusAttribute($value)
    {
        if(!$value)
        return $this->statusOptions['pending'];
        return $value;
    }
}