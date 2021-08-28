@extends('dashboard.base')

@section('content')


    <div class="container-fluid">
        <div class="fade-in">
            <h6 class="card-title">Bem vindo a {{ $a }}</h6>
            @if ($precadastro >= 1 and $roles->roleslocal->edit_precadastro == true)
                <div class="card card-accent-success mb-12" style="max-width: 18rem;">
                    <div class="card-body text-success">
                        <h6 class="card-title">Há cadastros a serem aprovados</h6>
                        <a href="{{ route('peopleList.index') }}" class="btn btn-primary">Pré-cadastro</a>
                        </p>
                    </div>
                </div>
            @endif
            <style type="text/css">
                .btn {
                    margin-bottom: 4px;
                }

            </style>
            <div class="fade-in">
                @if ($roles->roleslocal->home_social == true)
                    @if (($social->facebook_link !== null) | ($social->twitter_link !== null) | ($social->linkedin_link !== null) | ($social->youtube_link !== null) | ($social->instagram_link !== null) | ($social->vk_link !== null) | ($social->site_link !== null) | ($social->telegram_link !== null) | ($social->whatsapp_link !== null))
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>Rede Sociais</h6>
                                        <p>
                                            @if ($social->facebook_link !== null)
                                                <a class="btn btn-sm btn-facebook" type="button"
                                                    href="{{ $social->facebook_link }}" target="_blank">
                                                    <svg class="c-icon mr-2">
                                                        <use xlink:href="/icons/sprites/brand.svg#cib-facebook-f"></use>
                                                    </svg><span>Facebook</span>
                                                </a>
                                            @endif
                                            @if ($social->twitter_link !== null)
                                                <a class="btn btn-sm btn-twitter" type="button"
                                                    href="{{ $social->twitter_link }}" target="_blank">
                                                    <svg class="c-icon mr-2">
                                                        <use xlink:href="/icons/sprites/brand.svg#cib-twitter"></use>
                                                    </svg><span>Twitter</span>
                                                </a>
                                            @endif
                                            @if ($social->linkedin_link !== null)
                                                <a class="btn btn-sm btn-linkedin" type="button"
                                                    href="{{ $social->linkedin_link }}" target="_blank">
                                                    <svg class="c-icon mr-2">
                                                        <use xlink:href="/icons/sprites/brand.svg#cib-linkedin"></use>
                                                    </svg><span>LinkedIn</span>
                                                </a>
                                            @endif
                                            @if ($social->youtube_link !== null)
                                                <a class="btn btn-sm btn-youtube" type="button"
                                                    href="{{ $social->youtube_link }}" target="_blank">
                                                    <svg class="c-icon mr-2">
                                                        <use xlink:href="/icons/sprites/brand.svg#cib-youtube"></use>
                                                    </svg><span>YouTube</span>
                                                </a>
                                            @endif
                                            @if ($social->instagram_link !== null)
                                                <a class="btn btn-sm btn-instagram" type="button"
                                                    href="{{ $social->instagram_link }}" target="_blank">
                                                    <svg class="c-icon mr-2">
                                                        <use xlink:href="/icons/sprites/brand.svg#cib-instagram"></use>
                                                    </svg><span>Instagram</span>
                                                </a>
                                            @endif
                                            @if ($social->vk_link !== null)
                                                <a class="btn btn-sm btn-vk" type="button" href="{{ $social->vk_link }}"
                                                    target="_blank">
                                                    <svg class="c-icon mr-2">
                                                        <use xlink:href="/icons/sprites/brand.svg#cib-vk"></use>
                                                    </svg><span>VK</span>
                                                </a>
                                            @endif
                                            @if ($social->site_link !== null)
                                                <a class="btn btn-sm btn-yahoo" type="button"
                                                    href="{{ $social->site_link }}" target="_blank">
                                                    <svg class="c-icon mr-2">
                                                        <use
                                                            xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-globe-alt">
                                                        </use>
                                                    </svg><span>Website</span>
                                                </a>
                                            @endif
                                            @if ($social->telegram_link !== null)
                                                <a class="btn btn-sm btn-yahoo" type="button"
                                                    href="https://t.me/{{ $social->telegram_link }}" target="_blank">
                                                    <svg class="c-icon mr-2">
                                                        <use xlink:href="/icons/sprites/brand.svg#cib-telegram"></use>
                                                    </svg><span>Telegram</span>
                                                </a>
                                            @endif
                                            @if ($social->whatsapp_link !== null)
                                                <a class="btn btn-sm btn-vimeo" type="button"
                                                    href="https://api.whatsapp.com/send?phone={{ $social->whatsapp_link }}"
                                                    target="_blank">
                                                    <svg class="c-icon mr-2">
                                                        <use xlink:href="/icons/sprites/brand.svg#cib-whatsapp"></use>
                                                    </svg><span>Whatsapp</span>
                                                </a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                    @endif
                @endif
                @if ($roles->roleslocal->home_grupo == true)
                    @if (!$groups->isEmpty())
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>Meus grupos</h6>
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
                                </div>
                    @endif
                @endif

            </div>
        </div>
        @if ($roles->roleslocal->home_financeiro == true)
            <!-- /.row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6>Informações gerais</h6>
                            <p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="c-callout c-callout-info"><small class="text-muted">Total de
                                                    Visitantes</small>
                                                <div class="text-value-lg">{{ $totalvisitante }}</div>
                                            </div>
                                        </div>
                                        <!-- /.col-->
                                        <div class="col-6">
                                            <div class="c-callout c-callout-danger"><small class="text-muted">Total
                                                    de Conversões</small>
                                                <div class="text-value-lg"> {{ $totalconversao }}</div>
                                            </div>
                                        </div>
                                        <!-- /.col-->
                                    </div>
                                    <!-- /.row-->
                                    <hr class="mt-0">
                                    Movimento finaceiro x Previsão
                                    <div class="progress-group">
                                        <div class="progress-group-header align-items-end">
                                            <svg class="c-icon progress-group-icon">
                                                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-globe-alt">
                                                </use>
                                            </svg>
                                            <div>Dizimos</div>
                                            <div class="ml-auto font-weight-bold mr-2"></div>
                                            <div class="text-muted small"></div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $porcentage_doacao }}%" aria-valuenow="56"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group">
                                        <div class="progress-group-header align-items-end">
                                            <svg class="c-icon progress-group-icon">
                                                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-globe-alt">
                                                </use>
                                            </svg>
                                            <div>Ofertas</div>
                                            <div class="ml-auto font-weight-bold mr-2"></div>
                                            <div class="text-muted small"></div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $porcentage_doacao }}%" aria-valuenow="15"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group">
                                        <div class="progress-group-header align-items-end">
                                            <svg class="c-icon progress-group-icon">
                                                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-globe-alt">
                                                </use>
                                            </svg>
                                            <div>Doações</div>
                                            <div class="ml-auto font-weight-bold mr-2"></div>
                                            <div class="text-muted small"></div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $porcentage_doacao }}%" aria-valuenow="11"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group">
                                        <div class="progress-group-header align-items-end">
                                            <svg class="c-icon progress-group-icon">
                                                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-globe-alt">
                                                </use>
                                            </svg>
                                            <div>Despesas</div>
                                            <div class="ml-auto font-weight-bold mr-2"></div>
                                            <div class="text-muted small"></div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width:  {{ $porcentage_despesa }}%" aria-valuenow="8"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-->
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="c-callout c-callout-warning"><small class="text-muted">Total
                                                    de Batismos</small>
                                                <div class="text-value-lg">{{ $totalbatismo }}</div>
                                            </div>
                                        </div>
                                        <!-- /.col-->
                                        <div class="col-6">
                                            <div class="c-callout c-callout-success"><small class="text-muted">Total
                                                    de Pessoas</small>
                                                <div class="text-value-lg">{{ $peopleativo }}</div>
                                            </div>
                                        </div>
                                        <!-- /.col-->
                                    </div>
                                    <!-- /.row-->
                                    <hr class="mt-0">
                                    <div class="progress-group">
                                        Gráfico do movimento
                                        <div class="c-chart-wrapper">
                                            <canvas id="chats"></canvas>
                                        </div>
                                    </div>
                                    <!-- /.row-->
                                </div>

                            </div>
                            <!-- /.col-->
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>
    </div>
    </div>
    <script type="text/javascript">
        var pieChart = new Chart(document.getElementById('chats'), {
            type: 'pie',
            data: {
                labels: ['Dizimo', 'Oferta', 'Doação', 'Despesa'],
                datasets: [{
                    data: ['1500', '1500', '1500', '1500'],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#2eb85c'],
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#2eb85c']
                }]
            },
            options: {
                responsive: true
            }
        })
    </script>
@endsection

@section('javascript')


@endsection
