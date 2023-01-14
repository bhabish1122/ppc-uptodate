@extends('web.main.app')
@push('seo_title') {{$page_title ? $page_title.' | ' : ''}}  @endpush
@push('css')
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li>{{ __('lang.important form')}}</li>
					<li class="active">{{$page_title}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>

	<div class="site-half mt-0 pt-0" data-aos="fade-up" data-aos-delay="200">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="no-gutters align-items-stretch">
						<table class="table table-hover table-striped table-bordered">
							<thead class="bg-dark text-light text-center">
								<tr>
									<td width="5%">Sn</td>
									<td class="text-left">{{ __('lang.title')}}</td>
									<td width="10%">{{ __('lang.download')}}</td>
									<td>{{ __('lang.remark')}}</td>
								</tr>
							</thead>
							<tbody class="text-center">
								@forelse ($data_list as $key=>$element)
								<tr>
									<td>{{$key+1}}</td>
									<td class="text-left">{{$element->title}}</td>
									<td class="text-danger">
										@php
										$excl_ext = array('xlsm','xlsx','xltx','xltm','xls','xlsxm');
										$doc_ext = array('doc','docx','dot','dotx');
										$ppt_ext = array('pptx','ppt');
										@endphp
										@if ($element->ext == 'pdf')
										<a href="{{URL::to('/')}}/files/importantform/{{$element->image_enc}}" target="_blank">
											<i class="fas fa-file-pdf fa-2x text-danger"></i> 
										</a>
										@endif
										<a href="{{URL::to('/')}}/files/importantform/{{$element->image_enc}}" download>
											@if (in_array($element->ext, $doc_ext))
											<i class="fas fa-file-word fa-2x text-primary"></i> 
											@endif
											@if (in_array($element->ext, $ppt_ext))
											<i class="fas fa-file-powerpoint fa-2x text-warning"></i> 
											@endif
											@if (in_array($element->ext, $excl_ext))
											<i class="fas fa-file-excel fa-2x text-success"></i> 
											@endif
										</a>
									</td>
									<td>{!! $element->remark !!}</td>
								</tr>
								@empty
								<tr>
									<td colspan="4">Update Coming Soon</td>
								</tr>
								@endforelse
							</tbody>
						</table>
						<div class="d-flex justify-content-center">
							{{$data_list->render("pagination::bootstrap-4")}}
						</div>
					</div>
				</div>
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
                  {"name": "4", orderable: false },
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