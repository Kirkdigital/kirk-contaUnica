@extends('layouts.baseminimal')

@section('content')
    <div class="loader loader-default is-active"></div>
    <div class="container-fluid">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    @if (!$institutions->isEmpty())
                        <h4><strong>{{ __('account.select') }}</strong></h4>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('account.name') }}</th>
                            <th>{{ __('account.type') }}</th>
                            <th colspan="3">
                                <Center>{{ __('account.action') }}</Center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($institutions as $institution)
                            <tr>
                                <td width="10%">{{ $institution->AccountList->id }}</td>
                                <td width="40%">{{ $institution->AccountList->name_company }} </td>
                                <td>
                                    <span class="{{ $institution->AccountList->status->class }}">
                                        {{ $institution->AccountList->status->name }}
                                    </span>
                                </td>
                                <td width="1%">
                                    @if (Auth::user()->isAdmin() and $you->id == $institution->AccountList->integrador)
                                        <a href="{{ route('account.edit', $institution->AccountList->id) }}"
                                            class="btn btn-primary-outline"><i
                                                class="c-icon c-icon-sm cil-pencil text-success"></i></a>
                                @endif
                                </td>
                                    <td width="1%">
                                        @if (Auth::user()->isAdmin() and $you->id == $institution->AccountList->integrador)
                                        <form action="{{ route('account.destroy', $institution->AccountList->id) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-primary-outline show_confirm" data-toggle="tooltip"
                                                title='Delete'><i
                                                    class="c-icon c-icon-sm cil-trash text-danger"></i></button>
                                        </form>
                                
                                        @endif
                                </td>
                                <td width="1%">
                                    <form method="post"
                                        action="{{ route('tenant', ['id' => $institution->AccountList->id]) }}">
                                        @method('POST')
                                        @csrf
                                        <button class="btn btn-primary-outline" data-toggle="modal"
                                            data-target=".cd-load"><i
                                                class="c-icon c-icon-sm cil-room text-dark"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $institutions->links() }}
            </div>
        </div>
    </div>
@else
    <i class="fa fa-align-justify"></i>Você não possui nenhum cadastro associado</div>
    <div class="card-body">
        Seja Bem-vindo! <br>
        Gostaria de criar um pré-cadastro a sua igreja?
        <label for="ccmonth"><a href="{{ route('wizard.index') }}" class="btn btn-dark m-2">Associar</a><br>

    </div>
    @endif

    </div>
    </div>
@endsection

@section('javascript')

@endsection
