@extends('layouts.app')

@section('content')
<h1> Categories </h1> 
@foreach($categories as $category)
    <h1>{{ $category->title }}</h1>
@endforeach

 @endsection