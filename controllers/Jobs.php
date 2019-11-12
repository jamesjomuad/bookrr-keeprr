<?php namespace Bookrr\Keeprr\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Carbon\Carbon;
use Config;



/**
 * Jobs Back-end Controller
 */
class Jobs extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = [
        'jobs'  => 'config_job_list.yaml',
        'tasks' => 'config_task_list.yaml'
    ];
    public $relationConfig = 'config_relation.yaml';

    public $assetPath = '/plugins/bookrr/keeprr/assets';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Bookrr.Keeprr', 'keeprr', 'jobs');

        $this->addCss(Config::get('bookrr.keeprr::assetPath').'/css/job.css','v1.4');
        $this->addJs(Config::get('bookrr.keeprr::assetPath').'/js/job.js','v1.1');
    }

    public function index()
    {   
        $this->asExtension('ListController')->index();
    }
}
