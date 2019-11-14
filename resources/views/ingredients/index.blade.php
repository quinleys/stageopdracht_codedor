@extends('layouts.app')

@section('content')
@foreach($ingredients as $ingredient)
    <div>
        <h3> {{ $ingredient->title }} </h3>
        <p> {{ $ingredient->unit }} </p>
    </div>
@endforeach
@endsection