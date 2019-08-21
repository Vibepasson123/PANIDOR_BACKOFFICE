@if(Sentinel::check())
@else
<script>
    window.location = "{{ url('/login') }}";
</script>
@endif
@extends('Layout.mainlayout')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link href="{{asset('public/template/toggle.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
{{--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css" /> --}}
{{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script> --}}
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>
<div class="row">
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header card-header-rose card-header-text">
                <h4 class="card-title">MPOS</h4>
            </div>
            <table class="table">
                <thead>
                </thead>
                <tbody>
                    @foreach ($mpos as $MPOS)
                    <tr>
                        <td>ID</td>
                        <td></td>
                        <td>[{{$MPOS->id}}]</td>
                    </tr>
                    <tr>
                        <td>NAME</td>
                        <td></td>
                        <td>[{{$MPOS->name}}]</td>
                    </tr>
                    <tr>
                        <td>DISCRIPTION</td>
                        <td></td>
                        <td>  @if (!$MPOS->streetname==NULL ) 
                        <span>[{{$MPOS->streetname}}] </span>
                         @else 
                        <span>[Empty Location]</span>
                       @endif  </td>
                    </tr>
                    <tr>
                        <td>LOCATION-ID</td>
                        <td></td>
                        <td>[{{$MPOS->MPOS_LOCATION_id}}]</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title"><strong>CLIENT</h4>
            </div>
            <div class="card-body ">
                <table class="table">
                    <thead>
                        @foreach ($clientdetails as $client)
                        <tr>
                            <th>ID</th>
                            <th></th>
                            <th>[{{$client->id}}]</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>E-MAIL</td>
                            <td></td>
                            <td>{{$client->email}}</td>
                        </tr>
                        <tr>
                            <td>JOIN ON </td>
                            <td></td>
                            <td>[{{$client->created_at->diffForHumans() }}]</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card  status tab-content fancyTabContent" style="background-color:#78909c;">
    <div class="card-header card-header-primary card-header-icon">
        <div class="card-icon">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title "><strong>ORDER DETAILS</h4>
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
                <div class="row card">
                    <div class="col-sm-12" id="tab1">
                        <table id="datatab1" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ORDER-ID</th>
                                    <th>PRODUCT-ID</th>
                                    <th>VAT-ID</th>
                                    <th>QUANTITY</th>
                                    <th>PRICE</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($orderD as $orders)


                                <tr>
                                    <td><span href="">{{$orders->order_id}}</span></td>
                                    <td><span href="">{{$orders->product_id}}</span></td>

                                    <td><span href="">{{$orders->vatid}}</span></td>
                                    <td><span href="">{{$orders->quantity}}</span></td>

                                    <td><span href="">{{$orders->price}} €</span> </td>




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
        $('#datatab1').DataTable({
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



        // Delete a record

        //Like record

    });

</script>




@endsection
