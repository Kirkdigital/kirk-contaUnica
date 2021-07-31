@extends('dashboard.base')

@section('content')

<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-header"><strong>Dados do grupo</strong> <small>Pessoa responsável</small></div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="name">Nome</label>
                            <input class="form-control" id="name" type="text" placeholder="Nome do grupo">
                          </div>
                        </div>
                      </div>
                      <!-- /.row-->
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="ccnumber">Instituição</label>
                            <select class="form-control" id="select1" name="select1">
                              <option value="0">Please select</option>
                              <option value="1">Option #1</option>
                              <option value="2">Option #2</option>
                              <option value="3">Option #3</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- /.row-->
                      <div class="row">
                        <div class="form-group col-sm-5">
                          <label for="ccmonth">Tipo</label>
                          <select class="form-control" id="ccmonth">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-7">
                          <label for="ccyear">Responsável</label>
                          <select class="form-control" id="ccyear">
                            <option>2014</option>
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                            <option>2024</option>
                            <option>2025</option>
                          </select>
                        </div>
                      </div>

                    </div>                    
                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary" type="submit"> Salvar</button>
                      <button class="btn btn-sm btn-danger" type="reset"> Excluir</button>
                    </div>
                  </div>
                                        <!-- /.row-->
                  </div>  
                  <div class="col-md-6">
                  <div class="card">
                    <div class="card-header"><strong>Buscar Pessoa</strong></div>
                    <div class="card-body">
                      <form class="form-horizontal" action="" method="post">
                        <div class="form-group row">
                          <div class="col-md-12">
                          <select class="form-control" id="select1" name="select1">
                              <option value="0">Please select</option>
                              <option value="1">Option #1</option>
                              <option value="2">Option #2</option>
                              <option value="3">Option #3</option>
                            </select>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary" type="submit"> Adicionar</button>
                    </div>
                  </div> </div></div>
                <!-- /.col-->
                <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i>Pessoas nesse grupo</div>
                    <div class="card-body">
                      <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Pessoa</th>
                            <th>Date registered</th>
                            <th>Celular</th>
                            <th>Ação</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Vishnu Serghei</td>
                            <td>2012/01/01</td>
                            <td>(92) 99999-9999</td>
                            <td><span class="badge badge-success">Active</span></td>
                          </tr>
                          <tr>
                            <td>Zbyněk Phoibos</td>
                            <td>2012/02/01</td>
                            <td>(92) 99999-9999</td>
                            <td><span class="badge badge-danger">Banned</span></td>
                          </tr>
                          <tr>
                            <td>Einar Randall</td>
                            <td>2012/02/01</td>
                            <td>(92) 99999-9999</td>
                            <td><span class="badge badge-secondary">Inactive</span></td>
                          </tr>
                          <tr>
                            <td>Félix Troels</td>
                            <td>2012/03/01</td>
                            <td>(92) 99999-9999</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                          </tr>
                          <tr>
                            <td>Aulus Agmundr</td>
                            <td>2012/01/21</td>
                            <td>(92) 99999-9999</td>
                            <td><span class="badge badge-success">Active</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.col-->
              </div>
              <!-- /.row-->
            </div>
          </div>


@endsection

@section('javascript')

@endsection