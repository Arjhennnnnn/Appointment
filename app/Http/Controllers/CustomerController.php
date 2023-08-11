<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function store(){
        $attributes = request()->validate([
            'name' => 'required',
            'email' => ['required','email',Rule::unique('customers','email')],
            'password' => 'required|confirmed|min:8',
        ]);
        $attributes['password'] = bcrypt($attributes['password']);
        Customer::create($attributes);

        return back()->with('message','Register Succesfully');

    }
}
