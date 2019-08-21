@extends('Layout.mainlayout')
<title itemprop="name">HOME</title>
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
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
          {{--   @if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug =='master')
            <a class="nav-link float-right" href="#" data-toggle="modal" data-backdrop="static"
            data-keyboard="false" data-target="#add"style=" text-shadow: 2px 2px 5px #7986cb;">
                <i class="material-icons " style="padding-left: 30%;" href="#">games</i>
                <p><b>ADD MPOS </b> </p>
            </a> @endif --}}
          
        <div class="card-icon test">
            <i class="material-icons">assignment</i>
        </div>
    <h4 class="card-title"><b>PRODUCT-NO--</b> {{$product_id}}</b>  </h4>
    </div>
    <div class="card-body" >
        
            
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label><span class="bmd-form-group bmd-form-group-sm">
                         
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="datatab2"  class=" table table-striped table-no-bordered table-hover dataTable dtr-inline mdl-data-table"
                        cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                            <thead style="background-color:powderblue;font-family:verdana;">
                                <tr role="row">
                                    <th tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-sort="ascending" aria-label="DAY: activate to sort column descending" ><p><b>NAME</b>  </p> 
                                    </th>
                                  
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending"><p><b>PRICE</b> </p>
                                        </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending"><p><b>VAT</b> </p></th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending"><p><b>PRODUCT-LIMIT</b> </p></th></th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending"><p><b>RELOAD STOCK </b> </p></th></th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending"><p><b>ACTIVATE</b> </p></th></th>
                                       
                                </tr>
                            </thead>
                          
                            <tbody>
                                @foreach ($mpos as $newM)
                                <tr role="row" class="odd">
                                    <td tabindex="0" class="sorting_1">{{$newM->name}}</td>
                                  

                                    <td>   <input type="number"  step="0.01" name="product_price" placeholder="Product- Price"  class="form-control price"></td>
                                    <td> 
                                           
                                                    <select type="text" name="article" class="form-control selectvat" placeholder="" >
                                                            @if (!empty($newM->vats))
                                                            <option value="selectval" >Select -VAT</option>
                                                         
                                                            @foreach ($newM->vats as $item)
                                                            <option value="{{$item->id}}">{{$item->value}}</option>
                                                            @endforeach
                                                            @else
                                                            <option value="selectval" >Empty-VAT</option>
                                                            @endif
                                                          
                                                        </select>
                                  
                                            
                                    </td>
                                    <td> <input type="number"  step="0.01" name="product_price" placeholder="STOCK AMOUNT"  class="form-control stock"></td>
                                    <td> <input type="number"  step="0.01" name="product_price" placeholder="TIME"  class="form-control time"></td>
                                    <td>
                                      <a  class="btn btn-link btn-success btn-just-icon edit "data-mpos_id="{{$newM->id}}"data-product_id="{{$product_id}}" ><i class="material-icons activate" data-mpos_id="{{$newM->id}}"data-product_id="{{$product_id}}"  data-vat=""   title="activate">send</i></a>
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


            $('#datatab2').on('click', '.edit', function() {
              
                /* console.log($(this).parent().siblings()); */
                 /*  if (elem.hasClass("dx")) {

                        } else if (elem.hasClass("dsadad")) {

                        } */
                          /* console.log("asddasdasdasd"); */



                /* $('#datatab2').find('.price').each(function (index, element) {
                    var price = $(this).val();
                    
                        //alert(price);
                   
                  
                }); */
              
                var mpos_id = $(this).data("mpos_id");
                var product_id= $(this).data("product_id");
                var price='';
                var vat= '';
                var limit='';
                var time = '';
                var tds = $(this).parent().siblings();
                tds.each(function (i, e) {
                    var elem = $(this).children();
                    if (elem.is(".price")) {
                         price = (elem.val());
                    } else if (elem.is("select")) {
                        vat = (elem.val());
                    } if(elem.is(".stock")){
                        limit =(elem.val());

                    }if(elem.is(".time")){
                        time =(elem.val());
                    }
                });
             
                 $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url:'/productAcitvate',
                 type:'POST',
                 dataType: 'JSON',
                 data:{ price:price ,vat:vat,mpos_id:mpos_id,product_id:product_id,limit:limit,time:time},
                 success: function (data) {
                    $.alert({
                    title: 'Result',
                    content: data,
                   });
                                
                  var myValue = $( ".price" ).val('');
                },
            }); 

            });

        </script>
</div>
@endsection
