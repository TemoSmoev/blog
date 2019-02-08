@extends('admin.layout')

@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Добавить подписчика
            <small>приятные слова..</small>
          </h1>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Добавляем подписчика</h3>
            </div>
            {{ Form::open(['route'=>'subscribers.store','method'=>'post']) }}

                <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input name="email" type="text" class="form-control" id="exampleInputEmail1" placeholder="{{old('email')}}">
                    </div>
                </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    
                        <a href="{{route('subscribers.index')}}" class="btn btn-default">Назад</a>
                        <button class="btn btn-success pull-right">Добавить</button>               
                </div>

            {{ Form::close() }}
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection