@extends('layouts.site')

@section('content')
  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">SisFin</h1>
        <div class="row center">
          <h5 class="header col s12 light">Controle a sua empresa em poucos cliks</h5>
        </div>
        <div class="row center">
          <a href="{{route('site.auth.register.create')}}" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Cadastre-se</a>
        </div>
        <br><br>

      </div>
    </div>

    <div class="parallax parallax-sisfin">
      <img src="{{asset("storage/site/imagens/businessman-2606502_1920.jpg")}}" alt="Unsplashed background img 1">
    </div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m3">
          <div class="icon-block">
          </div>
        </div>

        <div class="col s12 m6">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">attach_money</i></h2>
            <h5 class="center">Plano Empresarial</h5>

           <div class=" main-content white center-align">                         
                <ul class="collection" id="plan-business"> 
                    <li class="collection-item">Contas a pagar</li> 
                    <li class="collection-item">Contas a receber</li> 
                    <li class="collection-item">Contas bancárias</li> 
                    <li class="collection-item">Extrato</li> 
                    <li class="collection-item">Fluxo de Caixa Anual</li> 
                    <li class="collection-item">Gráfico Fluxo de Caixa Mensal</li> 
                    <li class="collection-item">Notificação do saldo em tempo real</li> 
                </ul>
                <div class="card-action white center-align"> 
                        <a href="{{route('site.subscriptions.create')}}" class="btn btn-large waves-effect waves-light blue-grey darken-2"> 
                            Contratar 
                        </a> 
                    </div> 
            </div> 
          </div>
        </div>

        <div class="col s12 m2">
          <div class="icon-block">
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
