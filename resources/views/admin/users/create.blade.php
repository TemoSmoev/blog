@extends('admin.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добавить пользователя
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        {!!Form::open(['route'=>['users.store'],'files'=>'true'])!!} 

          <div class="box-header with-border">
            <h3 class="box-title">Добавляем пользователя</h3>
          </div>
          <div class="box-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Имя</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ old('name') }}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">E-mail</label>
                <input name="email" type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ old('email') }}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Пароль</label>
                <input name="password" type="password" class="form-control" id="exampleInputEmail1" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Аватар</label>
                <input name="avatar" type="file" id="exampleInputFile">

                <p class="help-block">Какое-нибудь уведомление о форматах..</p>
              </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a class="{{ route('users.index') }}">Назад</a>
          <button class="btn btn-success pull-right">Добавить</button>
        </div>

        {!!Form::close()!!}
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      @include('admin.errors')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

    
@endsection