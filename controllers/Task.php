<?php namespace Bookrr\Keeprr\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Task Back-end Controller
 */
class Task extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Bookrr.Keeprr', 'keeprr', 'task');
    }
}
