@extends('layouts.baseminimal')

@section('content')

      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <i class="fa fa-align-justify"></i>{{ __('account.information') }}
              </div>

             
                <div class="row">
                  <div class="form-group col-sm-4 col-md-6 col-lg-6 col-xl-6">
                    @if((Auth::user()->license - $countinst) >= 1 || Auth::user()->isAdmin())
                    <label for="ccmonth"><a href="{{ route('account.create') }}" class="btn btn-primary m-2">{{ __('account.add') }} {{ __('account.account') }}</a><br>
                      @endif
                  </div>
                  <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <label for="ccmonth">{{ __('account.license') }}</label><br>
                    <label for="ccmonth">{{ Auth::user()->license }}</label>
                  </div>
                  <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <label for="ccmonth">{{ __('account.used') }}</label><br>
                    <label for="ccmonth">{{ $countinst }}</label>
                  </div>
                  <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <label for="ccmonth">{{ __('account.available') }}</label><br>
                    <label for="ccmonth">{{ (Auth::user()->license - $countinst) }}</label>
                  </div>
                </div>
                <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table table-responsive-sm">
                     <thead>
                    <tr>
                    <th>{{ __('account.doc') }}</th>
                      <th>{{ __('account.name') }}</th>
                      
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Expired</th>
                      <th>{{ __('account.type') }}</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($institutions as $institution)
                    <tr>
                      <td>{{ $institution->doc }}</td>
                      <td>{{ $institution->name_company }}</td>
                      <td>{{ $institution->email }}</td>
                      <td>{{ $institution->mobile }}</td>
                      <td>{{ $institution->expired }}</td>
                      <td>
                        <span class="{{ $institution->status->class }}">
                        {{ $institution->status->name }}
                        </span>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $institutions->links() }}
              </div>
            </div>
          </div>
                </div>
        </div>
      </div>


@endsection

@section('javascript')

@endsection