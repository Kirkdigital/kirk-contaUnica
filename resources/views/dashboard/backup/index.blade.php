@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="container">

                            <div class="card-header">
                                <h5>Backup</h5>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if($people == 0)
                                    <input type="file" name="file" class="form-control">
                                    <br>
                                    <button class="btn btn-success">Import User Data</button>
                                    @endif
                                    <a class="btn btn-info" href="{{ route('export') }}">Export User Data</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- /.row-->
    </div>
@endsection

@section('javascript')

@endsection
