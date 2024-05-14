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
              <form id="quickForm" method="post" action="{{@url('/admin/blog/update')}}" enctype="multipart/form-data">
                <div class="card-body">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{ $item->title }}" class="form-control" id="title" placeholder="Enter Title">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="title">Tags</label>
                    <select name="tag_id" class="form-control" id="tag_id">
                      <option value="" disabled>Select Tag</option>
                      @foreach($tags as $tag)
                        <option {{ $tag->id==$item->tag_id?'SELECTED':''}} value="{{$tag->id}}">{{$tag->tag}}</option>
                      @endforeach
                    </select>
                    @error('tag_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" placeholder="Description">{{ $item->description }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="summernote">Post</label>
                    <textarea name="post" id="summernote">{{ $item->post }}</textarea>
                    @error('post')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" {{ $item->is_featured?'checked':'' }} name="is_featured" class="custom-control-input" id="customSwitch1">
                      <label class="custom-control-label" for="customSwitch1">Is Featured</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mataTitle">Mata Title</label>
                    <input type="text" name="mataTitle"  value="{{ $item->mataTitle }}" class="form-control" id="mataTitle" placeholder="Enter Mata Title">
                    @error('mataTitle')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="mataDescription">Mata Description</label>
                    <input type="text" name="mataDescription" value="{{ $item->mataDescription }}" class="form-control" id="mataDescription" placeholder="Enter Mata Description">
                    @error('mataDescription')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="mataTags">Mata Tags</label>
                    <input type="text" name="mataTags" value="{{ $item->mataTags }}" class="form-control" id="mataTags" placeholder="Enter Mata Tags">
                    @error('mataTags')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group custom-img-hanlder">
                    <label class="img-hldr">
                          <div class="row-custom">
                            <img id="image-container1" class="img img-fluid" src="{{ $item->getFirstMediaUrl('images', 'thumb') }}"/>
                            <input class="invisible" type="file" accept="image/*" name="image" id="image-upload" /><br>
                          </div>
                          <button id="cancel-btn" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button>
                      </label>
                      <br>
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
      summernote: "Description is required",
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
