@extends('layouts.admin.default')
@section('content')
@include('includes.admin.breadcrumb')
   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{@$pageTitle}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(Auth::user()->hasRole('Admin'))
              <form id="quickForm" method="post" action="{{ route('app-settings-update')}}" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="title">System Title</label>
                        <input type="title" name="title"  value="{{ $item->title }}" class="form-control" id="title" placeholder="System title">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email"  value="{{ $item->email }}" class="form-control" id="email" placeholder="System EMail">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="phone">Phone No.</label>
                        <input type="phone" name="phone"  value="{{ $item->phone }}" class="form-control" id="phone" placeholder="System phone">
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="address">Address</label>
                        <input type="address" name="address"  value="{{ $item->address }}" class="form-control" id="address" placeholder="System address">
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" class="form-control" id="logo">
                        @error('logo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                   
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="logo" class="invisible">Logo</label><br>
                        <img src="{{ $item->getFirstMediaUrl('logo', 'thumb') }}" style="width:100px; background-color: gainsboro; padding: 5px;" class="img img-fluid">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="submit">
                </div>
              </form>
              @else
              <form id="quickForm" method="post" action="{{ route('zoom-settings-update')}}" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="zoomAccountId">Zoom Client Account Id</label>
                        <input type="text" name="zoomAccountId"  value="{{ $item->zoomAccountId }}" class="form-control" id="zoomAccountId" placeholder="Zoom Client Id">
                        @error('zoomAccountId')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="zoomClientId">Zoom Client Id</label>
                        <input type="text" name="zoomClientId"  value="{{ $item->zoomClientId }}" class="form-control" id="zoomClientId" placeholder="Zoom Client Id">
                        @error('zoomClientId')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="zoomClientSecret">Zoom Client Secret</label>
                        <input type="text" name="zoomClientSecret"  value="{{ $item->zoomClientSecret }}" class="form-control" id="zoomClientSecret" placeholder="Zoom Client Secret">
                        @error('zoomClientSecret')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        
                      </div>
                    </div>
                  </div>
                  

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="submit">
                </div>
              </form>
              @endif
            </div>
            <!-- /.card -->
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  @include('includes.admin.footer')
  @include('includes.admin.scripts')
  @include('includes.admin.validationScript')
  <!-- Summernote -->
<script src="{{@url('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
<link rel="stylesheet" href="{{@url('admin/plugins/summernote/summernote-bs4.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css">
 

  <script>
$(function () {
  $('#summernote').summernote({height: 300})

  $.validator.setDefaults({
    submitHandler: function () {
      $('#quickForm').submit();    
      // alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      body: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      body: "Description is required",
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});


$(function(){
    $("#image-upload").on("change",function(){
          /* Current this object refer to input element */ 			
          var $input = $(this);
          var reader = new FileReader();
          reader.onload = function(){
            $("#image-container1").attr("src", reader.result);
          }
          reader.readAsDataURL($input[0].files[0]);
        }
                             );
        /* This function will call when upload button clicked */ 		
        $("#upload-btn").on("click",function(){
          /* file validation logic goes here if required */      
          /* image uploading logic goes here */
          alert("Upload logic need to be write here...");
        }
                           );
        /* This function will call when cancel button clicked */ 		
        $("#cancel-btn").on("click",function(){
          /* Reset input element */
          $('#image-upload').val("");
          /* Clear image preview container */
          $('#image-container').attr("src","");
        }
                           );
})
</script>
  
@stop
