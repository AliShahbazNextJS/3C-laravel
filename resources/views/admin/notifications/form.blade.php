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
              <form id="quickForm" method="post" action="{{@url('/meeting/store-participent')}}" enctype="multipart/form-data">
                <div class="card-body">
                @csrf
                <input type="hidden" name="meeting_id" value="{{request()->segment(2)}}">
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" id="first_name" placeholder="Enter First Name">
                    @error('first_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" id="last_name" placeholder="Enter Last Name">
                    @error('last_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Enter Email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="Enter Phone">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="submit">
                </div>
              </form>
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
<link rel="stylesheet" href="{{@url('admin/plugins/summernote/summernote-bs4.min.css')}}">
 

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
      title: {
        required: true,
        minlength: 5
      },
      description: {
        required: true,
        minlength: 30
      },
      summernote: {
        required: true
      },
      tag_id: {
        required: true
      },
      image: {
            required: true,
            extension: "jpg|jpeg|png"
        }
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      image: {
            required: "Please upload file.",
            extension: "Please upload file in these format only (jpg, jpeg, png)."
        },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      summernote: "Description is required",
      tag_id: "Please select a tag",
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
