@extends('Layout.mainlayout')
@section('content')
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link href="{{asset('public/template/toggle.css')}}" rel="stylesheet" type="text/css">
<style>
</style>
<div class="card">
    <div class="card-header card-header-primary card-header-icon">
            @if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug =='client')
            <script type="text/javascript">
                window.location = "{{ url('/home') }}";
             </script>
             @endif
        <div class="card-icon">
            <i class="material-icons">supervised_user_circle</i>
            
        </div>
         
        <h4 class="card-title"><b>User -List</b> </h4>
        
    </div>
    
    <div class="card-body">
           
        <div class="toolbar">
        
        </div>
        <div class="material-datatables">
            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row"> 
                    <div class="col-sm-12 col-md-6">  
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline col-sm-12 col-md-6"
                            cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                            <thead style="background-color:powderblue;font-family:verdana;">
                                <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-sort="ascending" aria-label="DAY: activate to sort column descending">ID
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-sort="ascending" aria-label="DAY: activate to sort column descending">NAME
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="Product: activate to sort column ascending">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="Product: activate to sort column ascending">Role</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">Activated - ON
                                         </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">Status
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">Last - Login</th> 

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_details as $newM)
                                <tr role="row" class="odd">
                                        <td tabindex="0" class="sorting_1"><span style="color:#ff3300;font-weight:bold">{{$newM->id}}</span></td>
                                    <td tabindex="0" class="sorting_1"><span style="color:#6495ED;font-weight:bold">{{$newM->first_name}}</span></td>
                                    <td><span style="color:#6495ED;font-weight:bold">{{$newM->email}}</span></td>
                                    @foreach ($newM->user_role as $role)
                                    @if ($role->role_id == 1)
                                    <td><span style="color:#5F9EA0;font-weight:bold">Admin</span></td>
                                    @elseif($role->role_id == 2)
                                    <td><span style="color:#008000;font-weight:bold">Client</span></td>
                                    @elseif($role->role_id == 3)
                                    <td><span style="color:#6495ED;font-weight:bold ">Master</span></td>
                                    @endif
                                  
                                    @endforeach
                                



                                    @foreach ($newM->user_activation as $activation)
                                    <td><span ><span style="color:#6495ED;font-weight:bold " >{{date('d F, Y', strtotime($activation->completed_at))}}</span> <br><span style="color:#009900;font-weight:bold ">{{Carbon\Carbon::parse($activation->completed_at)->diffForHumans()}}</span></span></td>   
                                    <td><span >@if ($activation->completed == 1)
                                        <span style="color:#008000; font-weight:bold">Active</span>
                                        
                                    @else
                                    <span>DEACTIVATE</span>
                                    @endif</span></td>   
                                    <td><span ><span style="color:#6495ED;font-weight:bold " >{{date('d F, Y', strtotime($newM->last_login))}}</span> <br><span style="color:#009900;font-weight:bold ">{{Carbon\Carbon::parse($newM->last_login)->diffForHumans()}}</span></span></td>   
                                    @endforeach
                                  
                            
                                   
                                </tr>
                                @endforeach
                              
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



        <script>
            $(document).ready(function () {
                $('#datatables').DataTable({
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
        {{-- <script>
            $('.openM').on('click', function () {
        
                $('#campMO').modal('show')
        
                $("#prodeuct_name").val($(this).closest('tr').children()[1].textContent); // Find the text
                $("#getmopos").val($(this).closest('tr').children()[0].textContent);
                $("#issueid").val($(this).closest('tr').children()[1].textContent);
                $("#age").val($(this).closest('tr').children()[3].textContent);
                $("#sex").val($(this).closest('tr').children()[4].textContent);
            });
        
        </script> --}}
    </div>

    <script src="{{ URL::asset('public/template/js/bootstrap-datetimepicker.min.js') }}"></script>

    @endsection
