@extends('web.main.app')
@push('seo_title') {{ $page_title }} |  @endpush
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" type="text/css" />
@endpush
@section('content')
  <div class="container">
    <div class="horizontal">
      <div class="verticals ten offset-by-one">
        <ol class="breadcrumb breadcrumb-fill2 style4">
          <li><a href="{{route('web.welcome')}}"><i class="fa fa-home"></i></a></li>
          <li class="active">{{ $page_title }}</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="clearfix mb-3"></div>

  <div class="site-section pt-0" data-aos="fade-up">
    <div class="container">
      <div class="table-responsive" id="printTable">
        <table class="table table-hover table-striped table-bordered" >
          <thead>
            <tr class="bg-dark text-light text-center align-middle">
              <th width="5%">{{ __('lang.sn')}}</th>
              <th width="10%">{{ __('lang.office') }}</th>
              <th>{{ __('lang.address') }}</th>
              <th>{{ __('lang.designation') }}</th>
              <th>{{ __('lang.name') }}</th>
              <th>{{ __('lang.contact_no') }}</th>
              <th>{{ __('lang.email') }}</th>
              <th width="5%"></th>
            </tr>
          </thead>
          <tbody>
            @forelse($data_lists as $key=>$element)
            <tr class="text-center align-middle">
              <td>{{$key+1}}</td>
              <td>{{ $element->office }}</td>
              <td>{{ $element->address }}</td>
              <td>{{ $element->designation }}</td>
              <td>{{ $element->name }}</td>
              <td>{{ $element->contact_no }}</td>
              <td>{{ $element->email }}</td>
              <td><a href="{{ route('web.about.office.show',[$element->id]) }}" class="btn btn-sm btn-outline-danger"><i class="fas fa-link"></i></a></td>
            </tr>
            @empty
            @endforelse
          </tbody>
        </table> 
      </div>
    </div>
  </div>
@endsection
@push('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('table').DataTable({
      columns: [
                  {"name": "1", orderable: true },
                  {"name": "2", orderable: true },
                  {"name": "3", orderable: true },
                  {"name": "4", orderable: true },
                  {"name": "5", orderable: true },
                  {"name": "6", orderable: true },
                  {"name": "7", orderable: true },
                  {"name": "8", orderable: false },
                ],
      dom: '<"class"B><"d-flex justify-content-between mt-2"lf>tipr',
        buttons: [
            { 
              extend: 'excel', 
              text: 'Excel',
              className: "btn btn-sm btn-success text-white",
              charset: "utf-8",
              bom: "true",
            },
            /*{ 
              extend: 'pdfHtml5', 
              text: 'PDF',
              className: "btn btn-sm btn-danger",
              charset: "utf-8",
              bom: "true",
            },*/
            { 
              extend: 'print', 
              text: 'Print',
              className: "btn btn-sm btn-dark",
              charset: "utf-8",
            }
        ]
    });
  });
</script>
@endpush