@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-sm-12 col-sm-auto">
                <div class="card">
                    <div class="container">

                        <div class="card-header">
                            Balance
                        </div>
                        <div class="card-body">
                            <div class="form-group row">

                                <div class="col-sm-5 col-md-7 col-lg-7 col-xl-7">
                                    
                                    <div class="inner">
                                        
                                        <h3><i class="c-icon c-icon-2xl cil-cash text-dark"></i> R$ {{ $amount }}</h3> 
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-5 col-lg-5 col-xl-5">
                                    <div class="box-header">
                                        <a href="{{ route('balance.depositar') }}" class="btn btn-primary">Entrada</a>

                                        @if ($amount > 0)
                                        <a href="{{ route('balance.withdraw') }}" class="btn btn-danger">Retirada</a>
                                        @endif
                                        @if ($amount > 0)
                                        <a href="{{ route('balance.transfer') }}" class="btn btn-info disabled">Transferir</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            </div>
                   
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <div class="row">
                <div class="col-sm-12 col-sm-auto">
                    <div class="card">
                        <div class="container">
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
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>

                                @if (isset($dataForm))
                                {!! $historics->appends($dataForm)->links() !!}
                                @else
                                <a href="{{ url('historic') }}" class="btn btn-dark">Ver Histórico</a> <br> <br>
                                @endif

                            </div>
                      
                    </div>
                    <!-- /.row-->
                </div>
                <!-- /.row-->
            </div>
        </div>
        @stop