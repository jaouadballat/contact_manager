<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
	protected $required = [
    		'name' => 'required|min:5',
    		'email' => 'required|email',
    		'company' => 'required'

    	];
      public function autocomplete(Request $request){
      		
				if ($q = $request->term) {
			    		$keyword = '%'.$q.'%';
			    		 return $contacts = \App\Contact::select(['id', 'name as value'])
			    						->where('name', 'LIKE', $keyword)
							    		->orderBy('name', 'asc')
							    		->take(5)
							    		->get();
			    	}
      		
      
    
    }

    public function index(Request $request){

    	if($group_id = $request->group_id){
    		$contacts = \App\Contact::where('group_id', $group_id)->orderBy('id', 'desc')->paginate(10);
    		
    	}elseif ($term = $request->q) {
    		$keyword = '%'.$term.'%';
    		$contacts = \App\Contact::where('name', 'LIKE', $keyword)
    						->orWhere('name', 'LIKE', $keyword)
    						->orWhere('company', 'LIKE', $keyword)
    						->orWhere('email', 'LIKE', $keyword)
				    		->orderBy('id', 'desc')
				    		->paginate(10);
    	}
    	else{
    		$contacts = \App\Contact::orderBy('id', 'desc')->paginate(10);
    	
    	}
    	return view('contacts.index', compact('contacts'));
    
    }

    public function create(){
    	return view('contacts.create');
    }
    private function getRequest($request){
    	 $input = $request->all();
    	 if($file = $request->file('photo')){
	    	 $filename = $file->getClientOriginalName();
	    	 $destination = public_path().'/uploads';
	    	 $file->move($destination, $filename);
	    	 $input['photo'] = $filename;
    	 }
    	 return $input;
    }

    public function store(Request $request){
    	$this->validate($request, $this->required);
    	$input = $this->getRequest($request);
    	\App\Contact::create($input);
    	return redirect('/contact')->with('message', 'Contact has been added successflly !');
    }

    public function edit($id){
    	
    	$contact = \App\Contact::find($id);
    	return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id){
    	$this->validate($request, $this->required);
    	$input = $this->getRequest($request);
    	$contact = \App\Contact::find($id);
    	$contact->update($input);
    	return redirect('/contact')->with('message', 'Contact has been updated!');

    }
    public function destroy($id){
    	$contact = \App\Contact::find($id);

    	$contact->delete();
    	$this->removePhoto($contact->photo);
    	return redirect('/contact')->with('message', 'contact has been deleted successflly');
    }
    private function removePhoto($photo){
    	if(!empty($photo)){
    		$file_path = public_path().'/uploads/'.$photo;
    		if (file_exists($file_path)){
    			unlink($file_path);
    		}
    	}
    }

}
