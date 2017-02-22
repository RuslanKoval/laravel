@extends('layouts.app')
{{-- Web site Title --}}
@section('title')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Employers List</h3>
            <ul id="tree">
                @foreach($employees as $employee)
                    <li>
                        {{ $employee->fullname }} ({{ $employee->position }})
                        @if(count($employee->childs))
                            @include('employee.manageChild',['childs' => $employee->childs])
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection





