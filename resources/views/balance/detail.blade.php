@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <div class="invoice">
                                    <div class="invoice-print">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="invoice-title">
                                                    <h2>Invoice</h2>
                                                    <div class="text-right">Order #{{ $historics->id }}</div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <address>
                                                            <strong>Billed To:</strong><br>
                                                            {{ $account->name_company }}<br>
                                                            {{ $account->address1 }}<br>
                                                            {{ $account->cep }}<br>
                                                            @if ($account->city && $account->state != null)
                                                                {{ $account->city }} / {{ $account->state }}
                                                            @elseif($account->city != null)
                                                                {{ $account->city }}
                                                            @elseif($account->state != null)
                                                                {{ $account->state }}
                                                            @elseif($account->country != null)
                                                                {{ $account->country }}
                                                            @endif
                                                        </address>
                                                    </div>
                                                    @if ($people !== null)
                                                        <div class="col-md-6 text-md-right">
                                                            <address>
                                                                <strong>Shipped To:</strong><br>
                                                                {{ $people->name }}<br>
                                                                {{ $people->email }}<br>
                                                                {{ $people->mobile }}<br>
                                                                {{ $people->address }} CEP: {{ $people->cep }}<br>
                                                                @if ($people->city && $people->state != null)
                                                                    {{ $people->city }} / {{ $people->state }}
                                                                @elseif($people->city != null)
                                                                    {{ $people->city }}
                                                                @elseif($people->state != null)
                                                                    {{ $people->state }}
                                                                @elseif($people->country != null)
                                                                    {{ $people->country }}
                                                                @endif
                                                            </address>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <address>
                                                            <strong>Payment Method:</strong><br>
                                                            Type: {{ $statusfinan->name }}<br>
                                                            @if ($people !== null)
                                                            Form of Payment: {{ $statuspag->name }}
                                                            @endif
                                                        </address>
                                                    </div>
                                                    <div class="col-md-6 text-md-right">
                                                        <address>
                                                            <strong>Order Date:</strong><br>
                                                            {{ ($historics->date) }}<br>
                                                            <br>
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="section-title">Order Summary</div>
                                                <p class="section-lead">All items here cannot be deleted.</p>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-md">
                                                        <tr>
                                                            <th data-width="40">#</th>
                                                            <th>Item</th>
                                                            <th class="text-center">Price</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-right">Totals</th>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Carregar em Javascript,falta finalizar essa parte</td>
                                                            <td class="text-center">$10.99</td>
                                                            <td class="text-center">1</td>
                                                            <td class="text-right">$10.99</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-lg-8">
                                                        <div class="section-title">Payment Note</div>
                                                        <p class="section-lead">{{ $historics->observacao}}</p>

                                                    </div>
                                                    <div class="col-lg-4 text-right">
                                                        <!--
                                                        <div class="invoice-detail-item">
                                                            <div class="invoice-detail-name">Subtotal</div>
                                                            <div class="invoice-detail-value">$670.99</div>
                                                        </div>
                                                        <div class="invoice-detail-item">
                                                            <div class="invoice-detail-name">Shipping</div>
                                                            <div class="invoice-detail-value">$15</div>
                                                        </div>
                                                    -->
                                                        <hr class="mt-2 mb-2">
                                                        <div class="invoice-detail-item">
                                                            <div class="invoice-detail-name">Total</div>
                                                            <div class="invoice-detail-value invoice-detail-value-lg">
                                                                ${{$historics->amount}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                        <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i>
                                            Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        User: {{ $usuario->name}} / Date: {{ date('jS F, Y',  strtotime($historics->created_at)) }}
                        <!-- /.row-->
                    </div>
                </div>
                
            </div>
        </div>
    @endsection

    @section('javascript')

    @endsection
