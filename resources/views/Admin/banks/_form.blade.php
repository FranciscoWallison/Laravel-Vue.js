@include('errors._error_field')
@php
	$errorsClass = $errors->first('name') ? ['class' => 'validate invalid'] : []; 
@endphp
<div class="row">
	<div class="input-field col s12">
		{!! Form::text('name', null, $errorsClass) !!}
		{!! Form::label('name', 'Nome' , ['data-error' => $errors->first('name') ]) !!}
	</div>
</div>