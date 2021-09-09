@extends('layouts.baseminimal')
@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i><strong>Create new Account</strong>
                        </div>
                        <div class="card-body">
                            <br>
                            <form method="POST" action="{{ route('account.store') }}">
                                @csrf

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg class="c-icon c-icon-sm">
                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-contact">
                                                </use>
                                            </svg>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" placeholder="{{ __('Name') }}"
                                        name="name_company" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg class="c-icon c-icon-sm">
                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-featured-playlist"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text"  placeholder="01.452.25/0001-19"
                                    pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}" name="doc" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input class="form-control" type="email" placeholder="{{ __('E-Mail Address') }}"
                                        name="email">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg class="c-icon c-icon-sm">
                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-phone"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <input class="form-control" name="mobile" type="tel"
                                    placeholder="11 99999-9999"
                                    pattern="([0-9]{2}) [0-9]{5}-[0-9]{4}" required>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label>Type</label>
                                        <select class="form-control" name="status_id" disabled>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                    <input class="form-control" name="address" type="text" placeholder="Enter street name"
                                        maxlength="200">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-5">
                                    <label for="city">City</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">
                                                <svg class="c-icon">
                                                    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-house">
                                                    </use>
                                                </svg></span></div>
                                        <input class="form-control" name="city" type="text" placeholder="Enter your city"
                                            >
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="country">State</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">
                                                <svg class="c-icon">
                                                    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-home">
                                                    </use>
                                                </svg></span></div>
                                        <input class="form-control" name="state" type="text" placeholder="State"
                                            placeholder="SP" maxlength="2">
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
                                                </svg></span></div>
                                        <input class="form-control" name="cep" type="number" placeholder="69059-627"
                                            maxlength="9" pattern="[0-9]{5}-[0-9]{3}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="city">Latitude</label>
                                        <div class="input-group-prepend">
                                        <input class="form-control" name="lat" type="text"
                                            maxlength="15"  placeholder="-27.5859412">
                                    
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="city">Longitude</label>
                                        <input class="form-control" name="lng" type="text"
                                            maxlength="15" placeholder="-48.6003264">
                                    </div>
                            </div>
                            <!-- /.row-->
                            <div class="form-group">
                                <label for="country">Country</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                            <svg class="c-icon">
                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-globe-alt">
                                                </use>
                                            </svg></span></div>
                                    <input class="form-control" name="country" type="text" placeholder="Country name"
                                        value="BRAZIL">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button class="btn btn-block btn-success" data-toggle="modal" data-target=".cd-load" type="submit">{{ __('Save') }}</button>
                    <a href="{{ route('account.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                    </form>
                </div>
            </div>
        </div>

    @endsection

    @section('javascript')

    @endsection
