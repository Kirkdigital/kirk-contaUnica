@if(($appPermissao->view_periodo or $appPermissao->view_dash or $appPermissao->view_detail or $appPermissao->view_resumo_financeiro) == true)
@extends('layouts.base')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            @if ($appPermissao->view_dash == true)
                <div class="row">
                    <div class="col-sm-6 col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-right mb-4">
                                    <svg class="c-icon c-icon-2xl">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-people"></use>
                                    </svg>
                                </div>
                                <div class="text-value-lg">{{ $peopleativo }} </div><small
                                    class="text-muted text-uppercase font-weight-bold">People</small>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                                    href="{{ url('people') }}">
                                    <span class="small font-weight-bold">View More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-right mb-4">
                                    <svg class="c-icon c-icon-2xl">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user-follow"></use>
                                    </svg>
                                </div>
                                <div class="text-value-lg">{{ $precadastro }}</div><small
                                    class="text-muted text-uppercase font-weight-bold"> Pré-cadastros</small>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                                    href="{{ url('peopleList') }}">
                                    <span class="small font-weight-bold">View More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-right mb-4">
                                    <svg class="c-icon c-icon-2xl">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-mood-good"></use>
                                    </svg>
                                </div>
                                <div class="text-value-lg">{{ $peoplevisitor }}</div><small
                                    class="text-muted text-uppercase font-weight-bold"> New Visitors</small>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                                    href="{{ url('notes') }}">
                                    <span class="small font-weight-bold">View More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-right mb-4">
                                    <svg class="c-icon c-icon-2xl">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-speedometer"></use>
                                    </svg>
                                </div>
                                <div class="text-value-lg">{{ number_format($porcentage_total, 2) }}%</div><small
                                    class="text-muted text-uppercase font-weight-bold">Transactions</small>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                                    href="{{ url('financial') }}">
                                    <span class="small font-weight-bold">View More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-right mb-4">
                                    <svg class="c-icon c-icon-2xl">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-calendar"></use>
                                    </svg>
                                </div>
                                <div class="text-value-lg">{{ $eventos }}</div><small
                                    class="text-muted text-uppercase font-weight-bold">Calendar</small>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                                    href="{{ url('calendar') }}">
                                    <span class="small font-weight-bold">View More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-right mb-4">
                                    <svg class="c-icon c-icon-2xl">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-speech"></use>
                                    </svg>
                                </div>
                                <div class="text-value-lg">{{ $notes }}</div><small
                                    class="text-muted text-uppercase font-weight-bold">Message</small>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                                    href="{{ url('notes') }}">
                                    <span class="small font-weight-bold">View More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
            @endif
            @if ($appPermissao->view_periodo == true)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <h4 class="card-title mb-0">Perido</h4>
                                <div class="small text-muted">Anual</div>
                            </div>
                            <!--
                            <div class="col-sm-7 d-none d-md-block">
                                <button class="btn btn-primary float-right" type="button">
                                    <svg class="c-icon">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-cloud-download"></use>
                                    </svg>
                                </button>
                                <div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
                                </div>
                            </div>
                             /.col-->
                        </div>
                        <!-- /.row-->
                        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                            <canvas class="chart" id="chats-periodo-ano" height="300"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center">
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Dizimos</div><strong>R$
                                    {{ number_format($anodizimo, 2) }}</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $porcentage_dizimo }}%" aria-valuenow="40" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Ofertas</div><strong>R$
                                    {{ number_format($anooferta, 2) }}</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: {{ $porcentage_oferta }}%" aria-valuenow="20" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Doações</div><strong>R$
                                    {{ number_format($anodoacao, 2) }}</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $porcentage_doacao }}%" aria-valuenow="60" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Despesas</div><strong>R$
                                    {{ number_format($anodespesa, 2) }}</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $porcentage_despesa }}%" aria-valuenow="80" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Total</div><strong>R$
                                    {{ number_format($totalfinanceiro, 2) }}</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $porcentage_total }}%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-->
            @endif
            @if ($appPermissao->view_detail == true)
                <!-- /.row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h4 class="card-title mb-0">Informações gerais</h4>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!--
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="c-callout c-callout-info"><small class="text-muted">Total de
                                                        Visitantes</small>
                                                    <div class="text-value-lg">{{ $totalvisitante }}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="c-callout c-callout-danger"><small class="text-muted">Total de
                                                        Conversões</small>
                                                    <div class="text-value-lg"> {{ $totalconversao }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="mt-0">
                                        /.row-->

                                        Meta Anual

                                        <div class="progress-group">
                                            <div class="progress-group-header align-items-end">
                                                <svg class="c-icon progress-group-icon">
                                                    <use
                                                        xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-globe-alt">
                                                    </use>
                                                </svg>
                                                <div>Batismos</div>
                                                <div class="ml-auto font-weight-bold mr-2"></div>
                                                <div class="text-muted small">({{ $anobatismo }})</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: {{ $porcentage_batismo }}%" aria-valuenow="56"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group">
                                            <div class="progress-group-header align-items-end">
                                                <svg class="c-icon progress-group-icon">
                                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user">
                                                    </use>
                                                </svg>
                                                <div>Pessoas</div>
                                                <div class="ml-auto font-weight-bold mr-2"></div>
                                                <div class="text-muted small">({{ $anopessoa }})</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: {{ $porcentage_pessoa }}%" aria-valuenow="15"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group">
                                            <div class="progress-group-header align-items-end">
                                                <svg class="c-icon progress-group-icon">
                                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-door">
                                                    </use>
                                                </svg>
                                                <div>Visitações</div>
                                                <div class="ml-auto font-weight-bold mr-2"></div>
                                                <div class="text-muted small">({{ $anovisitante }})</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: {{ $porcentage_visitante }}%" aria-valuenow="11"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group">
                                            <div class="progress-group-header align-items-end">
                                                <svg class="c-icon progress-group-icon">
                                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-child">
                                                    </use>
                                                </svg>
                                                <div>Conversões</div>
                                                <div class="ml-auto font-weight-bold mr-2"></div>
                                                <div class="text-muted small">({{ $anoconversao }})</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width:  {{ $porcentage_conversao }}%" aria-valuenow="8"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group">
                                            <div class="progress-group-header align-items-end">
                                                <svg class="c-icon progress-group-icon">
                                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-people">
                                                    </use>
                                                </svg>
                                                <div>Pessoas associadas aos Grupos</div>
                                                <div class="ml-auto font-weight-bold mr-2"></div>
                                                <div class="text-muted small">({{ $anogrupo }})</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: {{ $porcentage_grupo }}%" aria-valuenow="8"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <div class="card-body">
                                                    <div class="c-chart-wrapper">
                                                        <canvas id="chats-tipo-pessoa"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <!--
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="c-callout c-callout-warning"><small class="text-muted">Total de
                                                        Batismos</small>
                                                    <div class="text-value-lg">{{ $totalbatismo }}</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                <div class="c-callout c-callout-success"><small class="text-muted">Total de
                                                        Likes</small>
                                                    <div class="text-value-lg"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="mt-0">
                                                                                 /.row-->

                                        <div class="progress-group">
                                            <div class="progress-group-header">
                                                <svg class="c-icon progress-group-icon">
                                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user">
                                                    </use>
                                                </svg>
                                                <div>Masculino</div>
                                                <div class="ml-auto font-weight-bold">{{ $sexmascu }}%</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: {{ $porcentage_m }}%" aria-valuenow="43"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group mb-5">
                                            <div class="progress-group-header">
                                                <svg class="c-icon progress-group-icon">
                                                    <use
                                                        xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user-female">
                                                    </use>
                                                </svg>
                                                <div>Feminino</div>
                                                <div class="ml-auto font-weight-bold">{{ $sexfemin }}%</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-secondary" role="progressbar"
                                                        style="width: {{ $porcentage_m }}%" aria-valuenow="43"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: {{ $porcentage_f }}%" aria-valuenow="43"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.col-->
                                </div>

                            </div>
                        </div>
            @endif
            @if ($appPermissao->view_resumo_financeiro == true)
                <div class="card">
                    <div class="card-body">

                        <div class="col-sm-5">
                            <h4 class="card-title mb-0">Financeiro</h4>
                            <div class="small text-muted">Movimento mensal</div>
                        </div>
                        <br>
                        <div class="row">
                            <!-- /.col-->
                            <div class="col-sm-8 col-md-6 col-lg-6 col-xl-6">
                                Tipo de movimento
                                <div class="row">
                                    <!-- /.col-->
                                    <div class="card-body">
                                        <div class="c-chart-wrapper">
                                            <canvas id="chats-tipo-movimento"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row-->
                            </div>
                            <!-- /.col-->
                            <div class="col-sm-8 col-md-6 col-lg-6 col-xl-6">
                                Formas de pagamento
                                <div class="row">
                                    <!-- /.col-->
                                    <div class="card-body">
                                        <div class="c-chart-wrapper">
                                            <canvas id="chats-form-pagamento"></canvas>
                                        </div>
                                    </div>
                                </div>
            @endif
            <!-- /.row-->
        </div>
        <!-- /.col-->

    </div>

@endsection
@section('javascript')
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script type="text/javascript">
        var pieChart = new Chart(document.getElementById('chats-tipo-pessoa'), {
            type: 'polarArea',
            data: {
                labels: ['Visitante', 'Batismo', 'Conversão', 'Novas Pessoas'],
                datasets: [{
                    data: [{{ $anovisitante }}, {{ $anobatismo }}, {{ $anoconversao }},
                        {{ $anopessoa }}
                    ],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#2eb85c'],
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#2eb85c']
                }]
            },
            options: {
                responsive: true
            }
        })
    </script>

    <script type="text/javascript">
        var pieChart = new Chart(document.getElementById('chats-tipo-movimento'), {
            type: 'pie',
            data: {
                labels: ['Dizimo', 'Oferta', 'Doação', 'Despesa'],
                datasets: [{
                    data: [{{ $dizimoatual }}, {{ $ofertaatual }}, {{ $doacaoatual }},
                        {{ $despesaatual }}
                    ],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#2eb85c'],
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#2eb85c']
                }]
            },
            options: {
                responsive: true
            }
        })
    </script>

    <script type="text/javascript">
        var pieChart = new Chart(document.getElementById('chats-form-pagamento'), {
            type: 'doughnut',
            data: {
                labels: ['Dinheiro', 'Cheque', 'Crédito', 'Débito', 'Boleto', 'Pix'],
                datasets: [{
                    data: [{{ $formapag_dinheiro }}, {{ $formapag_cheque }}, {{ $formapag_credito }},
                        {{ $formapag_debito }}, {{ $formapag_boleto }}, {{ $formapag_pix }}
                    ],
                    backgroundColor: ['#2eb85c', '#e55353', '##321fdb', '#39f', '#ebedef', '#e55353'],
                    hoverBackgroundColor: ['#2eb85c', '#e55353', '##321fdb', '#39f', '#ebedef', '#e55353']
                }]
            },
            options: {
                responsive: true
            }
        })
    </script>

    <script type="text/javascript">
        var pieChart = new Chart(document.getElementById('chats-periodo-ano'), {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                        label: 'Ano Atual',
                        backgroundColor: coreui.Utils.hexToRgba(coreui.Utils.getStyle('--info'), 10),
                        borderColor: coreui.Utils.getStyle('--info'),
                        ointHoverBackgroundColor: '#fff',
                        borderWidth: 2,
                        data: [{{ $fin_atual_jan }}, {{ $fin_atual_fev }}, {{ $fin_atual_mar }},
                            {{ $fin_atual_abr }}, {{ $fin_atual_mai }}, {{ $fin_atual_jun }},
                            {{ $fin_atual_jul }}, {{ $fin_atual_ago }}, {{ $fin_atual_set }},
                            {{ $fin_atual_out }}, {{ $fin_atual_nov }}, {{ $fin_atual_dez }}
                        ],
                    },
                    {
                        label: 'Ano Anterior',
                        backgroundColor: 'transparent',
                        borderColor: coreui.Utils.getStyle('--success'),
                        pointHoverBackgroundColor: '#fff',
                        borderWidth: 2,
                        data: [{{ $fin_anterior_jan }}, {{ $fin_anterior_fev }},
                            {{ $fin_anterior_mar }}, {{ $fin_anterior_abr }},
                            {{ $fin_anterior_mai }}, {{ $fin_anterior_jun }},
                            {{ $fin_anterior_jul }}, {{ $fin_anterior_ago }},
                            {{ $fin_anterior_set }}, {{ $fin_anterior_out }},
                            {{ $fin_anterior_nov }}, {{ $fin_anterior_dez }}
                        ],
                    },
                    {
                        label: 'Meta',
                        backgroundColor: 'transparent',
                        borderColor: coreui.Utils.getStyle('--danger'),
                        pointHoverBackgroundColor: '#fff',
                        borderWidth: 1,
                        borderDash: [8, 5],
                        data: [{{ $metadash }}, {{ $metadash }}, {{ $metadash }},
                            {{ $metadash }}, {{ $metadash }}, {{ $metadash }},
                            {{ $metadash }}, {{ $metadash }}, {{ $metadash }},
                            {{ $metadash }}, {{ $metadash }}, {{ $metadash }}
                        ],
                    }
                ]

            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            drawOnChartArea: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            maxTicksLimit: 10,
                            stepSize: Math.ceil(250 / 5),
                        }
                    }]
                },
                elements: {
                    point: {
                        radius: 0,
                        hitRadius: 10,
                        hoverRadius: 4,
                        hoverBorderWidth: 3
                    }
                },
                tooltips: {
                    intersect: true,
                    callbacks: {
                        labelColor: function(tooltipItem, chart) {
                            return {
                                backgroundColor: chart.data.datasets[tooltipItem.datasetIndex].borderColor
                            };
                        }
                    }
                }
            }
        })
    </script>

@endsection
@else
@include('errors.redirecionar')
@endif
