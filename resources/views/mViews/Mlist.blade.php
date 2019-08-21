@extends('Layout.mainlayout')
<title itemprop="name">HOME</title>
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@if(session('empty'))
<script>
    $(function () {
        swal("", "MPOS  Location Empty", "success");
    });
</script>
@endif
@if(session('norder'))
<script>
    $(function () {

        swal("", "NO ORDER FOR MPOS ", "success");
    });
</script>
@endif
@if(session('error'))
<script>
    $(function () {
        swal("", "EMPTY Campaing ", "success");
    });
</script>
@endif
@if(session('inactive'))
<script>
    $(function () {
        swal("", "MPOS INACTIVE ", "error");
    });
</script>
@endif

<div class="card" id="tab" >
      
    <div class="card-header card-header-primary card-header-icon">
            @if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug =='master')
            <a class="nav-link float-right" href="#" data-toggle="modal" data-backdrop="static"
            data-keyboard="false" data-target="#add"style=" text-shadow: 2px 2px 5px #7986cb;">
                <i class="material-icons " style="padding-left: 30%;" href="#">games</i>
                <p><b>ADD MPOS </b> </p>
            </a> @endif
          
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
                                @foreach ($mpos as $newM)
                                <tr role="row" class="odd">
                                        <td tabindex="0" class="sorting_1"><span style="color:#ff3300;font-weight:bold">{{$newM->id}} </span></td>
                                    <td tabindex="0" class="sorting_1">{{$newM->name}}</td>
                                    <td>{{$newM->discription}}</td>
                                    <td><span ><span style="color:#6495ED; " >{{date('d F, Y', strtotime($newM->created_at))}}</span> <br><span style="color:#009900; ">{{Carbon\Carbon::parse($newM->created_at)->diffForHumans()}}</span></span></td>   
                                  
                                    <td>
                                       <span  style="color:#6495ED; ">{{ $newM->OGURL}}</span> 
                                    </td>
                                    <td>
                                        <a href="/Vmpos/{{$newM->id}}" class="btn btn-link btn-info btn-just-icon edit"><i
                                                class="material-icons" title="location details">pageview</i></a>
                                        <a href="/update/{{$newM->id}}" class="btn btn-link btn-success btn-just-icon edit"><i
                                                class="material-icons" title="Update Mpos">border_color</i></a>
                                       {{--  <a href="/camp/{{$newM->id}}" class="btn btn-link btn-warning btn-just-icon edit"><i
                                                class="material-icons" title="Check Campaign">check_circle</i></a> --}}
                                        <a href="/order/{{$newM->id}}" class="btn btn-link btn-dark btn-just-icon edit"><i
                                                class="material-icons" title="Check Order">local_shipping</i></a>
                                     {{--    <a href="/updatelocation/{{$newM->id}}" class="btn btn-link btn-warning btn-just-icon edit"><i
                                                class="material-icons" title="update location">update location</i></a>
                                                <a href="/product_limit/{{$newM->id}}" class="btn btn-link btn-primary btn-just-icon edit"><i
                                                    class="material-icons" title="product Limit">swap_horizontal_circle</i></a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-notify modal-success " role="document">

                        <div class="modal-content container-fluid">

                            <div class="modal-header card-header-primary ">
                                <p class="heading lead">ADD MPOS</p>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="white-text">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="addmpos" method="POST">
                                    {!! csrf_field() !!}
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">NAME</label>
                                                <input type="text" name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Discription</label>
                                                <input type="text" name="discription" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">OG-URL</label>
                                                <input type="text" name="URLog" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">OG-API USER</label>
                                                <input type="text" name="userapi" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">OG-API PASSWORD</label>
                                                <input type="text" name="apipass" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-success">ADD </button>
                                        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
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
