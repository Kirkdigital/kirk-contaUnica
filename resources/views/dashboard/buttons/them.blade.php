@extends('dashboard.base')

@section('content')

          <div class="container-fluid">
            <div class="fade-in">
              <div class="card">
                <div class="card-header"><strong>Theme</strong></div>
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-12 col-xl mb-3 mb-xl-0">Base</div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/breadcrumb') }}">breadcrumb</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                      <a class="btn btn-block btn-primary" href="{{ url('/base/cards') }}">Cards</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/carousel') }}">carousel</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/collapse') }}">collapse</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/forms') }}">forms</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/jumbotron') }}">jumbotron</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/list-group') }}">list-group</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/navs') }}">navs</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/pagination') }}">pagination</a>
                    </div>
                  </div>
                  <br>
                  <div class="row align-items-center">
                    <div class="col-12 col-xl mb-3 mb-xl-0"></div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/popovers') }}">popovers</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                      <a class="btn btn-block btn-primary" href="{{ url('/base/progress') }}">progress</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/scrollspy') }}">scrollspy</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/switches') }}">switches</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/tables') }}">tables</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/tabs') }}">tabs</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/base/tooltips') }}">tooltips</a>
                    </div>
                  </div>
        <br>
                   <div class="row align-items-center">
                    <div class="col-12 col-xl mb-3 mb-xl-0">Button</div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/buttons/buttons') }}">buttons</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                      <a class="btn btn-block btn-primary" href="{{ url('/buttons/button-group') }}">button-group</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/buttons/dropdowns') }}">dropdowns</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/buttons/brand-buttons') }}">brand-buttons</a>
                    </div>
                  </div>

<br>
<div class="row align-items-center">
                    <div class="col-12 col-xl mb-3 mb-xl-0">icon</div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/icon/coreui-icons') }}">coreui-icons</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                      <a class="btn btn-block btn-primary" href="{{ url('/icon/flags') }}">flags</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/icon/brands') }}">brands</a>
                    </div>
                  </div>
                  <br>
                   <div class="row align-items-center">
                    <div class="col-12 col-xl mb-3 mb-xl-0">notifications</div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/notifications/alerts') }}">alerts</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                      <a class="btn btn-block btn-primary" href="{{ url('/notifications/badge') }}">badge</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/notifications/modals') }}">modals</a>
                    </div>
                  </div>
<br>
                  <div class="row align-items-center">
                    <div class="col-12 col-xl mb-3 mb-xl-0">Geral</div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/colors') }}">colors</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                      <a class="btn btn-block btn-primary" href="{{ url('/typography') }}">typography</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/charts') }}">charts</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/widgets') }}">widgets</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/404') }}">404</a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0">
                    <a class="btn btn-block btn-primary" href="{{ url('/500') }}">500</a>
                    </div>
                  </div>

                </div>
              </div>

              <!-- /.row-->
            </div>
          </div>

@endsection

@section('javascript')

@endsection