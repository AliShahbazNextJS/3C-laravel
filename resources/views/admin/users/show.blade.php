@extends('layouts.admin.default')
@section('content')
@include('includes.admin.breadcrumb')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
                <div class="col-lg-12 margin-tb">
                    <!-- <div class="pull-left">
                        <h2> Show User</h2>
                    </div> -->
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"> Back</a>
                        @can('approve-user')
                            @if($user->is_approved=='on')
                                <a class="btn btn-sm btn-primary" href="{{ route('users.unapprove',$user->id) }}">Approved</i></a>
                            @elseif($user->is_approved=='ban')
                                <a class="btn btn-sm btn-danger" href="{{ route('users.unapprove',$user->id) }}">Rejected</i></a>
                            @else
                                <a class="btn btn-sm btn-primary" href="{{ route('users.approve',$user->id) }}">Approve</i></a>
                                <a class="btn btn-sm btn-danger" href="{{ route('users.unapprove',$user->id) }}">Reject</a>
                            @endif
                        @endcan
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Roles:</strong>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('includes.admin.footer')
  @include('includes.admin.scripts')
  @stop