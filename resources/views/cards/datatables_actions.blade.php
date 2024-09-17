{!! Form::open(['route' => ['cards.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('cards.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    {{--  @if (Route::currentRouteName() == 'cards.index')
        @role('admin|super admin | admin')  --}}
            <a href="{{ route('cards.edit', $id) }}" class='btn btn-default btn-xs'>
                <i class="fa fa-edit"></i>
            </a>
        {{--  @endrole
    @else  --}}
        {{--  <a href="{{ route('cards.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>  --}}
    {{--  @endif  --}}
    @role('admin|super admin | admin')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')",
        ]) !!}
    @endrole
</div>
{!! Form::close() !!}
