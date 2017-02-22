<ul>
    @foreach($childs as $child)
        <li>
            {{ $child->fullname }} ({{ $child->position }})
            @if(count($child->childs))
                @include('employee.manageChild',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>