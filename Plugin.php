<?php namespace Bookrr\Keeprr;

use Backend;
use Event;
use System\Classes\PluginBase;
use Backend\Models\User as UsersModel;


class Plugin extends PluginBase
{
    public $elevated = true;
 
    public function pluginDetails()
    {
        return [
            'name'        => 'House Keeprr',
            'description' => 'House Keeping booking system.',
            'author'      => 'bookrr',
            'icon'        => 'icon-leaf'
        ];
    }
 
    public function boot()
    {
        # Extend User
        UsersModel::extend(function($model){
            # Extend Relations
            $model->hasOne['customer']  = [
                'Bookrr\Keeprr\Models\Customer',
                'delete' => true
            ];
            $model->hasOne['keeper']  = [
                'Bookrr\Keeprr\Models\Keepers',
                'delete' => true
            ];
        });
    }

    public function registerComponents()
    {
        return [
            'Bookrr\Keeprr\Components\Register' => 'register',
            'Bookrr\Keeprr\Components\Booker' => 'booker',
        ];
    }

    public function registerPermissions()
    {
        return [
            'bookrr.keeprr.bookings' => [
                'tab' => 'Keeprr',
                'label' => 'Manage Bookings'
            ],
            'bookrr.keeprr.jobs' => [
                'tab' => 'Keeprr',
                'label' => 'Manage Jobs'
            ],
        ];
    }
 
    public function registerNavigation()
    {
        return [
            'keeprr' => [
                'label'       => 'Cleanrr',
                'url'         => Backend::url('bookrr/keeprr/booking'),
                'icon'        => 'icon-list',
                'permissions' => ['bookrr.keeprr.bookings'],
                'order'       => 500,
                'sideMenu'    => [
                    'booking' => [
                        'label'       => 'Bookings',
                        'url'         => Backend::url('bookrr/keeprr/booking'),
                        'icon'        => 'icon-list',
                        'permissions' => ['bookrr.keeprr.bookings'],
                    ],
                    'work' => [
                        'label'       => 'Work Order',
                        'url'         => Backend::url('bookrr/keeprr/work'),
                        'icon'        => 'icon-calendar-check-o',
                        'permissions' => ['bookrr.keeprr.work'],
                    ],
                    'jobs' => [
                        'label'       => 'Jobs',
                        'url'         => Backend::url('bookrr/keeprr/jobs'),
                        'icon'        => 'icon-sign-language',
                        'permissions' => ['bookrr.keeprr.jobs'],
                    ],
                    'keepers' => [
                        'label'       => 'House Keepers',
                        'url'         => Backend::url('bookrr/keeprr/keepers'),
                        'icon'        => 'icon-users',
                        'permissions' => ['bookrr.keeprr.bookings'],
                    ],
                    'customer' => [
                        'label'       => 'Clients',
                        'url'         => Backend::url('bookrr/keeprr/customer'),
                        'icon'        => 'icon-users',
                        'permissions' => ['bookrr.keeprr.services'],
                        'order'       => 503,
                    ],
                ],
            ]
        ];
    }
}
