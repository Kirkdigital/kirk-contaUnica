@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i><strong>Pessoas nesse grupo</strong></div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Pessoa</th>
                                        <th>Celular</th>
                                        <th>Date registered</th>
                                        <th colspan="3">
                                            <center>Ação</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pessoasgrupos as $pessoasgrupo)
                                        <tr>
                                            <td>{{ $pessoasgrupo->usuario->name }} 
                                                @if ($pessoasgrupo->usuario->id == $responsavel->id)   
                                                    <span class="badge badge-info">Responsável</span>
                                                @endif
                                            </td>
                                            <td>{{ $pessoasgrupo->usuario->mobile }}</td>
                                            <td>{{ $pessoasgrupo->registered }}</td>
                                            <td width="1%">
                                                <a href="{{ route('people.edit', $pessoasgrupo->usuario->id) }}"><i
                                                        class="c-icon c-icon-sm cil-notes text-primary"></i></a>
                                                        @if ($pessoasgrupo->usuario->id == $responsavel->id)
                                                        <td></td>
                                                        @else
                                            <td width="1%">
                                                <form action="{{ url('/group/' . $pessoasgrupo->id . '/delete') }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a class="show_confirm"
                                                        data-toggle="tooltip" title='Delete'><i
                                                            class="c-icon c-icon-sm cil-trash text-danger"></i></a>
                                                </form>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.row-->
                </div>
                {{ session(['group' => $group->id]) }}
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header"><strong>Buscar Pessoa</strong></div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('group.storepeoplegroup') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <select class="itemName form-control" id="itemName" name="itemName"
                                            required></select>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary" type="submit">Adicionar</button>
                            <a href="{{ route('group.index') }}"
                            class="btn btn-sm btn-dark">{{ __('Return') }}</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.itemName').select2({
            placeholder: 'Select an item',

            ajax: {
                url: '/select2-autocomplete-people',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>

@endsection

@section('javascript')

@endsection
