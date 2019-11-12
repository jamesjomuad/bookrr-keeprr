<?php namespace Bookrr\Keeprr\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Bookrr\Keeprr\Models\Work as WorkModel;
use Bookrr\Keeprr\Models\Job;
use Config;

/**
 * Work Back-end Controller
 */
class Work extends Controller
{

    public $model;

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';


    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Bookrr.Keeprr', 'keeprr', 'work');

        $this->addCss(Config::get('bookrr.keeprr::assetPath').'/css/job.css','v1.4');

        $this->model = new \Bookrr\Keeprr\Models\Work;
    }

    public function index()
    {
        $this->vars['open'] = $this->model->where('status',1)->get()->count();

        $this->vars['ongoing'] = $this->model->where('status',2)->get()->count();

        $this->vars['issue'] = $this->model->where('status',3)->get()->count();

        $this->vars['complete'] = $this->model->where('status',5)->get()->count();

        $this->asExtension('ListController')->index();
    }
}
