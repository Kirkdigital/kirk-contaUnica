@if ($appPermissao->settings_roles == true)
    @extends('layouts.base')
    @section('content')
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit role</h4>
                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $role->id }}" />
                                    <table class="table datatable">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <td>
                                                    <input class="form-control" name="name" value="{{ $role->name }}"
                                                        type="text" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-lg-12">
                                        <div class="card-header"><strong>Permissões gerais</strong></div>
                                        <table class="table table-responsive-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Módulo</th>
                                                    <th colspan="2">
                                                        <Center>Criar</Center>
                                                    </th>
                                                    <th>Ler</th>
                                                    <th>Editar</th>
                                                    <th>Excluir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Pessoa</td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="add_people" type="checkbox"
                                                                {{ $role->add_people == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="view_people" type="checkbox"
                                                                {{ $role->view_people == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="edit_people" type="checkbox"
                                                                {{ $role->edit_people == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="delete_people"
                                                                type="checkbox"
                                                                {{ $role->delete_people == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <td>Pré-cadastro</td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td> <label
                                                        class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                        <input class="c-switch-input" name="view_precadastro"
                                                            type="checkbox"
                                                            {{ $role->view_precadastro == true ? 'checked' : '' }}><span
                                                            class="c-switch-slider" data-checked="&#x2713"
                                                            data-unchecked="&#x2715"></span>
                                                    </label>
                                                </td>
                                                <td> <label
                                                        class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                        <input class="c-switch-input" name="edit_precadastro"
                                                            type="checkbox"
                                                            {{ $role->edit_precadastro == true ? 'checked' : '' }}><span
                                                            class="c-switch-slider" data-checked="&#x2713"
                                                            data-unchecked="&#x2715"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>Grupo</td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="add_group" type="checkbox"
                                                                {{ $role->add_group == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="view_group" type="checkbox"
                                                                {{ $role->view_group == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="edit_group" type="checkbox"
                                                                {{ $role->edit_group == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="delete_group"
                                                                type="checkbox"
                                                                {{ $role->delete_group == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <td>Pessoas nos grupos</td>
                                                <td>
                                                    <label
                                                        class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                        <input class="c-switch-input" name="delete_group_people"
                                                            type="checkbox"
                                                            {{ $role->delete_group_people == true ? 'checked' : '' }}><span
                                                            class="c-switch-slider" data-checked="&#x2713"
                                                            data-unchecked="&#x2715"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <label
                                                        class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                        <input class="c-switch-input" name="delete_group_people"
                                                            type="checkbox"
                                                            {{ $role->delete_group_people == true ? 'checked' : '' }}><span
                                                            class="c-switch-slider" data-checked="&#x2713"
                                                            data-unchecked="&#x2715"></span>
                                                    </label>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>Recado</td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="add_message" type="checkbox"
                                                                {{ $role->add_message == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="view_message"
                                                                type="checkbox"
                                                                {{ $role->view_message == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="edit_message"
                                                                type="checkbox"
                                                                {{ $role->edit_message == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="delete_message"
                                                                type="checkbox"
                                                                {{ $role->delete_message == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Calendário</td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="add_calendar"
                                                                type="checkbox"
                                                                {{ $role->add_calendar == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="view_calendar"
                                                                type="checkbox"
                                                                {{ $role->view_calendar == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="edit_calendar"
                                                                type="checkbox"
                                                                {{ $role->edit_calendar == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="delete_calendar"
                                                                type="checkbox"
                                                                {{ $role->delete_calendar == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Financeiro</td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="add_entrada_financial"
                                                                type="checkbox"
                                                                {{ $role->add_entrada_financial == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                            Entrada
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="add_retirada_financial"
                                                                type="checkbox"
                                                                {{ $role->add_retirada_financial == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                            Retira
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="view_financial"
                                                                type="checkbox"
                                                                {{ $role->view_financial == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <!--
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="edit_financial" type="checkbox"
                                                                {{ $role->edit_financial == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                        -->
                                                    </td>

                                                    <td>
                                                        <!--
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="delete_financial"
                                                                type="checkbox"
                                                                {{ $role->delete_financial == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                        -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-header"><strong> Permissões do Dashboard </strong>
                                        </div>
                                        <table class="table table-responsive-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Atalhos rápido</th>
                                                    <th>Periodo Anual</th>
                                                    <th>Detalhes das Pessoas</th>
                                                    <th>Resumo financeiro</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Mostrar</td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="view_dash" type="checkbox"
                                                                {{ $role->view_dash == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="view_periodo"
                                                                type="checkbox"
                                                                {{ $role->view_periodo == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="view_detail" type="checkbox"
                                                                {{ $role->view_detail == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="view_resumo_financeiro"
                                                                type="checkbox"
                                                                {{ $role->view_resumo_financeiro == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-header"><strong>Permissões da Home</strong></div>
                                        <table class="table table-responsive-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Recados</th>
                                                    <th>Grupos</th>
                                                    <th>Finaceiro Mensal</th>
                                                    <th>Redes Sociais</th>
                                                    <th>Ofertas</th>
                                                    <th>Localização</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Mostrar</td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="home_message"
                                                                type="checkbox"
                                                                {{ $role->home_message == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="home_grupo" type="checkbox"
                                                                {{ $role->home_grupo == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="home_financeiro"
                                                                type="checkbox"
                                                                {{ $role->home_financeiro == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="home_social"
                                                                type="checkbox"
                                                                {{ $role->home_social == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="home_financeiro_valores"
                                                                type="checkbox"
                                                                {{ $role->home_financeiro_valores == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="home_location"
                                                                type="checkbox"
                                                                {{ $role->home_location == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-header"><strong>Permissões das Configurações </strong>
                                        </div>
                                        <table class="table table-responsive-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>General</th>
                                                    <th>Email</th>
                                                    <th>Meta</th>
                                                    <th>SEO</th>
                                                    <th>Roles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Configurar</td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="settings_general"
                                                                type="checkbox"
                                                                {{ $role->settings_general == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="settings_email"
                                                                type="checkbox"
                                                                {{ $role->settings_email == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="settings_meta"
                                                                type="checkbox"
                                                                {{ $role->settings_meta == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="settings_social"
                                                                type="checkbox"
                                                                {{ $role->settings_social == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="settings_roles"
                                                                type="checkbox"
                                                                {{ $role->settings_roles == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-header"><strong>Complemento</strong>
                                        </div>
                                        <table class="table table-responsive-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Relatórios</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Mostrar</td>
                                                    <td>
                                                        <label
                                                            class="c-switch c-switch-label c-switch-pill c-switch-primary c-switch-sm">
                                                            <input class="c-switch-input" name="report_view"
                                                                type="checkbox"
                                                                {{ $role->report_view == true ? 'checked' : '' }}><span
                                                                class="c-switch-slider" data-checked="&#x2713"
                                                                data-unchecked="&#x2715"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <a class="btn btn-dark" href="{{ route('roles.index') }}">Return</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    @endsection

    @section('javascript')

    @endsection
@else
    @include('errors.redirecionar')
@endif
