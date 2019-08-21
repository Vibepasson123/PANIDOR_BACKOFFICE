@extends('Layout.mainlayout')
@section('content')
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>
<link href="{{asset('public/template/toggle.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/template/table/index.css')}}" rel="stylesheet" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header card-header-text  ">
                <div class="card-text">
                    <h4 class="card-title" style="colo:#59a693;font-weight:bold"><span> MPOS Details</span></h4>
                </div>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="nav nav-pills nav-pills-rose flex-column" role="tablist">
                            <li class="nav-item" style="padding: 20px">
                                <a data-toggle="tab" href="" role="tablist">
                                    <span style="font-weight:bold"> NAME</span>
                                </a>
                            </li>
                            <li class="nav-item" style="padding: 20px">
                                <a data-toggle="tab" href="#" role="tablist">
                                    <span style="font-weight:bold"> DISCRIPTION</span>
                                </a>
                            </li>
                            <li class="nav-item" style="padding: 20px">
                                <a data-toggle="tab" href="#l" role="tablist">
                                    <span style="font-weight:bold"> OG-URL</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        @foreach ($userMap as $userM)
                        <div class="tab-content">
                            <div class="tab-pane active" style="padding: 20px">
                                <a><span style="colo:#59a693;font-weight:bold">{{$userM->name}}</span> </a>
                                <br>
                            </div>
                            <div class="tab-pane active" style="padding: 20px">
                                <span style="colo:#59a693;font-weight:bold">{{$userM->discription}} </span>
                                <br>
                            </div>
                            <div class="tab-pane active" style="padding: 20px">
                                <span style="colo:#59a693;font-weight:bold">{{$userM->OGURL}} </span>
                                <br>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @if(session('error'))
    <script>
        $(function () {
      swal("Sorry", "404", "error");
    });
  </script>
    @endif
    <div class="row col-md-6" style="padding-left: 20px; ">
        <div class="card ">
            <div class="card-header card-header-text ">
                <div class="card-text">
                    <h4 class="card-title">MPOS LOCATION</h4>
                </div>
            </div>
            <div class="card-body ">
                <div id="map" style="height:300px;"></div>
                <script>
                    var late = {!!$lat!!};
          var longe = {!!$long!!};
          function myMap() {
            var MPOS = { lat: late, lng: longe };
            var map = new google.maps.Map(
              document.getElementById('map'), { zoom: 8, center: MPOS });
            var marker = new google.maps.Marker({ position: MPOS, map: map });
          }
        </script>
                <h4 class="card-title"></h4>
            </div>
        </div>
    </div>
    <div id="" class="tabs card col-sm-12 col-md-s">
        <ul class="nav nav-tabs " role="tablist">
            <li class="tab fancyTab ">
                <div class="arrow-down">
                    <div class="arrow-down-inner"></div>
                </div>
                <a id="tab0" href="#" role="tab" aria-controls="tabBody0" aria-selected="true" data-toggle="tab"
                    tabindex="0"><span class="fa fa-server "></span><span class="hidden-xs" style="colo:#59a693;font-weight:bold">Status</span></a>
                <div class="whiteBlock "></div>
            </li>
            <li class="tab fancyTab">
                <div class="arrow-down">
                    <div class="arrow-down-inner"></div>
                </div>
                <a id="tab1" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab"
                    tabindex="0"><span class="fa fa-snowflake-o "></span><span class="hidden-xs" style="colo:#59a693;font-weight:bold">Campaign</span></a>
                <div class="whiteBlock"></div>
            </li>
            <li class="tab fancyTab">
                <div class="arrow-down">
                    <div class="arrow-down-inner"></div>
                </div>
                <a id="tab2" href="#tabBody2" role="tab" aria-controls="tabBody2" aria-selected="true" data-toggle="tab"
                    tabindex="0"><span class="fa fa-first-order"></span><span class="hidden-xs" style="colo:#59a693;font-weight:bold">Orders</span></a>
                <div class="whiteBlock"></div>
            </li>
            <li class="tab fancyTab">
                <div class="arrow-down">
                    <div class="arrow-down-inner"></div>
                </div>
                <a id="tab3" href="#tabBody3" role="tab" aria-controls="tabBody3" aria-selected="true" data-toggle="tab"
                    tabindex="0"><span class="fa fa-cubes"></span><span class="hidden-xs" style="colo:#59a693;font-weight:bold">Products
                        On Offer</span></a>
                <div class="whiteBlock"></div>
            </li>
        </ul>
        <div class="card status tab-content fancyTabContent" id="myTabContent">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">MPOS SALE</h4>
            </div>
            <div class="card-body">
                <div class="toolbar">
                </div>
                <div class="material-datatables ">
                    <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" id="tab1">
                                <table id="datatab5" class="table table-striped table-bordered" style="width:100%">
                                    <thead style="background-color:powderblue;font-family:verdana;">
                                        <tr>
                                            <th>DAY</th>
                                            <th>PRODUCT</th>
                                            <th>NUMBER</th>
                                            <th>LOCATION</th>
                                           {{--  <th>ACTION</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($S_tab as $sale)
                                        <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{date('d F, Y', strtotime($sale->date_time))}} </td>
                                            <td>{{$sale->product_id}}</td>
                                            <td>{{$sale->quntity}}</td>
                                            <td>{{$sale->street}}</td>
                                            {{-- <td class="text-right">
                                                <a href="#" class="btn btn-link btn-warning btn-just-icon edit"><i
                                                        class="material-icons">dvr</i></a>
                                            </td> --}}
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
        <div class="card product tab-content fancyTabContent" id="myTabContent">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">OFFER PRODUCT</h4>
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
                            <div class="col-sm-12" id="tab1">
                                <table id="datatab6" class="table table-striped table-bordered" style="width:100%">
                                    <thead style="background-color:powderblue;font-family:verdana;">
                                        <tr>
                                            <th>PRODUCT-ID</th>
                                            <th>DISCRIPTION</th>
                                            <th>NAME</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($discountP as $d_product)
                                        <tr role="row" class="odd">
                                            <td>{{$d_product->id}}</td>
                                            <td>{{$d_product->discription}}</td>
                                            <td>{{$d_product->name}}</td>
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
        <div class="card order tab-content fancyTabContent" id="myTabContent">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">MPOS ORDERS</h4>
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
                            <div class="col-sm-12" id="tab1">
                                <table id="datatab4" class="table table-striped table-bordered" style="width:100%">
                                    <thead style="background-color:powderblue;font-family:verdana;">
                                        <tr>
                                            <th>Client-ID</th>
                                            <th>ORDER-ID</th>
                                            <th>TOTAL PRICE</th>
                                            <th>PICK-UP TIME</th>
                                            <th>CHECK DETAILS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($M_order as $ord)
                                        <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{$ord->clientUser_id}}
                                            </td>
                                            <td>{{$ord->id}}</td>
                                            <td>{{$ord->total_price}}</td>
                                            <td>{{$ord->pickupTime}}</td>
                                            <td>
                                                <a id="order_id" href="/orderdel/{{$ord->id}}" class="btn btn-link btn-warning btn-just-icon edit openM"><i
                                                        class="material-icons" title="Check Campaign">casino</i></a>
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
        <div class="card camp tab-content fancyTabContent" id="myTabContent">
            <div class="card ">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Campaign</h4>
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
                                <div class="col-sm-12" id="tab1">
                                    <table id="datatab3" class="table table-striped table-bordered" style="width:100%">
                                        <thead style="background-color:powderblue;font-family:verdana;">
                                            <tr>
                                                <th>Campaign-ID</th>
                                                <th>Starting Date</th>
                                                <th>Ending Date</th>
                                                <th>Product -Id</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($camp2 as $stv)
                                            <tr role="row" class="odd">

                                                <td>{{$stv->camp_id}}</td>
                                                <td>{{$stv->start_date}}</td>
                                                <td>{{$stv->end_date}}</td>
                                                <td>{{$stv->product_id}}</td>

                                                <td>

                                                    @if ($stv->status == 1)
                                                    <label class="switch">
                                                        <input type="checkbox" id="{{$stv->id}}" new="{{$stv->camp_id}}"
                                                            onclick="deactive(this.id)" value="{{$stv->id}}" class="chekboxt"
                                                            checked>
                                                        <span class="slider"></span>
                                                    </label>
                                                    @elseif ($stv->status == 0)
                                                    <label class="switch">
                                                        <input type="checkbox" id="{{$stv->id}}" onclick="active(this.id)"
                                                            value="{{$stv->id}}" class="chekboxt">
                                                        <span class="slider"></span>
                                                    </label>
                                                    @endif
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
            <script>
                $(document).ready(function () {
                    $('#datatab2').DataTable();
                    $('#datatab3').DataTable();
                    $('#datatab4').DataTable();
                    $('#datatab5').DataTable();
                    $('#datatab6').DataTable();
                });

            </script>
            <script>
                $(document).ready(function () {
                    $(".status").hide();
                    $(".camp").hide();
                    $(".order").hide();
                    $(".product").hide();
                });

            </script>
            <script>
                $(document).ready(function () {
                    $('#webTargeting').change(function () {
                        $('#webTargeting').val($(this).is(':checked'));
                        $("#webTargeting").prop('value', true);
                        $(this).closest('form').submit();
                    });
                });

            </script>
            <script>
                function deactive(clicked_id) {
                    var dd = clicked_id;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/deactcamp',
                        data: {
                            id: dd
                        },

                        success: function (data) {
                            swal("Deactivate");

                        }
                    });


                }

            </script>
            <script>
                function active(clicked_id) {

                    var activate = clicked_id;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/actcamp',
                        data: {
                            id: activate
                        },

                        success: function (data) {
                            swal("Activated");

                        }
                    });

                }

            </script>
            <script>
                $("#tab0").click(function () {
                    $(".status").show();
                    $(".camp").hide();
                    $(".order").hide();
                    $(".product").hide();
                });
                $("#tab1").click(function () {
                    $(".camp").show();
                    $(".status").hide();
                    $(".order").hide();
                    $(".product").hide();
                });
                $("#tab2").click(function () {
                    $(".test").hide();
                    $(".camp").hide();
                    $(".order").show();
                    $(".product").hide();
                });
                $("#tab3").click(function () {
                    $(".product").show();
                    $(".test").hide();
                    $(".camp").hide();
                    $(".order").hide();
                    $(".status").hide();
                });

            </script>
            <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7a-pVRxc_cx00QNTiPWQZW50qxiqZGO0&callback=myMap">
            </script>
            @endsection
