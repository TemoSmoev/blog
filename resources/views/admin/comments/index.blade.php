@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              @if (session('status'))
                  <div class="alert alert-success">
                    {{ session('status') }}
                  </div>
              @endif
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Текст</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($comments as $comment)
                  <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{$comment->text}}</td>
                    @if ($comment->status==0)
                      <td><a href="/admin/comments/toggle/{{ $comment->id }}" class="fa fa-thumbs-o-up"></a>
                    @else
                      <td><a href="/admin/comments/toggle/{{ $comment->id }}" class="fa fa-lock"></a>
                    @endif
                    {!!Form::open(['route'=>['comments.destroy',$comment->id],'method'=>'delete'])!!}   
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                          <i class="fa fa-remove"></i>
                      </button>
                    {!!Form::close()!!}</td>
                  </tr>
                @endforeach
               
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection