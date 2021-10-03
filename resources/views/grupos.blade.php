@extends('layouts.base')
@section('content')

    <div class="container-fluid">
            @if ($appPermissao->home_grupo == true)
                @if (!$groups->isEmpty())
                    <div class="card">
                        <div class="card-header">
                            <h6><strong>Meus grupos</strong></h6>
                        </div>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Pessoas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($groups as $group)
                                    <tr>
                                        <td><strong>{{ $group->grupo->name_group }}</strong></td>
                                        <td>{{ $group->grupo->type }}</td>
                                        <td>{{ $group->grupo->count }}</td>
                                    </tr>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif
            <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
        </div>
    @endsection

    @section('javascript')


    @endsection
