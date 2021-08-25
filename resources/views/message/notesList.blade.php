@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="container">
                            <div class="card-header">
                                <div class="form-groups row">
                                    <div class="col-sm-2 col-md-2 col-lg-4 col-xl-10">
                                        <h5>Recados</h5>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-4 col-xl-2">
                                        <div class="row">
                                            <a href="{{ route('message.create') }}"
                                                class="btn btn-primary">{{ __('Adicionar') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th colspan="3">
                                          <Center>{{ __('account.action') }}</Center>
                                      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notes as $note)
                                        <tr>
                                            <td><strong>{{ $note->user->name }}</strong></td>
                                            <td><strong>{{ $note->title }}</strong></td>
                                            <td>{{ $note->content }}</td>
                                            <td>{{ $note->applies_to_date }}</td>
                                            <td>
                                                <span class="{{ $note->status->class }}">
                                                    {{ $note->status->name }}
                                                </span>
                                            </td>
                                            <td width="1%">
                                                <a href="{{ route('message.show', $note->id) }}"><i
                                                        class="c-icon c-icon-sm cil-notes text-primary"></i></a>
                                            </td>
                                            
                                                <td width="1%">
                                                    <a href="{{ route('message.edit', $note->id) }}"><i
                                                            class="c-icon c-icon-sm cil-pencil text-success"></i></a>
                                                </td>
                                            
                                                <td width="1%">
                                                    <form action="{{ route('message.destroy', $note->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a class="show_confirm" data-toggle="tooltip" title='Delete'><i
                                                                class="c-icon c-icon-sm cil-trash text-danger"></i></a>
                                                    </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $notes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')

@endsection
