@extends('layouts.app')

@section('content')
    <results-component :search-id="{{ $searchId }}"></results-component>
@endsection
