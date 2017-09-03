@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 responsive-table z-depth-5">
            <div class="container">
                <h4 class="center">Editar Banco</h4>
                {!! Form::model($bank, [
                							'route' => ['admin.banks.update', 'bank' => $bank->id],
                							'method'=> 'PUT',
                                            'files' => true
                						]) 
                !!}
        			<div class="row">
                        <div class="input-field">
        			         @include('admin.banks._form')
                        </div>
                    </div>

        			<div class="row">
        				{!! Form::submit('Salvar banco', ['class' => 'waves-effect waves-light btn']) !!}
        			</div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection