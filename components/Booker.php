<?php namespace Bookrr\Keeprr\Components;

use Cms\Classes\ComponentBase;
use Bookrr\Keeprr\Models\Booking;
use Validator;
use Carbon\Carbon;


class Booker extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Booker',
            'description' => 'Booking component for House Keeping.'
        ];
    }

    public function defineProperties()
    {
        return [
            'headerTitle' => [
                'title'             => 'Heading title',
                'description'       => 'Heading title',
                'default'           => 'Book Now',
                'type'              => 'string'
            ],
            'btnLabel' => [
                'title'             => 'Button Label',
                'description'       => 'Button Label',
                'default'           => 'Book Now',
                'type'              => 'string'
            ],
            'successMessage' => [
                'title'             => 'Success Message',
                'description'       => 'Success Message',
                'default'           => 'Thank you for booking with us!',
                'type'              => 'string'
            ],
        ];
    }

    public function onRun()
    {
        $this->addCss('/plugins/bookrr/keeprr/assets/css/datetimepicker.css');
        $this->addJs('/plugins/bookrr/keeprr/assets/js/moment.js');
        $this->addJs('/plugins/bookrr/keeprr/assets/js/datetimepicker.js');
        $this->addJs('/plugins/bookrr/keeprr/components/booker/assets/js/script.js','v1.1');
    }

    public function onBook()
    {
        $data = input();

        $data['date_start'] = Carbon::parse($data['date_start'])->format('Y-m-d H:i:s');

        $book = new Booking($data);

        $book->customMessages = [
            'zip.required' => 'Zip field is required.',
            'num_bedroom.required' => 'Number of Bedroom field is required.',
            'num_bathroom.required' => 'Number of Bathroom field is required.',
        ];

        $book->save();

        return $book;
    }
}
