@extends('layouts.app')
{{-- Web site Title --}}
@section('title')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>{{$employee->fullname}}</h3>

            {{ Form::open([
            'url' => route('employer_update', ['id' => $employee->id]),
            'class' => 'form-horizontal'
            ]) }}
            <div class="form-group {{ $errors->has('fullname') ? ' has-error' : '' }}">
                <label for="formGroupExampleInput">Full name</label>
                {{Form::text('fullname', $employee->fullname, [
                    'class' => 'form-control'
                ]) }}
            </div>
            <div class="form-group {{ $errors->has('position') ? ' has-error' : '' }}">
                <label for="formGroupExampleInput">Position</label>
                {{Form::text('position', $employee->position, [
                    'class' => 'form-control'
                ]) }}
            </div>
            <div class="form-group {{ $errors->has('salary') ? ' has-error' : '' }}">
                <label for="formGroupExampleInput">Salary</label>
                {{Form::text('salary', $employee->salary, [
                    'class' => 'form-control'
                ]) }}
            </div>
            <div class="form-group {{ $errors->has('chief') ? ' has-error' : '' }}">
                <label for="formGroupExampleInput">Chief</label>
                {{Form::select('chief', $chief, $employee->chief, [
                    'class' => 'form-control'
                ]) }}
            </div>
            <div class="form-group {{ $errors->has('employment_date') ? ' has-error' : '' }}">
                <label for="formGroupExampleInput">Chief</label>
                {{Form::date('employment_date', date('Y-m-d', $employee->employment_date), [
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