@extends('layouts.site')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card-panel center">
                <span class="blue-grey-text text-darken-2">
                    <h2>Crie a sua equipe para o SisFin</h2>                    
                </span>
            </div>
            {!! Form::open(['route'=>'site.my_financial.invite_creat']) !!}
            <div class="row card-panel">
                <h5 class="blue-grey-text center">Informações do Condado</h5>
                <div class="row">
                    <?php $errorClass = $errors->first('email') ? ['class'=>'validate invalid'] : []; ?>
                    <div class="input-field col s12">
                        {!! Form::email('email', null, $errorClass) !!}
                        {!! Form::label('email','E-mail',['data-error' => $errors->first('email')]) !!}
                    </div>
                </div>
            </div>
            <div class="row center">
                {!! Form::submit('Convidar',['class'=>'btn waves-effect']) !!}
            </div>
            {!! Form::close() !!}         
        </div>
    </div>
@endsection