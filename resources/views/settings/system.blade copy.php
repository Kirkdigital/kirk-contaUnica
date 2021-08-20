@extends('dashboard.base')

@section('content')

<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Configurações do Dashboard</div>
          <div class="card-body">
        
          <form action="{{ route('settings.updateSystem') }}" method="POST">
            @csrf
            <div class="form-group row">
              <div class="col-md-2">
                <p class="text-muted">Periodo Financeiro Anual</p>
                <label class="c-switch c-switch-3d c-switch-primary">
                  <input class="c-switch-input" name="view_periodo" type="checkbox" {{ $settings->view_periodo == true ? 'checked' : '' }}><span class="c-switch-slider"></span>
                </label>
              </div>
              <div class="col-md-2">
                <p class="text-muted">Resumo + Atalho</p>
                <label class="c-switch c-switch-3d c-switch-primary">
                  <input class="c-switch-input" name="view_dash" type="checkbox" {{ $settings->view_dash == true ? 'checked' : '' }}><span class="c-switch-slider"></span>
                </label>
              </div>
              <div class="col-md-3">
                <p class="text-muted">Detalhes gerais do cadastros</p>
                <label class="c-switch c-switch-3d c-switch-primary">
                  <input class="c-switch-input" name="view_detail"  type="checkbox" {{ $settings->view_detail == true ? 'checked' : '' }}><span class="c-switch-slider"></span>
                </label>
              </div>
              <div class="col-md-3">
                <p class="text-muted">Movimento Financeiro Mensal</p>
                <label class="c-switch c-switch-3d c-switch-primary">
                  <input class="c-switch-input" name="view_resumo_financeiro"  type="checkbox" {{ $settings->view_resumo_financeiro == true ? 'checked' : '' }}><span class="c-switch-slider"></span>
                </label>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- /.col-->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">People</div>
          <div class="card-body">
            <div class="form-group row">
            
            <div class="col-md-2">
                <p class="text-muted">Adicionar</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-primary">
                  <input class="c-switch-input"  name="add_people"  type="checkbox" {{ $settings->add_people == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
              <div class="col-md-2">
                <p class="text-muted">Editar</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-info">
                  <input class="c-switch-input"  name="edit_people"  type="checkbox"  {{ $settings->edit_people == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
              <div class="col-md-2">
                <p class="text-muted">Excluir</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-danger">
                  <input class="c-switch-input"  name="delete_people"  type="checkbox"  {{ $settings->delete_people == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Institution</div>
          <div class="card-body">
            <div class="form-group row">
            <div class="col-md-2">
                <p class="text-muted">Adicionar</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-primary">
                  <input class="c-switch-input"  name="add_institution" type="checkbox"  {{ $settings->add_institution == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
              <div class="col-md-2">
                <p class="text-muted">Editar</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-info">
                  <input class="c-switch-input"  name="edit_institution" type="checkbox"  {{ $settings->edit_institution == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
              <div class="col-md-2">
                <p class="text-muted">Excluir</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-danger">
                  <input class="c-switch-input"  name="delete_institution" type="checkbox"  {{ $settings->delete_institution == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
            <!-- /.col-->
        <div class="col-md-6">
        <div class="card">
          <div class="card-header">Group</div>
          <div class="card-body">
            <div class="form-group row">
            <div class="col-md-2">
                <p class="text-muted">Adicionar</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-primary">
                  <input class="c-switch-input" name="add_group" type="checkbox"  {{ $settings->add_group == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
              <div class="col-md-2">
                <p class="text-muted">Excluir</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-danger">
                  <input class="c-switch-input" name="delete_group" type="checkbox"  {{ $settings->delete_group == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
            <!-- /.col-->
        <div class="col-md-6">
        <div class="card">
          <div class="card-header">Outros</div>
          <div class="card-body">
            <div class="form-group row">
            <div class="col-md-4">
                <p class="text-muted">Excluir Agendamentos</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-danger">
                  <input class="c-switch-input" name="delete_calendar" type="checkbox"  {{ $settings->delete_calendar == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
              <div class="col-md-3">
                <p class="text-muted">Excluir Financeiro</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-danger">
                  <input class="c-switch-input" name="delete_financial" type="checkbox"  {{ $settings->delete_financial == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
              <div class="col-md-3">
                <p class="text-muted">Excluir Notes</p>
                <label class="c-switch c-switch-label c-switch-pill c-switch-danger">
                  <input class="c-switch-input" name="delete_note" type="checkbox"  {{ $settings->delete_note == true ? 'checked' : '' }} ><span class="c-switch-slider" data-checked="&#x2713" data-unchecked="&#x2715"></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- /.col-->
    </div>
    <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
    <!-- /.row-->
  </div>
</div>

@endsection

@section('javascript')

@endsection