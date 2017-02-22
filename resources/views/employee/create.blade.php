@extends('layouts.app')
{{-- Web site Title --}}
@section('title')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Create new Employee</h3>

            {{ Form::open([
            'url' => route('employer_create'),
            'class' => 'form-horizontal'
            ]) }}
            <div class="form-group {{ $errors->has('fullname') ? ' has-error' : '' }}">
                <label for="formGroupExampleInput">Full name</label>
                {{Form::text('fullname', '', [
                    'class' => 'form-control'
                ]) }}
            </div>
            <div class="form-group {{ $errors->has('position') ? ' has-error' : '' }}">
                <label for="formGroupExampleInput">Position</label>
                {{Form::text('position', '', [
                    'class' => 'form-control'
                ]) }}
            </div>
            <div class="form-group {{ $errors->has('salary') ? ' has-error' : '' }}">
                <label for="formGroupExampleInput">Salary</label>
                {{Form::text('salary', '', [
                    'class' => 'form-control'
                ]) }}
            </div>
            <div class="form-group {{ $errors->has('chief') ? ' has-error' : '' }}">
                <label for="formGroupExampleInput">Chief</label>
                {{Form::select('chief', $chief, '', [
                    'class' => 'form-control'
                ]) }}
            </div>
            <div class="form-group {{ $errors->has('employment_date') ? ' has-error' : '' }}">
                <label for="formGroupExampleInput">Chief</label>
                {{Form::date('employment_date', date('Y-m-d', time()), [
                    'class' => 'form-control'
                ])}}
            </div>
            <div class="form-group">
                {{ Form::submit('Send', [
                     'class' => 'btn btn-primary'
                 ]) }}
            </div>
            {{ Form::close() }}

        </div>
    </div>

@endsection