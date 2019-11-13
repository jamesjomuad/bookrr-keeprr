<?php namespace Bookrr\Keeprr\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Carbon\Carbon;
use Bookrr\Keeprr\Models\Booking as Book;
use Bookrr\Keeprr\Models\Work;
use Config;


/**
 * Booking Back-end Controller
 */
class Booking extends Controller
{
    use \Bookrr\Extra\Traits\Widgets;

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $jobFinderWidget;

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Bookrr.Keeprr', 'keeprr', 'booking');

        $this->addCss(Config::get('bookrr.keeprr::assetPath').'/css/fullcalendar.min.css');

        $this->addJs(Config::get('bookrr.keeprr::assetPath').'/js/fullcalendar.min.js');

        $this->addJs(Config::get('bookrr.keeprr::assetPath').'/js/booking.js','v1.0');

        $this->jobFinderWidget = $this->FormWidget([
            'config'    => '$/bookrr/keeprr/models/booking/fields_work.yaml',
            'model'     => new \Bookrr\Keeprr\Models\Booking,
            'alias'     => 'workorder',
            'arrayName' => 'workorder'
        ]);
    }

    public function listOverrideColumnValue($model, $col)
    {
        switch($col){
            case 'date_start':
                if($model->date_start)
                return $model->date_start->format('D M d, Y (g a)');
            break;
            case 'num_bedroom':
                if($model->num_bedroom==11)
                {
                    return '10 Plus';
                }
            break;
            case 'num_bathroom':
                if($model->num_bathroom==11)
                {
                    return '10 Plus';
                }
            break;
        }
    }

    public function events()
    {
        $timestamp = Carbon::createFromTimestamp(input('time'));

        $query = Book::monthOf($timestamp);

        if(input('pending'))
        {
            $query->pending();
        }

        $mapped = $query->get()->map(function($item){
            return [
                'id'    => $item->id,
                'title' => $item->email,
                'start' => Carbon::parse($item->date_start)->format('Y-m-d'),
                'end'   => Carbon::parse($item->date_end)->addDay()->format('Y-m-d'),
                'url'   => '/backend/bookrr/keeprr/booking/update/'.$item->id,
                'backgroundColor' => '#9bd918',
                'borderColor' => '#9bd918'
            ];
        });
    
        return response()->json($mapped->toArray());
    }

    public function formAfterUpdate($model, $context = null)
    {
        if($model->job AND $model->job->id AND $model->work == NULL)
        {
            $work = new Work([
                'title' => 'Work order from booking ' . $model->number,
                'priority' => 1,
                'status' => 1
            ]);

            $work->booking = $model;

            $work->save();

            # Set pivot field default values
            $tasks = $model->job->task
                ->mapWithKeys(function ($value, $key) {
                    $task = collect($value)->only(['priority','status'])->toArray();
                    $task['status'] = 1;
                    return [
                        $value['id'] => $task
                    ];
                })->toArray();

            $work->task()->sync($tasks);
        }
    }

    public function onWorkOrder($id)
    {
        $this->vars['widget'] = $this->jobFinderWidget;

        return $this->makePartial('work_order');
    }

}
