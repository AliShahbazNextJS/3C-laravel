@extends('layouts.admin.default')
@section('content')
@include('includes.admin.breadcrumb')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 margin-tb">
            <!-- <div class="pull-left">
                <h2>Edit Playlist</h2>
            </div> -->
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('appSettings.list') }}"> Back</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

 <form method="POST" action="{{ route('appSettings.update') }}">
 @csrf
 <input name="id" type="hidden" class="form-control" value="{{$data->id}}">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <label>Title:</label>
                <input name="skey" class="form-control" value="{{$data->skey}}">
            </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
                    <label>Select:</label>
                    <input name="sval" class="form-control" value="{{$data->sval}}">
                  </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
            <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </div>
    </div>
    </form>
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('includes.admin.footer')
  @include('includes.admin.scripts')
  @include('includes.admin.validationScript')
  @stop