<?php namespace Bookrr\Keeprr\Components;

use Cms\Classes\ComponentBase;
use Flash;
use Backend\Models\User;
use Backend\Models\UserRole;
use Bookrr\Keeprr\Models\Customer;

class Register extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Registration',
            'description' => 'Customer registration'
        ];
    }

    public function onRegister()
    {   
        session()->put('customer_id', '$customer->id');

        return redirect()->to('user/login');


        $customer = Customer::create(post());

        $customer->user = User::create([
            'login'                 => post('username'),
            'email'                 => post('email'),
            'first_name'            => post('fname'),
            'last_name'             => post('lname'),
            'password'              => post('password'),
            'password_confirmation' => post('password'),
        ]);

        $customer->user->role()->associate(UserRole::where('code','customer')->first())->save();

        $customer->save();
        
        Flash::success('Successfuly Registered!');

        session()->put('customer_id', $customer->id);

        return redirect()->to('user/login');
    }
}
