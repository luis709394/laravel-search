@extends('master')

@section('header')
  @if(isset($breed))
    <a href="{{URL::to('/')}}">Back to the overview</a>
  @endif
  <h2>
    All @if(isset($breed)) {{$breed}} @endif Cats
    <a href="{{URL::to('cats/create')}}"
       class="btn btn-primary pull-right">
      Add a new cat
    </a>
  </h2>
@stop



@section('content')

       	<div class="search">
	   	{{ Form::open(array('url' => 'cats', 'method' => 'get')) }}
	       {{Form::text('search')}}
	       {{ Form::submit('Search By Name') }}
	       {{ Form::close() }}
       </div>



	<div class="sort">
	{{ Form::open(array('url' => 'cats', 'method' => 'get')) }}
    {{Form::select('sortby', array('date_of_birth' => 'Date of Birth', 'name' => 'Name'))}}
    {{ Form::submit('Sort') }}
    {{ Form::close() }}
</div>



  @foreach($cats as $cat)
    <div class="cat">
      <a href="{{URL::to('cats/'.$cat->id)}}">
        <strong> {{{$cat->name}}} </strong> - {{$cat->breed->name}}

      </a>
    </div>
  @endforeach
@stop

