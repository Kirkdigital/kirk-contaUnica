@extends('layouts.baseminimal')

@section('content')

      <div class="container-fluid">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i>{{ __('account.select') }}</div>
                    <div class="card-body">
                      <table class="table table-responsive-sm table-striped">
                     <thead>
                    <tr>
                      <th>ID</th>
                      <th>{{ __('account.name') }}</th>
                      <th>{{ __('account.type') }}</th>
                      <th colspan="3"><Center>{{ __('account.action') }}</Center></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($institutions as $institution)
                    <tr>
                      <td>{{ $institution->id }}</td>
                      <td width="60%">{{ $institution->name_company }}</td>
                      <td>
                        <span class="{{ $institution->status->class }}">
                        {{ $institution->status->name }}
                        </span>
                      </td>
                      <td width="1%">
                       <a href="{{ url('/account/' . $institution->id . '/edit') }}" class="btn btn-primary-outline"><i class="c-icon c-icon-sm cil-pencil text-success"></i></a>
                      </td>
                      <td width="1%">
                      @if(Auth::user()->isAdmin())
                        <form action="{{ route('account.destroy', $institution->id ) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-primary-outline show_confirm" data-toggle="tooltip" title='Delete'><i class="c-icon c-icon-sm cil-trash text-danger"></i></button>
                        </form>
                        @endif
                       
                      </td>
                      <td width="1%">
                      <form method="post" action="{{route('tenant',['id' => $institution->id]) }}">
                          @method('POST')
                          @csrf
                            <button class="btn btn-primary-outline" type="submit"><i class="c-icon c-icon-sm cil-room text-dark"></i></button>
                        </form>
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


@endsection

@section('javascript')

@endsection