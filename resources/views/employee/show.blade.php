@extends('layouts.app')

@section('content')
    @if(!empty($text))
        <div class="container">{!! $text !!}</div>
    @endif
    @if(!empty(Session::get('message')))
        <div class="alert alert-success" role="alert">
            {!! Session::get('message') !!}
        </div>

    @endif

    <div class="row">
        <div class="col-md-12">
            <a href="{{route('employer_create')}}" class="btn btn-primary">Create new employee</a>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $grid ?>
        </div>
    </div>

@endsection