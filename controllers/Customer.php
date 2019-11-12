<?php namespace Bookrr\Keeprr\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Backend\Models\User;
use Backend\Models\UserRole;

/**
 * Customer Back-end Controller
 */
class Customer extends Controller
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

        BackendMenu::setContext('Bookrr.Keeprr', 'keeprr', 'customer');
    }

    public function formExtendModel($model)
    {
        /*
         * Init proxy field model if we are creating the model
         */
        if ($this->action == 'create') {
            $model->user = new User;
            $model->user->role()->add(UserRole::where('code','customer')->first());
        }
        return $model;
    }
}
