@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12 mb-4">

                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#dados" role="tab"
                                    aria-controls="dados"><i class="c-icon c-icon-sm cil-contact text-dark"></i> Dados Pessoais</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#endereco" role="tab"
                                    aria-controls="endereco"><i class="c-icon c-icon-sm cil-location-pin text-dark"></i> Endereço</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#membro" role="tab"
                                    aria-controls="membro"><i class="c-icon c-icon-sm cil-book text-dark"></i> Membresia</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#acesso" role="tab"
                                    aria-controls="acesso"><i class="c-icon c-icon-sm cil-https text-dark"></i> Dados de Acesso</a></li>

                        </ul>
                        <form method="POST" action="/people/{{ $people->id }}">
                          @csrf
                          @method('PUT')
                            <div class="tab-content">
                                <div class="tab-pane active" id="dados" role="tabpanel">
                                    <div class="card-body">
                                        {!! csrf_field() !!}
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Nome</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text">
                                                            <svg class="c-icon">
                                                                <use
                                                                    xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-face">
                                                                </use>
                                                            </svg>                                                        </div>
                                                        <input class="form-control" id="name" name="name" type="text" value="{{ $people->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="ccnumber">Email</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text">
                                                            <svg class="c-icon">
                                                                <use
                                                                    xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-at">
                                                                </use>
                                                            </svg>                                                        </div>
                                                        <input class="form-control" id="email" name="email" type="text" placeholder="joao@live.com" value="{{ $people->email }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /.row-->
                                        <div class="row">
                                            <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                    <label for="ccnumber">Celular</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text">
                                                            <svg class="c-icon">
                                                                <use
                                                                    xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-mobile">
                                                                </use>
                                                            </svg>                                                        </div>
                                                        <input class="form-control" id="mobile" name="mobile" type="tel" pattern="([0-9]{2}) [0-9]{5}-[0-9]{4}" value="{{ $people->mobile }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                    <label for="ccnumber">Data de Nascimento</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text">
                                                            <svg class="c-icon">
                                                                <use
                                                                    xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-calendar">
                                                                </use>
                                                            </svg>                                                        </div>
                                                        <input class="form-control" id="birth_at" name="birth_at"  type="date"  placeholder="date" value="{{ $people->birth_at }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label class="col-md-3 col-form-label">Sexo</label>
                                                <div class="col-md-12 col-form-label">
                                                    <div class="form-check form-check-inline mr-1">
                                                      <input class="form-check-input" id="sex"  type="radio" value="m" name="sex" {{ $people->sex == 'm' ? 'checked' : '' }}>
                                                      <svg class="c-icon">
                                                        <use
                                                            xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user">
                                                        </use>
                                                    </svg>                                                        <label class="form-check-label" for="m">Masculino</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mr-1">
                                                      <input class="form-check-input" id="sex" type="radio" value="f" name="sex" {{ $people->sex == 'f' ? 'checked' : '' }}>
                                                      <svg class="c-icon">
                                                        <use
                                                            xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user-female">
                                                        </use>
                                                    </svg>
                                                        <label class="form-check-label" for="f">Feminino</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="endereco" role="tabpanel">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="street">Street</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">
                                                    <svg class="c-icon">
                                                        <use
                                                            xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-address-book">
                                                        </use>
                                                    </svg>                                                </div>
                                                <input class="form-control" id="address" name="address" type="text" placeholder="Enter street name" value="{{ $people->address }}">
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-5">
                                                <label for="city">City</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">
                                                        <svg class="c-icon">
                                                            <use
                                                                xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-house">
                                                            </use>
                                                        </svg>                                                    </div>
                                                    <input class="form-control" id="city" name="city" type="text" placeholder="Enter your city" value="{{ $people->city }}">
                                            </div>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="country">State</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">
                                                        <svg class="c-icon">
                                                            <use
                                                                xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-home">
                                                            </use>
                                                        </svg>                                                    </div>
                                                    <input class="form-control" id="state" name="state" type="text" placeholder="State" placeholder="SP" value="{{ $people->state }}">
                                            </div>
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="postal-code">Postal Code</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">
                                                        <svg class="c-icon">
                                                            <use
                                                                xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-newspaper">
                                                            </use>
                                                        </svg>                                                    </div>
                                                    <input class="form-control" id="cep" name="cep" type="text" placeholder="Postal Code" value="{{ $people->cep }}" pattern="[0-9]{5}-[0-9]{3}" maxlength="9">
                                            </div>
                                            </div>
                                        </div>
                                        <!-- /.row-->
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">
                                                    <svg class="c-icon">
                                                        <use
                                                            xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-globe-alt">
                                                        </use>
                                                    </svg>                                                </div>
                                                <input class="form-control" id="country" type="text" name="country" placeholder="Country name" value="{{ $people->country }}">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="membro" role="tabpanel">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="disabled-input">Ativo</label>
                                            <div class="col-md-9">
                                              <select class="form-control" name="status_id">
                                                @foreach($statuses as $status)
                                                           @if( $status->id == $people->status_id )
                                                               <option value="{{ $status->id }}" selected="true">{{ $status->name }}</option>
                                                           @else
                                                               <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                           @endif
                                             @endforeach
                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Status</label>
                                            <div class="col-md-9 col-form-label">
                                                <div class="form-check checkbox">
                                                  <input class="form-check-input" id="is_responsible" name="is_responsible" type="checkbox" {{ $people->is_responsible == true ? 'checked' : '' }}>
                                                  <label class="form-check-label" for="check1">Responsável</label>
                                                </div>
                                                <div class="form-check checkbox">
                                                  <input class="form-check-input" id="is_visitor" type="checkbox" name="is_visitor" {{ $people->is_visitor == true ? 'checked' : '' }}>
                                                  <label class="form-check-label" for="check2">Visitante</label>
                                                </div>
                                                <div class="form-check checkbox">
                                                  <input class="form-check-input" id="is_baptism" type="checkbox"  name="is_baptism" {{ $people->is_baptism == true ? 'checked' : '' }}>
                                                  <label class="form-check-label" for="check4">Batismo</label>
                                                </div>
                                                <div class="form-check checkbox">
                                                  <input class="form-check-input" id="is_transferred" type="checkbox" name="is_transferred" {{ $people->is_transferred == true ? 'checked' : '' }}>
                                                  <label class="form-check-label" for="check5">Transferido</label>
                                                </div>
                                                <div class="form-check checkbox">
                                                  <input class="form-check-input" id="is_conversion" type="checkbox" name="is_conversion" {{ $people->is_conversion == true ? 'checked' : '' }}>
                                                  <label class="form-check-label" for="check6">Convertido</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="textarea-input">Anotações</label>
                                            <div class="col-md-9">
                                              <textarea class="form-control" name="note" rows="9" placeholder="Content..">{{ $people->note }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="acesso" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal" action="" method="post">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="hf-email">Email</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" placeholder="Enter Email.."
                                                        autocomplete="email" disabled><span class="help-block">Please enter
                                                        your email</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="hf-password">Password</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" placeholder="Enter Password.."
                                                        autocomplete="current-password" disabled><span
                                                        class="help-block">Please enter
                                                        your password</span>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                    </div>

                    <!-- /.col-->
                </div>
                <div class="col-md-12">
                    <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
                    <a href="{{ route('people.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                    </form>
                </div>
                <!-- /.row-->
                <!-- /.col-->
            </div>
            <!-- /.row-->
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
