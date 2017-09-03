@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h4>Lista de Bancos</h4>
        <a href="{{ route('admin.banks.create') }}" class="btn waves-effect">Inserir Banco</a>
        <table class="bordered striped highlight centered responsive-table z-depth-5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Acções</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banks as $bank)
	                <tr>
	                    <td>
	                        <div class="row valign-wrapper">
	                            <div class="col s12"> {{$bank->id}} </div>
	                        </div>
	                    </td>
	                    <td>
	                        <div class="row valign-wrapper">
	                            {{-- <div class="col s2">
	                                <img src="{{asset("storage/banks/images/{$bank->logo}")}}" class="bank-logo"/>
	                            </div> --}}
	                            <div class="col s10">
	                                <span class="left">{{$bank->name}}</span>
	                            </div>

	                        </div>
	                    </td>
	                    <td>
	                        <div class="row valign-wrapper">
	                            <div class="col s12">
	                                <a href="{{route('admin.banks.edit', ['bank' => $bank->id])}}">Editar</a> |
	                                <delete-action action="{{route('admin.banks.destroy', ['bank' => $bank->id])}}"
	                                               action-element="link-delete-{{$bank->id}}" csrf-token="{{csrf_token()}}">
	                                                @php 
	                                                   	$modalId = "modal-delete-$bank->id"; 
	                                                @endphp
	                                    <a id="link-modal-{{$bank->id}}" href="#{{ $modalId }}">Excluir</a>
	                                    <modal :modal="{{json_encode(['id' => $modalId ])}}" style="display:none;" >
	                                        <div slot="content">
	                                            <h4>ATENÇÃO</h4>
	                                            <p><strong>Tem a certeza que pretende excluir este banco?</strong></p>
	                                            <div class="divider"></div>
	                                            <p>Nome: <strong>{{$bank->name}}</strong></p>
	                                            <div class="divider"></div>
	                                        </div>
	                                        <div slot="footer">
	                                            <button class="btn btn-flat waves-effect green lighten-2 modal-close modal-action"
	                                                    id="link-delete-{{$bank->id}}">OK</button>
	                                            <button class="btn btn-flat waves-effect waves-red lighten-2 modal-close modal-action">Cancelar</button>
	                                        </div>
	                                    </modal>
	                                </delete-action>
	                            </div>
	                        </div>
	                    </td>
	                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $banks->links() !!}
    </div>
</div>
@endsection