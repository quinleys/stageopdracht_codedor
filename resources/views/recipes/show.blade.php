@extends('layouts.app')

@section('content')
<h1> {{ $recipe -> name }} </h1> 

<h1> {{ $recipe -> ingredient()->count() }} </h1>
<h1> {{ $recipe->category->title }} </h1>
@foreach($recipe->ingredient as $ingredient)
    <h1>{{ $ingredient->title }}</h1>

@endforeach
<viewrecipe>
</viewrecipe>
 @endsection