@extends('dashboard.base')
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="container">

                      <div class="card-header">
                        <i class="fa fa-align-justify"></i>{{ __('People') }}
                      </div>
                            <form action="{{ route('people.search') }}" method="POST" class="form form-inline">
                                {!! csrf_field() !!}
                         <div class="card-body">
                            <div class="form-group row">

                              <div class="col-sm-12 col-md-4 col-lg-4 col-xl-8">
                                @if( $config->first()->add_people == true)
                                <div class="row">
                                  <a href="{{ route('people.create') }}" class="btn btn-primary m-2">{{ __('Add People') }}</a>
                                </div>
                                @endif
                            </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <div class="inner">
                                        <input type="text" id='name' name="name" class="form-control" placeholder="Nome">
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-2 col-lg-2 col-xl-2">
                                    <div class="box-header">
                                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </form>
                        
                        <div class="box-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>E-mail</th>
                                      <th>Mobile</th>
                                      <th>Localization</th>
                                      <th>Status</th>
                                      <th></th>
                                      <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($peoples as $people)
                                    <tr>
                                      <td><strong>{{ $people->name }}</strong></td>
                                      <td>{{ $people->email }}</td>
                                      <td>{{ $people->mobile }}</td>
                                      <td>
                                        @if($people->city && $people->state != null)
                                        {{ $people->city }} / {{ $people->state }}
                                        @elseif($people->city != null)
                                        {{ $people->city }}
                                        @elseif($people->state != null)
                                        {{ $people->state }}
                                        @elseif($people->country != null)
                                        {{ $people->country }}
                                        @endif
                                      </td>
                                      <td>
                                        <span class="{{ $people->status->class }}">
                                          {{ $people->status->name }}
                                        </span>
                                      </td>
                                      @if( $config->first()->edit_people == true)
                                      <td>
                                        <a href="{{ url('/people/' . $people->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                                      </td>
                                      @endif
                                      @if( $config->first()->delete_people == true)
                                      <td>
                                        <form action="{{ route('people.destroy', $people->id ) }}" method="POST">
                                          @method('DELETE')
                                          @csrf
                                          <button class="btn btn-block btn-danger">Delete</button>
                                        </form>
                                       </td>
                                       @endif
                                    </tr>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>

                            @if (isset($dataForm))
                            {!! $peoples->appends($dataForm)->links() !!}
                            @else
                            {!! $peoples->links() !!}
                            
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.row-->
            </div>
        </div>
    </div>
</div>
<script>
  $("#name").on("input", function(){
    $(this).val($(this).val().toUpperCase());
});
</script>
@endsection

@section('javascript')

@endsection