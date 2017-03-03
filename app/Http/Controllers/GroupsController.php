<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function store(Request $request){
    	$this->validate($request, [
    		'name' => 'required| unique:groups',
    		]);

    	return \App\Group::create($request->all());

    }
}
