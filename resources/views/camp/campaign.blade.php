@extends('Layout.mainlayout')
@section('content')
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>
<script src="{{ URL::asset('public/template/js/sweetalert.min.js') }}"></script>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header  btn-success ">
                <h4 class="card-title ">Active Campaign
                    <small class="description">DETAILS</small>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>{{$detailsM->id}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>NAME</td>
                                <td></td>
                                <th>{{$detailsM->name}}</th>
                            </tr>
                            <tr>
                                <td>PRICE</td>
                                <td></td>
                                <th>{{$detailsM->price}}</th>
                            </tr>
                            <tr>
                                <td>PRODUCT</td>
                                <td></td>
                                @if (!empty($product_name))
                                <th>{{$product_name->name}}</th>
                                @else
                                <th>Not Defined</th>
                                @endif
                               
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td></td>
                                <th>{{$detailsM->quantity}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header card-header-primary card-header-icon">

            <div id="datatables_filter" class="dataTables_filter">
                    @if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug !='Client')
                    <a class="nav-link float-right" href="#" data-toggle="modal" data-backdrop="static"
                    data-keyboard="false" data-target="#campMO" style=" text-shadow: 2px 2px 5px #7986cb;">
        
                        <i class="material-icons " style="padding-left: 30%;" href="#">games</i>
                        <p>Set Campaign</p>
                    </a> @endif
                  
                </div>
        <div class="card-icon">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title">MPOS Campaign List</h4>
    </div>
    <div class="card-body">
        <div class="toolbar">
           <!--        Here you can write extra buttons/actions for the toolbar              -->
        </div>
        <div class="material-datatables">
            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="datatab2" class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
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
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">STARTING-DATE</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">ENDING-DATE</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">MPOS-NAME</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">STATUS</th>
                                   {{--  <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                    style="width: 450px;" aria-sort="ascending" aria-label="DAY: activate to sort column descending">ACTION
                                </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($camp as $newM)
                                @foreach ($newM->camp_status as $campStatus)


                                <tr role="row" class="odd">
                                    <td><span style="font-weight:bold">{{$newM->id}} </span></td>
                                <td><span style="color:black;font-weight:bold">{{ $newM->name}}</span></td>
                                  
                                     <td><span style="color:blue;font-weight:bold">{{ $campStatus->start_date}} </span></td>
                                     <td> <span style="color:#ff3300;font-weight:bold" > {{ $campStatus->end_date}} </span></td>
                                     <td><span style="font-weight:bold">{{ $campStatus->camp_mpos_name}}</span> </td>
                                   
                                  {{--   <td>
                                        <a href="/Vmpos/{{$campStatus->mpos_id}}" class="btn btn-link btn-danger btn-just-icon edit"><i
                                                class="material-icons" data-toggle="tooltip" title="MPOS">launch</i></a>
                                                <a id="openM" class="btn btn-link btn-info btn-just-icon edit openM"><i
                                                    class="material-icons" title="Check Campaign">pageview</i></a>
    
                                    </td> --}}
                                    
                                    <td> @if ($campStatus->status == 1)
                                            <span style="color:green;font-weight:bold">Active</span>
                                            @elseif($campStatus->status == 0)
                                            <span style="color:red;font-weight:bold">In-Active</span>
                                        
                                    @endif
                                </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end content-->

</div>
<div class="modal show" id="campMO" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success " role="document">
        <!--Content-->
        <div class="modal-content container-fluid">
            <!--Header-->
            <div class="modal-header card-header-primary btn-success">
                <p class="heading lead" id="head">Set Campaign</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <form action="/setcamp" method="POST">
                    {!! csrf_field() !!}
                    @if(session('sucess'))
                    <script>
                        $(function () {

                        swal("", "Campaign Set", "success");
                      });
                    </script>

                    @endif
                    @if(session('failed'))
                    <script>
                        $(function () {

                        swal("ERROR", "Please select correct value!", "error");
                      });
                    </script>

                    @endif
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="bmd-label-floating">FROM</label>
                                <input type="text" class="form-control datetimepicker" id="from" name="start_Date"
                                    value="">

                                <script type="text/javascript">
                                    $(function () {
                                        $('#from').datetimepicker();
                                    });

                                </script>


                            </div>
                        </div>


                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="bmd-label-floating">To</label>
                                <input type="text" class="form-control datetimepicker" id="to" name="endDate" value="">
                                <script type="text/javascript">
                                    $(function () {
                                        $('#to').datetimepicker();
                                    });

                                </script>
                            </div>
                        </div>
                    </div>
                   {{--  <div class="row">
                     
                        <div class="col-md-5">
                            <div class="form-group">
                                --}}
                                <input  type="text" name="product"  value="{{$detailsM->product_id}}" class="form-control" hidden>

                                  {{--   <option value="0">Select Products</option>
                                    @foreach ($campproduct as $products)
                                    <option value="{{$products->id}}">{{$products->name}}</option>
                                    @endforeach
                                                    --}}
                            </input>
                           {{--  </div>
                        </div> --}}
                                        {{-- 
                        <div class="col-md-5">
                            <div class="form-group">
                             {{--    <label class="bmd-label-floating">Quntity</label> --}}
                              {{--   <input type="number" id="eyes" class="form-control" name="apipass" min="1" max="100"
                                    hidden>

                            </div>
                        </div> --}} 
                        <input type="text" name="camp_id" value="{{$detailsM->id}}"  class="form-control" hidden>
                        <div class="col-md-5">
                            <div class="form-group">

                                <label class="bmd-label-floating"></label>
                                <select type="text" name="mpos" class="form-control" placeholder="fkjffdh" required>
                                    <option value="0">Select MPOS</option>
                                    @foreach ($campMpos as $cMPOS)
                                    <option value="{{$cMPOS->id}}">{{$cMPOS->name}}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        
                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-success">SUBMIT </button>
                        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>


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
<script>
</script>
 <script>
        $(document).ready(function () {
            $('#datatab2').DataTable({
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

<script src="{{ URL::asset('public/template/js/bootstrap-datetimepicker.min.js') }}"></script>

@endsection
