@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
          <div class="card-header"><strong>Dados do Perfil</strong></div>
          <div class="card-body">
          <form action="{{ route('profile.update') }}" method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <center>
                                                @if(!empty(Auth::user()->image))
                                                <img class="image rounded-circle" src="{{ url('/public/' .auth()->user()->image) }}" alt="profile_image" style="width: 160px;height: 160px; padding: 10px; margin: 0px; ">
                                                @endif
                                        </center>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="name">Nome</label>
                    <input class="form-control" name="name" type="text" placeholder="João Silva" value='{{ Auth::user()->name }}'>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="name">CNPJ/CPF</label>
                    <input class="form-control" name="doc" type="text" placeholder="João Silva" value='{{ Auth::user()->doc }}'>
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
                            <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                          </svg></span></div>
                      <input class="form-control" name="email" type="email" placeholder="joao@live.com" autocomplete="joao@live.com" value="{{ Auth::user()->email }}">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.row-->
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="ccmonth">Celular</label>
                  <input class="form-control" name="mobile" type="text" placeholder="(11) 99999-9999" value="{{ Auth::user()->mobile }}">
                </div>
              </div>
              <div class="row">
                                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile Image</label>
                                            <div class="form-group col-sm-6">
                                                <input id="profile_image" type="file" class="form-control" name="profile_image">
                                            </div>
                                        </div>

          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
          <div class="card-header">Thema</div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-sm-3">Theme Dark<br>
                <label class="c-switch c-switch-3d c-switch-primary">
                  <input class="c-switch-input" name="theme_dark" type="checkbox" {{ Auth::user()->theme_dark == true ? 'checked' : '' }} disabled><span class="c-switch-slider"></span>
                </label>
              </div>
              <div class="form-group col-sm-3">Sidebar Minimal<br>
                <label class="c-switch c-switch-3d c-switch-primary">
                  <input class="c-switch-input" name="sidebar_minimal" type="checkbox" {{ Auth::user()->sidebar_minimal == true ? 'checked' : '' }} disabled><span class="c-switch-slider"></span>
                </label>
              </div>
            </div>
            <div class="row">
            <div class="form-group col-sm-3">
                <strong>Select Language: </strong>
            </div>
            <div class="col-md-4">
                <select class="form-control changeLang">
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="pt" {{ session()->get('locale') == 'pt' ? 'selected' : '' }}>Portuguese</option>
                </select>
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
  <!-- /.row-->
  <!-- /.col-->
</div>
<!-- /.row-->
</div>
</div>
<script type="text/javascript">
  
    var url = "{{ route('changeLang') }}";
  
    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });
  
</script>
</html>

@endsection

@section('javascript')

@endsection