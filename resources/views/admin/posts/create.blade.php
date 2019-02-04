@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добавить статью
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      {!!Form::open([
        'route'=>'posts.store',
        'files'=>'true'
      ])!!}
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Добавляем статью</h3>
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Название</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="{{old('title')}}" placeholder="">
            </div>
            
            <div class="form-group">
              <label for="exampleInputFile">Лицевая картинка</label>
              <input name="image" type="file" id="exampleInputFile">

              <p class="help-block">Какое-нибудь уведомление о форматах..</p>
            </div>
            <div class="form-group">
              <label>Категория</label>

              {{Form::select('category_id', 
                $categories, 
                null, 
                ['class' => 'form-control select2'])}}

            </div>
            <div class="form-group">
              <label>Теги</label>
              {{Form::select('tags[]', 
                $tags, 
                null, 
                ['class' => 'form-control select2','multiple'=>'multiple','data-placeholder'=>'Выберите теги','style'=>'width:100%'])}}
          
            </div>
            <!-- Date -->
            <div class="form-group">
              <label>Дата:</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input value="{{ old('date') }}" name="date" type="text" class="form-control pull-right" id="datepicker">
              </div>
              <!-- /.input group -->
            </div>

            <!-- checkbox -->
            <div class="form-group">
              <label>
                <input type="checkbox" class="minimal" name="is-featured">
              </label>
              <label>
                Рекомендовать
              </label>
            </div>

            <!-- checkbox -->
            <div class="form-group">
              <label>
                <input type="checkbox" class="minimal" name="status">
              </label>
              <label>
                Черновик
              </label>
            </div>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputEmail1">Описание</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control" name="content">{{ old('description') }}</textarea>
              </div>
            </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Полный текст</label>
              <textarea name="content" id="" cols="30" rows="10" class="form-control" name="content"></textarea>
            </div>
          </div>
      </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a href="{{route('posts.index')}}" class="btn btn-default">Назад</a>
          <button class="btn btn-success pull-right">Добавить</button>
        </div>
        <!-- /.box-footer-->
        @include('admin.errors')
      </div>
      <!-- /.box -->
      {!!Form::close()!!}

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection