@extends('layouts.baseminimal')


@section('content')

<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><strong>Selecionar a conta</strong></div>
          <div class="card-body">
          <form method="POST" action="{{ url('people.storeprecadastro') }}">
            {!! csrf_field() !!}   
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                    <label for="ccnumber">Account</label>
                    <select class="itemName form-control" id="itemName" name="itemName"></select>
                </div>
            </div>
            </div>
            <!-- /.row-->
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->
     
          <button class="btn btn-block btn-success" type="submit">Avançar</button>
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
  $('.itemName').select2({
    placeholder: 'Select an item',
    
    ajax: {
      url: '/select2-autocomplete-account',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.name_company,
                    id: item.id
                }
            })
        };
      },
      cache: true
    }
  });
  </script>
  

@endsection

@section('javascript')

@endsection