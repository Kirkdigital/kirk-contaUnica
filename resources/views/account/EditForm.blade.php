@extends('layouts.baseminimal')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> <strong>{{ __('Edit Account') }}</strong>
                        </div>
                        <div class="card-body">
                            <br>
                            <form method="POST" action="/account/{{ $institution->id }}">
                                @csrf
                                @method('PUT')
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg class="c-icon c-icon-sm">
                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-contact">
                                                </use>
                                            </svg>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="name_company"
                                        value="{{ $institution->name_company }}" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg class="c-icon c-icon-sm">
                                                <use
                                                    xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-featured-playlist">
                                                </use>
                                            </svg>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" placeholder="{{ __('CNPJ') }}" name="doc"
                                        pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}"
                                        value="{{ $institution->doc }}" required disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input class="form-control" type="email" placeholder="{{ __('E-Mail Address') }}"
                                        name="email" value="{{ $institution->email }}" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg class="c-icon c-icon-sm">
                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-phone"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <input class="form-control" type="tel" placeholder="{{ __('Mobile') }}" name="mobile"
                                        value="{{ $institution->mobile }}" pattern="([0-9]{2}) [0-9]{5}-[0-9]{4}" required
                                        autofocus>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">Endereço</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="street">Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                            <svg class="c-icon">
                                                <use
                                                    xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-address-book">
                                                </use>
                                            </svg></span></div>
                                    <input class="form-control" name="address1" type="text" placeholder="Enter street name"
                                        value="{{ $institution->address1 }}" maxlength="200" required>
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
                                                    </svg></span></div>
                                            <input class="form-control" name="city" type="text"
                                                placeholder="Enter your city" value="{{ $institution->city }}" placeholder="SP" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="city">State</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">
                                                    <svg class="c-icon">
                                                        <use
                                                            xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-house">
                                                        </use>
                                                    </svg></span></div>
                                            <input class="form-control" name="state" type="text"
                                                value="{{ $institution->state }}"
                                                maxlength="2" placeholder="SP" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="postal-code">Postal Code</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">
                                                    <svg class="c-icon">
                                                        <use
                                                            xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-home">
                                                        </use>
                                                    </svg></span></div>
                                            <input class="form-control" name="cep" type="text" placeholder="69059-627"
                                            pattern="[0-9]{5}-[0-9]{3}" maxlength="9"
                                                value="{{ $institution->cep }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="city">Latitude</label>
                                            <div class="input-group-prepend">
                                            <input class="form-control" name="lat" type="text"
                                                placeholder="Enter your city" value="{{ $institution->lat }}" maxlength="15"  placeholder="-27.5859412">
                                        
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="city">Longitude</label>
                                            <input class="form-control" name="lng" type="text"
                                                placeholder="Enter your state" value="{{ $institution->lng }}"
                                                maxlength="15" placeholder="-48.6003264">
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
                                                </svg></span></div>
                                        <input class="form-control" name="country" id="country" type="text"
                                            placeholder="Country name" value="{{ $institution->country }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
                    <a href="{{ route('account.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                    </form>
                </div>
            </div>
        </div>

    @endsection

    @section('javascript')

    @endsection
