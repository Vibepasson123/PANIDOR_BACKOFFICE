@extends('Layout.mainlayout')
@section('content')
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>
<script src="{{ URL::asset('public/template/js/sweetalert.min.js') }}"></script>
<link href="{{asset('public/template/table/tab.css')}}" rel="stylesheet" type="text/css">
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header  btn-success ">
                <h4 class="card-title ">ORDER
                    <small class="description">DETAILS</small>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th></th>
                                <th>{{ $order_detail->id}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Client-Email</td>
                                <td></td>
                                <th>{{$client_email}}</th>
                            </tr>
                            <tr>
                                <td>PRODUCT-ID</td>
                                <td></td>
                                <th>{{$order_detail->product_id}}</th>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td></td>
                                <th>{{$order_detail->quantity}}</th>
                            </tr>
                            <tr>
                                <td>PickupTime</td>
                                <td></td>
                                <th>{{Carbon\Carbon::parse($order_detail->pickupTime)->format('Y/m/d h:i:s') }}</th>
                            </tr>
                            <tr>
                                <td>MPOS</td>
                                <td></td>
                                <th>{{$order_detail->mpos_id}}</th>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td></td>
                                <th>{{$order_detail->status}}</th>
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
        <div class="card-icon">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title">Client Orders</h4>
    </div>
    @if(session('error'))
    <script>
        $(function () {

            swal("", "Client Not Found", "error");
        });

    </script>
    @endif
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
                        <table id="datatab2" class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
                            cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-sort="ascending" aria-label="DAY: activate to sort column descending">ID
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-sort="ascending" aria-label="DAY: activate to sort column descending">Client-ID
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="Product: activate to sort column ascending">Quantity</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">PickupTime
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">MPOS
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th class="text-right" rowspan="1" colspan="1"></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($order as $clientorder)
                                <tr role="row" class="odd">
                                    <td>{{$clientorder->id}}</td>
                                    <td tabindex="0" class="sorting_1">{{$clientorder->clientUser_id}}</td>
                                    <td>{{$clientorder->quantity}}</td>
                                    <td>{{Carbon\Carbon::parse($clientorder->pickupTime)->format('Y/m/d h:i:s') }}</td>
                                    <td>
                                        {{$clientorder->mpos_id}}
                                    </td>
                                    <td>
                                        <a href="/order/{{$clientorder->mpos_id}}" class="btn btn-link btn-warning btn-just-icon edit"><i
                                                class="material-icons" data-toggle="tooltip" title="Disabled tooltip">view_list</i></a>
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
    <!-- end content-->
</div>
<script>
    $('.openM').on('click', function () {
        $('#campMO').modal('show');
        $("#prodeuct_name").val($(this).closest('tr').children()[1].textContent); // Find the text
        $("#getmopos").val($(this).closest('tr').children()[0].textContent);
        $("#issueid").val($(this).closest('tr').children()[1].textContent);
        $("#age").val($(this).closest('tr').children()[3].textContent);
        $("#sex").val($(this).closest('tr').children()[4].textContent);
        //for changing band model
        // $text2
    });

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
        // Delete a record
        //Like record
    });

</script>
<script src="{{ URL::asset('public/template/js/bootstrap-datetimepicker.min.js') }}"></script>
@endsection
