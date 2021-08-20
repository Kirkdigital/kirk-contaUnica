@extends('dashboard.base')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="container">
                            <div class="card-header"><h5>Grupos</h5></div>
                            <form action="{{ route('group.search') }}" method="POST" class="form form-inline">
                                {!! csrf_field() !!}
                                <div class="card-body">
                                    <div class="form-group row">

                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-8">
                                            @if ($config->add_group == true)
                                                <div class="row">
                                                    <a href="{{ route('group.create') }}"
                                                        class="btn btn-primary m-2">{{ __('Add Group') }}</a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                            <div class="inner">
                                                <input type="text" id='name' name="name" class="form-control"
                                                    placeholder="Nome">
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-md-2 col-lg-2 col-xl-2">
                                            <div class="box-header">
                                                <button type="submit" class="btn btn-primary">Pesquisar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="box-body">
                                <table class="table table-responsive-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Responsável</th>
                                            <th>Type</th>
                                            <th>Pessoas</th>
                                            <th>Status</th>
                                            <th colspan="3">
                                                <Center>{{ __('account.action') }}</Center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($groups as $group)
                                            <tr>
                                                <td><strong>{{ $group->id }}</strong></td>
                                                <td>{{ $group->name_group }}</td>
                                                <td>
                                                    @if ($group->user_id)
                                                        {{ $group->responsavel->name }}
                                                    @else
                                                        - - -
                                                    @endif
                                                </td>
                                                <td>{{ $group->type }}</td>
                                                <td>{{ $group->count }}

                                                </td>
                                                <td>
                                                    <span class="{{ $group->status->class }}">
                                                        {{ $group->status->name }}
                                                    </span>
                                                </td>
                                                <td width="1%">
                                                    <a href="{{ route('group.show', $group->id ) }}"
                                                        class="btn btn-primary-outline"><i
                                                            class="c-icon c-icon-sm cil-notes text-primary"></i></a>
                                                </td>
                                                @if ($config->edit_group == true)
                                                    <td width="1%">
                                                        <a href="{{ route('group.edit', $group->id ) }}"
                                                            class="btn btn-primary-outline"><i
                                                                class="c-icon c-icon-sm cil-pencil text-success"></i></a>
                                                    </td>
                                                @endif
                                                @if ($config->delete_group == true)
                                                    <td width="1%">
                                                        <form action="{{ route('group.destroy', $group->id ) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-primary-outline show_confirm"
                                                                data-toggle="tooltip" title='Delete'><i
                                                                    class="c-icon c-icon-sm cil-trash text-danger"></i></button>
                                                        </form>
                                                @endif
                                            </tr>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>

                                @if (isset($dataForm))
                                    {!! $groups->appends($dataForm)->links() !!}
                                @else
                                    {!! $groups->links() !!}

                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.row-->
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#name").on("input", function() {
            $(this).val($(this).val().toUpperCase());
        });
    </script>
@endsection

@section('javascript')

@endsection
