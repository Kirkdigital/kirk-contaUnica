@extends('dashboard.base')
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="container">

                        <div class="card-header">

                        <form action="{{ route('historic.search') }}" method="POST" class="form form-inline">
                                {!! csrf_field() !!}
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-2">
                                    <div class="inner">
                                        <input type="number" name="id" class="form-control" placeholder="Recibo">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-2">
                                    <div class="inner">
                                        <input type="date" name="datefrom" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-2">
                                    <div class="inner">
                                        <input type="date" name="dateto" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-2">
                                    <div class="inner">
                                        <select name="type" class="form-control">
                                            <option value="">Movimento</option>
                                            @foreach ($types as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="inner">
                                        <select class="form-control" id="tipo" name="tipo">
                                            <option value="">Tipo</option>
                                            @foreach($statusfinan as $statusfinan)
                                                <option value="{{ $statusfinan->id }}">{{ $statusfinan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="inner">
                                        <select class="form-control" id="pag" name="pag">
                                            <option value="">Pagamento</option>
                                            @foreach($statuspag as $statuspags)
                                            <option value="{{ $statuspags->id }}">{{ $statuspags->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-sm-8 col-md-4 col-lg-4 col-xl-4">
                                    <div class="box-header">
                                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                                        <a href="{{ url('financial') }}" class="btn btn-dark">Voltar</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </form>
                        </div>
                        <div class="box-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 35px">Recibo</th>
                                        <th style="width: 120px">Movimentação</th>
                                        <th>Valor</th>
                                        <th>Tipo</th>
                                        <th>Forma de Pagamento</th>
                                        <th>Remetente</th>
                                        <th>Observação</th>
                                        <th style="width: 80px">Data</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($historics as $historic)
                                    <tr>
                                        <td>{{ $historic->id }}</td>
                                        <td>{{ $historic->type($historic->type) }}</td>
                                        <td>R$ {{ number_format($historic->amount),2, '.',','}}</td>
                                        <td>
                                            @if ( $historic->tipo )
                                            <span class="{{ $historic->status->class }}">
                                                {{ $historic->status->name }}
                                            </span>
                                            @else
                                            - - -
                                            @endif
                                        </td>
                                        <td>
                                            @if ( $historic->pag )
                                            <span class="{{ $historic->statuspag->class }}">
                                                {{ $historic->statuspag->name }}
                                            </span>
                                            @else
                                            - - -
                                            @endif
                                        </td>
                                        <td>
                                            @if ( $historic->user_id_transaction )
                                            {{ $historic->userSender->name }}
                                            @else
                                            - - -
                                            @endif
                                        </td>
                                        <td>
                                            @if ( $historic->observacao )
                                            {{ $historic->observacao }}
                                            @else
                                            - - -
                                            @endif
                                        </td>
                                        <td>{{ $historic->date }}</td>
                                        <td width="1%">
                                            <a href="{{ url('/financial/' . $historic->id . '/edit') }}" class="btn btn-primary-outline"><i class="c-icon c-icon-sm cil-notes text-primary"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>

                            @if (isset($dataForm))
                            {!! $historics->appends($dataForm)->links() !!}
                            @else
                            {!! $historics->links() !!}
                            
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.row-->
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection