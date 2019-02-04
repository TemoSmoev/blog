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
          {!!Form::open(['route'=>['users.update',$user->id],'files'=>'true','method'=>'put'])!!}
        <div class="box-header with-border">
          <h3 class="box-title">Добавляем пользователя</h3>
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Имя</label>
              <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ $user->name }}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">E-mail</label>
              <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ $user->email }}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Пароль</label>
              <input name="password" type="password" class="form-control" id="exampleInputEmail1" placeholder="">
            </div>
            <div class="form-group">
              <img src="{{$user->getImage()}}" alt="" width="200" class="img-responsive">
              <label for="exampleInputFile">Аватар</label>
              <input name="avatar" type="file" id="exampleInputFile">

              <p class="help-block">Какое-нибудь уведомление о форматах..</p>
            </div>
        </div>
      </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="{{route('users.index')}}" class="btn btn-default">Назад</a>
          <button class="btn btn-warning pull-right">Изменить</button>
        </div>
        <!-- /.box-footer-->
        {!!Form::close()!!}
      </div>
      <!-- /.box -->
      @include('admin.errors')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection