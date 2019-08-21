@extends('Layout.mainlayout')
@section('content')
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" type="text/javascript"></script> --}}
<script src="{{ URL::asset('public/template/js/sweetalert.min.js') }}"></script>
<link href="{{asset('public/template/table/tab.css')}}" rel="stylesheet" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}" /> 







<div class="card" id="tab" >
      
    <div class="card-header card-header-primary card-header-icon">
          {{--   @if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug =='master')
            <a class="nav-link float-right" href="#" data-toggle="modal" data-backdrop="static"
            data-keyboard="false" data-target="#add"style=" text-shadow: 2px 2px 5px #7986cb;">
                <i class="material-icons " style="padding-left: 30%;" href="#">games</i>
                <p><b>ADD MPOS </b> </p>
            </a> @endif
           --}}
        <div class="card-icon test">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title"><b> MPOS LIST</b></h4>
    </div>
    <div class="card-body" >
        
            
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label><span class="bmd-form-group bmd-form-group-sm">
                         
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="datatab2"  class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
                        cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                            <thead style="background-color:powderblue;font-family:verdana;">
                                <tr role="row">
                                        <th tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-sort="ascending" aria-label="DAY: activate to sort column descending" ><p><b>ID</b>  </p> 
                                    </th>
                                    <th tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-sort="ascending" aria-label="DAY: activate to sort column descending" ><p><b>NAME</b>  </p> 
                                    </th>
                                    <th  tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="Product: activate to sort column ascending"><p><b>DISCRIPTION</b> </p></th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending"><p><b>CREATED-ON</b> </p>
                                        </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending"><p><b>OG-URL</b> </p></th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending"><p><b>Actions</b> </p></th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Id</th>
                                    <th rowspan="1" colspan="1">Name</th>
                                    <th rowspan="1" colspan="1">Discription</th>
                                    <th rowspan="1" colspan="1">Position</th>
                                    <th rowspan="1" colspan="1">OG-URL</th>
                                    <th  rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>   
                                
                                @foreach ($mpos_product as $item)
                               
                                <tr role="row" class="odd">
                                
                                        
                                 
                                <td tabindex="0" class="sorting_1"><span style="color:#ff3300;font-weight:bold">{{$item->id}}</span></td>
                                    <td tabindex="0" class="sorting_1">dfgdfgdf</td>
                                    <td>dfgdfgdfgdf</td>
                                    <td><span >dfcdsfsdfsdfsdfds</span></span></td>   
                                  
                                    <td>
                                       <span  style="color:#6495ED; ">hello</span> 
                                    </td>
                                    <td>
                                        <a href="/Vmpos/" class="btn btn-link btn-danger btn-just-icon edit"><i
                                                class="material-icons" title="location details">launch</i></a>
                                        <a href="/update/" class="btn btn-link btn-success btn-just-icon edit"><i
                                                class="material-icons" title="Update Mpos">border_color</i></a>
                                       {{--  <a href="/camp/{{$newM->id}}" class="btn btn-link btn-warning btn-just-icon edit"><i
                                                class="material-icons" title="Check Campaign">check_circle</i></a> --}}
                                        <a href="/order/" class="btn btn-link btn-info btn-just-icon edit"><i
                                                class="material-icons" title="Check Order">local_shipping</i></a>
                                        <a href="/updatelocation/" class="btn btn-link btn-warning btn-just-icon edit"><i
                                                class="material-icons" title="update location">update location</i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#datatab2").DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }
                });

            });

        </script>
</div>



































@endsection