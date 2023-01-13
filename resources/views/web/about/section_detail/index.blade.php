@extends('web.main.app')
@push('seo_title') {{ __('lang.section_detail')}} |  @endpush
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
          <li><a href="#">{{ __('lang.about')}}</a></li>
          <li class="active">{{ __('lang.section_detail')}}</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="clearfix mb-3"></div>

  <div class="site-section pt-0" data-aos="fade-up">
    <div class="container">
      <div class="table-responsive" id="printTable">
        <table class="table table-hover table-striped table-bordered">
          <thead class="bg-dark text-light text-center">
            <tr>
              <th width="5%">{{ __('lang.sn') }}</th>
              <th width="10%">{{ __('lang.photo') }}</th>
              <th>{{ __('lang.full_name') }}</th>
              <th>{{ __('lang.designation') }}</th>
              <th>{{ __('lang.department') }}</th>
              <th>{{ __('lang.contact') }}</th>
              <th>{{ __('lang.email') }}</th>
            </tr>
          </thead>
          <tbody class="text-center">
            {{-- put model box for on click btn --}}
            @forelse($sectiondetails as $key=>$sectiondetail)
            <tr>
              <td class=" align-middle">{{$key+1}}</td>
              <td class=" align-middle">
                <a href="{{ route('web.about.list-of-director-generals.show',$sectiondetail->id) }}" class="text-hover-a">
                <img src="{{ url($sectiondetail->image_enc ? 'image/core_person/'.$sectiondetail->image_enc : 'image/noimage.png') }}" class="img-fluid" alt="{{ $sectiondetail->title }}">
              </a>
              </td>
              <td class="align-middle">
                <a href="{{ route('web.about.list-of-director-generals.show',$sectiondetail->id) }}" class="text-hover-a">
                {{ $sectiondetail->name }}
              </a>
            </td>
              <td class=" align-middle">{{ $sectiondetail->designation }}</td>
              <td class=" align-middle">{{ $sectiondetail->department }}</td>
              <td class=" align-middle">{{ $sectiondetail->phone }}</td>
              <td class=" align-middle">{{ $sectiondetail->email }}</td>
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
                  {"name": "1", orderable: false },
                  {"name": "2", orderable: false },
                  {"name": "3", orderable: false },
                  {"name": "3", orderable: false },
                  {"name": "4", orderable: false },
                  {"name": "5", orderable: false },
                  {"name": "6", orderable: false },
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