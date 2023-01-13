<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @stack('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    @include('admin.main.header')
    @include('admin.main.sidebar')
    <div class="content-wrapper">
      @yield('content')
    </div>
    @include('admin.main.footer')

    @include('admin.main.right-sidebar')
  </div>
  <script src="{{asset('js/app.js')}}"></script>
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
      case 'info':
      toastr.info("{{ Session::get('message') }}");
      break;
      case 'warning':
      toastr.warning("{{ Session::get('message') }}");
      break;
      case 'success':
      toastr.success("{{ Session::get('message') }}");
      break;
      case 'error':
      toastr.error("{{ Session::get('message') }}");
      break;
    }
    @endif
  </script>
<script>
  $(document).ready(function (e) {
    $('#imgInp').change(function(){            
      let reader = new FileReader(); 
      reader.onload = (e) => {  
        $('#blah').attr('src', e.target.result); 
      } 
      reader.readAsDataURL(this.files[0]);    
    });   
  });
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '.ckeditors' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
  function confirmDelete(e) {
    e.preventDefault();
    var url =  e.srcElement.dataset.url;
    var token = `{{ csrf_token() }}`;
    Swal.fire({
      title: 'Are you sure?',
      text: 'This record and it`s details will be permanantly deleted!',
      icon: 'warning',
      dangerMode: true,
      closeOnClickOutside: false,
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function(value) {
      if(value.isConfirmed){
        $.ajax({
          url: url,
          type: "POST",
          data: {
            _token: token,
            '_method': 'DELETE',
          },
          success: function (data) {
            Swal.fire({
              title: "Success!",
              text: data.message+"\n Click OK",
              icon: "success",
              showConfirmButton: false,
            }).then(location.reload(true));
            
          },
          error: function (data) {
            Swal.fire({
              title: 'Opps...',
              text: data.message+"\n Please refresh your page",
              type: 'error',
              timer: '1500'
            });
          }
        });
      }else{
        Swal.fire({
          title: 'Cancel',
          text: "Data is safe.",
          icon: "success",
          type: 'info',
          timer: '1500'
        });
      }
    });
  };
</script>
  @stack('javascript')
</body>
</html>
