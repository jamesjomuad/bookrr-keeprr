<?php namespace Bookrr\Keeprr\Components;

use Cms\Classes\ComponentBase;
use Bookrr\Keeprr\Models\Product;


class Products extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Products/Services',
            'description' => 'Display list of product and services. Variables: title, content, url'
        ];
    }

    public function defineProperties()
    {
        return [
            'itemsPerPage' => [
                'title'             => 'Items per page',
                'description'       => 'Amount of items per page',
                'default'           => 6,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Max Items property can contain only numeric symbols'
            ],
            'order' => [
                'title'             => 'Item Order',
                'description'       => 'Ordering',
                'type'              => 'dropdown',
                'options'           => ['asc'=>'Oldest to Latest', 'desc'=>'Latest to Oldest']
           ]
        ];
    }

    public function onRun()
    {
        $this->page['products'] = $this->products();
    }

    private function products()
    {
        return Product::orderBy('id',$this->property('order'))
        ->paginate($this->property('itemsPerPage'),$this->param('page'));
    }
}