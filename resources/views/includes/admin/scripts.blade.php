
<!-- jQuery -->
<script src="{{url('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- toastr -->
<script src="{{url('admin/plugins/toastr/toastr.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('admin/dist/js/pages/dashboard.js')}}"></script>
<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script>
  function DeleteMe(btn, url){
    var tr = $(btn).closest('tr');
    Swal.fire({
      title: "Once removed, Can't be recovered?",
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: `Confirm`,
      denyButtonText: `Cancel`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.get(url, function(resp){
          if(resp=='ok'){
            $(tr).hide();
            // $(tr).remove().draw( false );
            $(tr).remove();
            // Swal.fire('Deleted!', '', 'success')
            addToast('success', 'Deleted !', '<div style="width:250px;">Data deleted successfuly</div>'); // class, title, body
          }else{
            addToast('warning', 'Error !', '<div style="width:250px;">Something went wrong, try again!</div>'); // class, title, body
            // Swal.fire('Something went wrong, try again!', '', 'warning')
          }
        })
      }
    })
  }
  function addToast(className, title, body){
    $(document).Toasts('create', {
      class: 'bg-'+className,
      title: title,
      autohide: true,
      delay: 2000,
      width:500,
      // position: 'topRight',
      // subtitle: 'Subtitle',
      body: body
    })
  }

  $(function () {

    // function setEndDateTime(){
    // Get references to the start and end date-time input fields
    var startDateTime = document.getElementById("start");
    var endDateTime = document.getElementById("end");

    // Add a change event listener to the startDateTime input
    startDateTime.addEventListener("change", function () {
      // Get the selected start date and time as a JavaScript Date object
      var startDate = new Date(startDateTime.value);

      // Calculate the maximum allowed end date and time (30 hours later)
      var maxEndDate = new Date(startDate.getTime() + 30 * 60 * 60 * 1000);
      // var minEndDate = new Date(startDate.getTime());

      // Format the maxEndDate to match the input's format (YYYY-MM-DDTHH:MM)
      var maxEndDateString = maxEndDate.toISOString().slice(0, 16);
      // var minEndDateString = minEndDate.toISOString().slice(0, 16);

      // Set the max attribute of the endDateTime input
      endDateTime.setAttribute("max", maxEndDateString);
      // endDateTime.setAttribute("min", minEndDateString);
      endDateTime.setAttribute("min", startDateTime.value);
    });
  });
      
</script>

  <!-- ******For Message Notifictions******* -->

<?php /* <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
<script >
    // Gloabl Chatify variables from PHP to JS
    window.chatify = {
        name: "{{ config('chatify.name') }}",
        sounds: {!! json_encode(config('chatify.sounds')) !!},
        allowedImages: {!! json_encode(config('chatify.attachments.allowed_images')) !!},
        allowedFiles: {!! json_encode(config('chatify.attachments.allowed_files')) !!},
        maxUploadSize: {{ Chatify::getMaxUploadSize() }},
        pusher: {!! json_encode(config('chatify.pusher')) !!},
        pusherAuthEndpoint: '{{route("pusher.auth")}}'
    };
    window.chatify.allAllowedExtensions = chatify.allowedImages.concat(chatify.allowedFiles);
</script>
<script src="{{ asset('js/chatify/utils.js') }}"></script>
<script src="{{ asset('js/chatify/code.js') }}"></script> */ ?>
  <!-- ******For Message Notifictions******* -->
  @if (session('success'))
            <script>addToast('success', 'Success', '<div style="width:250px;">{{ session("success") }}</div>')</script>
  @endif
