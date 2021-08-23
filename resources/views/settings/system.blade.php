@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header"><strong>Configurações Gerais</strong></div>
                        <div class="card-body">
                            <form action="{{ route('settings.updateSystem') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label">Favicon (25*25)</label><br />
                                    <p><img src="http://demo.deskapps.net/assets/img/a99e81e77b7b1bfb330d46479c4dd282.jpg"
                                            class="favicon"></p>
                                    <input type="file" name="favicon" accept=".png, .jpg, .jpeg, .gif, .svg">
                                    <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                                    <input type="hidden" name="favicon"
                                        value="assets/img/a99e81e77b7b1bfb330d46479c4dd282.jpg">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Logo</label><br />
                                    <p><img src="http://demo.deskapps.net/assets/img/2e79d6b2095794bd62b0155dae20ac08.jpg"
                                            class="logo" width="150"></p>
                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg, .gif, .svg">
                                    <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                                    <input type="hidden" name="logo"
                                        value="assets/img/2e79d6b2095794bd62b0155dae20ac08.jpg">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nome da aplicação</label>
                                    <input type="text" class="form-control" name="name" placeholder="Application name"
                                        value="{{ $settings->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Timezone</label>
                                    <input type="text" class="form-control" name="timezone" placeholder="timezone"
                                        value="{{ $settings->timezone }}" required>
                                    <a href="http://php.net/manual/en/timezones.php" target="_blank">Timezone</a>
                                </div>
                                <!--
                                    <div class="form-group">
                                        <label class="control-label">Linguagem padrão</label>
                                        <select name="language" class="form-control">
                                            <option value="1">Portuguese-BR</option>
                                            <option value="2">English</option>
                                        </select>
                                    </div>
                                    -->
                                <div class="form-group">
                                    <label class="control-label">Moeda</label>
                                    <input type="text" class="form-control" name="currency" placeholder="currency"
                                        value="{{ $settings->currency }}" required>
                                </div>
                                <!-- /.row-->
                                <button class="btn btn-primary" type="submit">Save</button>
                                <a class="btn btn-dark" href="{{ route('settings') }}">Return</a>
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
