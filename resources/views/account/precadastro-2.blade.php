@extends('layouts.baseminimal')


@section('content')

<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header"><strong>Dados Pessoais</strong></div>
          <div class="card-body">
          <form method="POST" action="{{ url('people.storeprecadastro') }}">
              @csrf
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="name">Nome</label>
                  <input class="form-control" id='name' name="name" type="text" value="" required>
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
                    <input class="form-control" name="email" type="email" placeholder="joao@live.com" autocomplete="joao@live.com" required>
                  </div>
                </div>
              </div>
            </div>

            <!-- /.row-->
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="ccmonth">Celular</label>
                <input class="form-control" name="mobile" type="tel" placeholder="(11) 99999-9999"  pattern="([0-9]{2}) [0-9]{5}-[0-9]{4}" required> <span class="help-block">Format (99) 99999-9999</span>
              </div>
              <div class="form-group col-sm-6">
                <label for="ccyear">Data de Nascimento</label>
                <input class="form-control" name="birth_at" type="date" placeholder="date"><span class="help-block">Please enter a valid date</span>
              </div>
            </div>
            <!-- /.row-->
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Sexo</label>
                <div class="col-md-9 col-form-label">
                  <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" type="radio" value="m" name="sex" required>
                    <label class="form-check-label" for="m">Masculino</label>
                  </div>
                  <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" type="radio" value="f" name="sex" required>
                    <label class="form-check-label" for="f">Feminino</label>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header"><strong>Endereço</strong></div>
          <div class="card-body">
            <div class="form-group">
              <label for="street">Street</label>
              <input class="form-control" name="address" type="text" placeholder="Enter street name" required>
            </div>
            <div class="row">
              <div class="form-group col-sm-5">
                <label for="city">City</label>
                <input class="form-control" name="city" type="text" placeholder="Enter your city">
              </div>
              <div class="form-group col-sm-3">
              <label for="country">State</label>
              <input class="form-control" name="state" type="text" placeholder="State" placeholder="SP">
            </div>
              <div class="form-group col-sm-4">
                <label for="postal-code">Postal Code</label>
                <input class="form-control" name="cep" type="text" placeholder="Postal Code">
              </div>
            </div>
            <!-- /.row-->
            
            <div class="form-group">
              <label for="country">Country</label>
              <input class="form-control" name="country" type="text" placeholder="Country name" value="Brazil" disabled>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->
     
          <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
          </form>
          </div>
    </div>
    <!-- /.row-->
      <!-- /.col-->
    </div>
    <!-- /.row-->
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