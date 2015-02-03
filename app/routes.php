<?php



Route::model('cat', 'Cat');

View::composer('cats.edit', function($view)
{
  $breeds = Breed::all();
  $breed_options = array_combine($breeds->lists('id'), $breeds->lists('name'));
  $view->with('breed_options', $breed_options);
});

Route::get('/', function() {
  return Redirect::to("cats");
});

Route::get('about', function(){
  return View::make('about')->with('number_of_cats', 9000);
});


Route::get('cats', function(){



    $sortby=Input::get('sortby');
    $search=Input::get('search');

     if ($search){
	    $cats=  Cat::where('name', 'like', '%'.$search.'%')->get();
	} else {
	      $cats= Cat::all();
	}

    $cats=$cats->sortBy("name");

if ($sortby){
 $cats=$cats->sortBy($sortby);
 }


  return View::make('cats/index')
    ->with('cats', $cats);
});

Route::get('cats/breeds/{name}', function($name){
  $breed = Breed::whereName($name)->with('cats')->first();
  return View::make('cats/index')
    ->with('breed', $breed)
    ->with('cats', $breed->cats);
});



// need authentication
Route::group(array('before'=>'auth'), function(){

Route::get('cats/create', function() {
  $cat = new Cat;
  return View::make('cats.edit')
    ->with('cat', $cat)
    ->with('method', 'post');
});


Route::get('cats/{cat}/edit', function(Cat $cat) {
  return View::make('cats.edit')
    ->with('cat', $cat)
    ->with('method', 'put');
});

Route::get('cats/{cat}/delete', function(Cat $cat) {
  return View::make('cats.edit')
    ->with('cat', $cat)
    ->with('method', 'delete');
});


});





Route::post('cats', function(){

   $rules = array(
  	'name' => 'required|min:3', // Required, > 3 characters
  	'date_of_birth' => array('required', 'date') // Must be a date
  );

  $validator =Validator::make(Input::all(), $rules);

if ($validator->fails()) {
   return Redirect::back()->with('messages', $validator->messages());


      if($messages->has('name')){
    foreach ($messages->get('name') as $message){
    echo $message;
    }
       }


   } else {
  $cat = Cat::create(Input::all());
  $cat->user_id = Auth::user()->id;
if($cat->save()){
  return Redirect::to('cats/' . $cat->id)
    ->with('message', 'Successfully created profile!');
    } else {
return Redirect::back()
->with('error', 'Could not create profile');
}

}



});

Route::get('cats/{id}', function($id) {
  $cat = Cat::find($id);
  return View::make('cats.single')
    ->with('cat', $cat);
});




Route::put('cats/{cat}', function(Cat $cat) {



   $rules = array(
  	'name' => 'required|min:3', // Required, > 3 characters
  	'date_of_birth' => array('required', 'date') // Must be a date
  );

  $validator =Validator::make(Input::all(), $rules);


 if ($validator->fails()) {
      return Redirect::back()->with('messages', $validator->messages());


      if($messages->has('name')){
    foreach ($messages->get('name') as $message){
    echo $message;
    }
       }



   } else {
      if(Auth::user()->canEdit($cat)){
	    $cat->update(Input::all());
	    return Redirect::to('cats/' . $cat->id)
	      ->with('message', 'Successfully updated profile!');
	      } else {
	  	return Redirect::to('cats/' . $cat->id)
	  	->with('error', "Unauthorized operation");
       }


}






});

Route::delete('cats/{cat}', function(Cat $cat) {
  $cat->delete();
  return Redirect::to('cats')
    ->with('message', 'Successfully deleted profile!');
});





Route::get('login', function(){
return View::make('login');
});


Route::post('login', function(){
if(Auth::attempt(Input::only('username', 'password'))) {
return Redirect::intended('/');
} else {
return Redirect::back()
->withInput()
->with('error', "Invalid credentials");
}
});

Route::get('logout', function(){
Auth::logout();
return Redirect::to('/')
->with('message', 'You are now logged out');
});