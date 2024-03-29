@if ($appPermissao->edit_message == true)
@extends('layouts.base')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><strong>Dados do Recado</strong></div>
                        <div class="card-body">
                            <form method="POST" action="/message/{{ $note->id }}" role="form"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input class="form-control" type="text" placeholder="{{ __('Title') }}"
                                                name="title" value="{{ $note->title }}" required autofocus>
                                        </div>

                                        <div class="form-group">
                                            <label>Content</label>
                                            <textarea class="form-control" id="textarea-input" name="content" rows="9"
                                                placeholder="{{ __('Content..') }}" required>{{ $note->content }}</textarea>
                                        </div>
                                        <!-- /.row-->
                                        <div class="row">
                                            <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                    <label for="ccnumber">Date</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text">
                                                                <svg class="c-icon">
                                                                    <use
                                                                        xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-calendar">
                                                                    </use>
                                                                </svg>
                                                        </div>
                                                        <input class="form-control" name="applies_to_date" type="date"
                                                            placeholder="date" value="{{ $note->applies_to_date }}" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                    <label for="ccnumber">Status</label>
                                                    <div class="input-group">
                                                        <select class="form-control"name="status_id">
                                                            @foreach($statuses as $status)
                                                                @if( $status->id == $note->status_id )
                                                                    <option value="{{ $status->id }}" selected="true">{{ $status->name }}</option>
                                                                @else
                                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <div class="form-group">
                                                    <label for="ccnumber">Type</label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="text"
                                                            placeholder="{{ __('Note type') }}" name="note_type" value="{{ $note->note_type }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <div class="form-group">
                                                <label for="image" class="col-md-4 col-form-label text-md-right">
                                                    Image</label>
                                                <div class="form-group col-sm-6">
                                                    <input id="image" type="file" class="form-control" name="image">
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    <a class="btn btn-dark" href="{{ route('message.index') }}">Return</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

@endsection
@else
@include('errors.redirecionar')
@endif