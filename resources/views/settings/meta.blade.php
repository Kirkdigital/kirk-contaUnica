@extends('dashboard.base')

@section('content')

<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12"><strong>Configuração de Metas</strong>
        <div class="card">
          <div class="card-header">
          <form action="{{ route('settings.updateMeta') }}" method="POST">
            @csrf
            <smart>Mês / Previsão do ano</smart>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-1">
                  <label for="name">Visitante</label>
                  <input class="form-control" id="visitante_mes" name="visitante_mes" type="number" value="{{ $settings->first()->visitante_mes}}">
              </div>
              <div class="col-sm-1">
                  <label for="name">Grupo</label>
                  <input class="form-control" id="grupo_ativo_mes" name="grupo_ativo_mes" type="number" value="{{ $settings->first()->grupo_ativo_mes}}">
              </div>
              <div class="col-sm-1">
                  <label for="name">Batismo</label>
                  <input class="form-control" id="batismo_mes" name="batismo_mes" type="number" value="{{ $settings->first()->batismo_mes}}">
              </div>
              <div class="col-sm-1">
                  <label for="name">Conversão</label>
                  <input class="form-control" id="conversao_mes" name="conversao_mes" type="number" value="{{ $settings->first()->conversao_mes}}">
              </div>
              <div class="col-sm-1">
                  <label for="name">Pessoa</label>
                  <input class="form-control" id="pessoa_mes" name="pessoa_mes" type="number" value="{{ $settings->first()->pessoa_mes}}">
              </div>
              <div class="col-sm-2">
                  <label for="name">Visualizações</label>
                  <input class="form-control" id="visualizacao_mes" name="visualizacao_mes" type="number" value="{{ $settings->first()->visualizacao_mes}}">
              </div>
              <div class="col-sm-2">
                  <label for="name">Publicações</label>
                  <input class="form-control" id="publicacao_mes" name="publicacao_mes" type="number" value="{{ $settings->first()->publicacao_mes}}">
              </div>
              <div class="col-sm-2">
                  <label for="name">Comentários</label>
                  <input class="form-control" id="comentario_mes" name="comentario_mes" type="number" value="{{ $settings->first()->comentario_mes}}">
              </div>
            </div>
            <!-- /.row-->

            <div class="row">
              <div class="col-sm-1">
                  <label for="name">Visitante/Ano</label>
                  <input class="form-control" id="visitante_ano" name="visitante_ano" type="number" value="{{$settings->first()->visitante_ano}}">
              </div>
              <div class="col-sm-1">
                  <label for="name">Grupos/Ano</label>
                  <input class="form-control" id="grupo_ativo_ano" name="grupo_ativo_ano" type="number" value="{{$settings->first()->grupo_ativo_ano}}">
              </div>
              <div class="col-sm-1">
                  <label for="name">Batismo/Ano</label>
                  <input class="form-control" id="batismo_ano" name="batismo_ano" type="number" value="{{$settings->first()->batismo_ano}}">
              </div>
              <div class="col-sm-1">
                  <label for="name">Conversão/Ano</label>
                  <input class="form-control" id="conversao_ano" name="conversao_ano" type="number" value="{{$settings->first()->conversao_ano}}">
              </div>
              <div class="col-sm-1">
                  <label for="name">Pessoa/Ano</label>
                  <input class="form-control" id="pessoa_ano" name="pessoa_ano" type="number" value="{{$settings->first()->pessoa_ano}}">
              </div>
              <div class="col-sm-2">
                  <label for="name">Visualizações/Ano</label>
                  <input class="form-control" id="visualizacao_ano" name="visualizacao_ano" type="number" value="{{$settings->first()->visualizacao_ano}}">
              </div>
              <div class="col-sm-2">
                  <label for="name">Publicações/Ano</label>
                  <input class="form-control" id="publicacao_ano" name="publicacao_ano" type="number" value="{{$settings->first()->publicacao_ano}}">
              </div>
              <div class="col-sm-2">
                  <label for="name">Comentários/Ano</label>
                  <input class="form-control" id="comentario_ano" name="comentario_ano" type="number" value="{{$settings->first()->comentario_ano}}">
              </div>
            </div>
            <!-- /.row-->
          </div>
          <!-- /.row-->
        </div>

        <div class="card">
          <div class="card-header">
            <smart>Financeiro</smart>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                  <label for="name">Dizimo Mês</label>
                  <input class="form-control" id="fin_dizimo_mes" name="fin_dizimo_mes" type="float" value=" {{ $settings->first()->fin_dizimo_mes}}">
              </div>
              <div class="col-sm-3">
                  <label for="name">Oferta Mês</label>
                  <input class="form-control" id="fin_oferta_mes" name="fin_oferta_mes" type="float" value="{{ $settings->first()->fin_oferta_mes}}">
              </div>
              <div class="col-sm-3">
                  <label for="name">Despesa Mês</label>
                  <input class="form-control" id="fin_despesa_mes" name="fin_despesa_mes" type="float" value="{{ $settings->first()->fin_despesa_mes}}">
              </div>
              <div class="col-sm-3">
                  <label for="name">Ações Mês</label>
                  <input class="form-control" id="fin_acao_mes" name="fin_acao_mes" type="float" value="{{ $settings->first()->fin_acao_mes}}">
              </div>
              <div class="col-sm-3">
                  <label for="name">Dizimo Ano</label>
                  <input class="form-control" id="fin_dizimo_ano" name="fin_dizimo_ano" type="float" value="{{ $settings->first()->fin_dizimo_ano}}">
              </div>
              <div class="col-sm-3">
                  <label for="name">Oferta Ano</label>
                  <input class="form-control" id="fin_oferta_ano" name="fin_oferta_ano" type="float" value="{{ $settings->first()->fin_oferta_ano}}">
              </div>
              <div class="col-sm-3">
                  <label for="name">Despesa Ano</label>
                  <input class="form-control" id="fin_despesa_ano" name="fin_despesa_ano" type="float" value="{{ $settings->first()->fin_despesa_ano}}">
              </div>
              <div class="col-sm-3">
                  <label for="name">Acções Ano</label>
                  <input class="form-control" id="fin_acao_ano" name="fin_acao_ano" type="float" value="{{ $settings->first()->fin_acao_ano}}">
              </div>
            </div>
            <!-- /.row-->
          </div>
          <!-- /.row-->
        </div>

      </div>
    </div>
    <!-- /.col-->
    <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
<!-- /.row-->
</div>
</div>


@endsection

@section('javascript')

@endsection