@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        {!! Form::open(['route' => 'admin.banks.store' ] ) !!}
			<div class="row">
				<div class="input-field col s6">
					{!! Form::label('name', 'Nome') !!}
					{!! Form::text('name', null) !!}
				</div>
			</div>

			<div class="row">
				{!! Form::submit('Criar banco', ['class' => 'btn waves-effect']) !!}
			</div>
        {!! Form::close() !!}
    </div>
</div>
@endsection