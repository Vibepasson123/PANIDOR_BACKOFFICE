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
          {{--   @if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug !='client') --}}
            <a class="nav-link float-right" href="#" data-toggle="modal" data-backdrop="static"
                data-keyboard="false" data-target="#addcomp"style=" text-shadow: 2px 2px 5px #7986cb;">

                <i class="material-icons " style="padding-left: 30%;" href="#">games</i>
                <p>ADD Campaign</p>
            </a> {{-- @endif --}}
        <div class="card-icon">
            <i class="material-icons">assignment</i>
            
        </div>
         
        <h4 class="card-title"><b>Campaign List</b> </h4>
        
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
                                        style="width: 450px;" aria-label="Product: activate to sort column ascending">DISCRIPTION</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="Product: activate to sort column ascending">PRODUCT-ID</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">QUANTITY
                                         </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">PRICE
                                        </th>
                                  {{--   <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">STARTING-DATE</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">ENDING-DATE</th>--}}
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">ACTION</th> 

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($camplist as $newM)
                                <tr role="row" class="odd">
                                        <td tabindex="0" class="sorting_1"><span style="color:#ff3300;font-weight:bold">{{$newM->id}}</span></td>
                                    <td tabindex="0" class="sorting_1"><span style="font-weight:bold">{{$newM->name}}</span></td>
                                    <td><span style="font-weight:bold">{{$newM->discription}}</span></td>
                                    <td><span style="font-weight:bold">{{$newM->product_id}}</span></td>
                                    <td><span style="font-weight:bold">{{$newM->quantity}}</span></td>
                                    <td><span style="font-weight:bold">{{$newM->price}}</span></td>
                              {{--       @if  (count($newM->camp_status)> 0)
                                    @foreach ($newM->camp_status as $Campaign)
                                 
                                    <td>{{$Campaign->start_date}}</td>
                                   
                                    <td>{{$Campaign->end_date}}</td>
                                     
                                  
                                    @endforeach
                                    @else
                                    <td>Un-used Campaingn</td>
                                    <td>Un-used Campaingn</td>
                                   @endif --}}
                                    <td>
                                        <a href="/camp/{{$newM->id}}" class="btn btn-link btn-info btn-just-icon edit"><i
                                                class="material-icons" title="Check Campaign">pageview</i></a>
                                               {{--  <a id="openM" class="btn btn-link btn-warning btn-just-icon edit openM"><i
                                                    class="material-icons" title="Check Campaign">sync</i></a>
     --}}
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

                        swal("", "Campaign Added", "success");
                      });
                    </script>

                    @endif
                    @if(session('error'))
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
                                <input type="text" class="form-control datetimepicker1" id="from" name="start_Date"
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
                                <input type="text" class="form-control datetimepicker1" id="to" name="endDate" value="">
                                <script type="text/javascript">
                                    $(function () {
                                        $('#to').datetimepicker();
                                    });

                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">

                                <input type="text" id="prodeuct_name" name="URLog" class="form-control" placeholder="Product Name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">

                                <select type="text" name="product" class="form-control" required>

                                    <option value="0">Select Products</option>
                                    @foreach ($campproduct as $products)
                                    <option value="{{$products->id}}">{{$products->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="bmd-label-floating">Quntity</label>
                                <input type="number" id="eyes" class="form-control" name="apipass" min="1" max="100"
                                    required>

                            </div>
                        </div>
                        <input type="text" name="camp_id" id="getmopos" class="form-control" hidden>
                        <div class="col-md-5">
                            <div class="form-group">


                                <select type="text" name="mpos" class="form-control" placeholder="" required>
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
<div class="modal fade" id="addcomp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success " role="document">
        <!--Content-->
        <div class="modal-content container-fluid">
            <!--Header-->
            <div class="modal-header card-header-primary btn-success">
                <p class="heading lead">ADD Campaign</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
                <form action="/adcampp" method="POST">
                    {!! csrf_field() !!}
                    @if(session('sucess'))
                    <script>
                        $(function () {
                    
                    swal("", "Campaign Added", "success");
                     });
                  </script>
                    @session()->forget('success');
                    @endif
                    @if(session('error'))
                    <script>
                        $(function () {
                    
                    swal("ERROR", "Please select correct value!", "error");
                                          });
                                        
                 </script>
                    @session()->forget('error');
                    @endif
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
                                <label class="bmd-label-floating"></label>
                                <select type="text" name="product_id" class="form-control" required>
                                    <option class="btn-info">Select-Product</option>
                                    @foreach ($campproduct as $comp)
                                    <option value="{{$comp->id}}">{{$comp->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="bmd-label-floating">QUANTITY</label>
                                <input type="number" id="eyes" class="form-control" name="quantity" min="1" max="1000"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="bmd-label-floating">PRICE</label>
                                <input type="text" name="price" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-success">ADD </button>
                        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                    </div>
                </form>
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
        <script>
            $('.openM').on('click', function () {
        
                $('#campMO').modal('show')
        
                $("#prodeuct_name").val($(this).closest('tr').children()[1].textContent); // Find the text
                $("#getmopos").val($(this).closest('tr').children()[0].textContent);
                $("#issueid").val($(this).closest('tr').children()[1].textContent);
                $("#age").val($(this).closest('tr').children()[3].textContent);
                $("#sex").val($(this).closest('tr').children()[4].textContent);
            });
        
        </script>
    </div>

    <script src="{{ URL::asset('public/template/js/bootstrap-datetimepicker.min.js') }}"></script>

    @endsection
