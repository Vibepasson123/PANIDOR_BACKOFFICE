@extends('Layout.mainlayout')
@section('content')
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" type="text/javascript"></script> --}}
<script src="{{ URL::asset('public/template/js/sweetalert.min.js') }}"></script>
<link href="{{asset('public/template/table/tab.css')}}" rel="stylesheet" type="text/css">
<!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->

<div class="card" id="tab">
    <div class="card-header card-header-primary card-header-icon">
        <a class="nav-link float-right" href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false"
            data-target="#addProduct" style=" text-shadow: 2px 2px 5px #7986cb;">

            <i class="material-icons " style="padding-left: 30%;" href="#">games</i>
            <p><b>ADD-PRODUCT</b> </p>
        </a>
        <div class="card-icon test">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title"><b> PORDUCT LIST</b></h4>
    </div>
    <div>
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
                        <table id="datatab2" class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
                            cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                            <thead style="background-color:powderblue;font-family:verdana;">
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-sort="ascending" aria-label="DAY: activate to sort column descending">ID
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="Product: activate to sort column ascending">NAME</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">DESCRIPTION
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">ARTICLE
                                        ID</th>
                                     <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">VAT-ID</th> 
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">SHORT-DESCRIPTION</th>
                                     <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">PRICE</th> 
                                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                        style="width: 450px;" aria-label="NUMBER: activate to sort column ascending">ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>
                            </tfoot>
                            <tbody>
                                @foreach ($productList as $product)
                                <tr role="row" class="odd">
                                    <td tabindex="0" class="sorting_1"><span style="color:#ff3300;font-weight:bold">
                                            {{$product->id}}</span></td>
                                    <td><span style="font-weight:bold"> {{$product->name}}</td>
                                    <td><span style="font-weight:bold">{{$product->discription}}</td>
                                    <td><span style="font-weight:bold">{{$product->codArtigo}}</td>
                                     <td>
                                          
                                    <span style="font-weight:bold"> 
                                     @if (!empty($product->vatid))
                                     {{ $product->vatid}}
                                     @else
                                     <span style="color:#ff3300;" >Inactive Product</span>
                                                                
                                     @endif
                                    </td> 
                                    <td>
                                            <span style="font-weight:bold"> 
                                                    @if (!empty($product->short_description))
                                                    {{ $product->short_description}}
                                                    @else
                                                    <span style="color:#00995c;" >NOT-DISCRIBE</span>
                                                        
                                                    @endif
                                 
                                    </td>
                                    <td>
                                        <span style="font-weight:bold"> 
                                        @if (!empty($product->price))
                                        {{ $product->price}}
                                        @else
                                        <span style="color:#ff3300;" >Inactive Product</span>
                                            
                                        @endif
                                           
                                    </td> 
                                    <td>
                                        <a href="/selectProduct/{{$product->id}}" class="btn btn-link btn-success btn-just-icon edit"><i
                                                class="material-icons" title="update products">border_color</i></a>




                                        <a class="btn btn-link btn-info btn-just-icon toll  "><i class="material-icons activate"
                                                data-product_discription="{{$product->discription}}" data-product_id="{{$product->id}}" data-vat="{{$product->vatid}}"
                                        data-product_name="{{$product->name}}" data-article="{{$product->codArtigo}}" data-price="{{$product->price}}" title="product Details">pageview</i></a>

                                        <a href="/activateProduct/{{$product->id}}" class="btn btn-link btn-warning btn-just-icon edit"><i
                                                class="material-icons" title="Activate Product">build</i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-notify modal-success " role="document">
                            <!--Content-->
                            <div class="modal-content container-fluid">
                                <!--Header-->
                                <div class="modal-header card-header-primary btn-success">
                                    <p class="heading lead">ADD - PRODUCT</p>

                                    <button type="button" class="close close_reset" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="white-text">&times;</span>
                                    </button> 
                                </div>
                                <!--Body-->
                                <div class="modal-body">
                                {!! Form::open(['url' => 'AddProduct','method'=>'POST', 'id'=>'add_product_form_modal']) !!}
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">PRODUCT-NAME</label>
                                                    <!-- <input type="text" id="addName" name="product_name" class="form-control"
                                                        required> -->

                                                    {!! Form::text('product_name',null,['class'=>'form-control','required'=>'true','id'=>'addName']) !!}
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">PRODUCT-DISCRIPTION</label>
                                                    <!-- <input type="text" id="addDiscription" name="product_discription"
                                                        class="form-control" required> -->
                                                    {!! Form::text('product_discription',null,['class'=>'form-control','required'=>'true','id'=>'addDiscription']) !!}
                                                </div>
                                            </div>
                                        </div>
                              
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">ARTICLE CODE</label>
                                                    <!-- <input type="text" id="article" name="article" class="form-control"
                                                        required> -->
                                                    {!! Form::text('article',null,['class'=>'form-control','required'=>'true','id'=>'article']) !!}
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating"></label>
                                                    <select type="text" name="mpos" class="form-control" required>
                                                        <option class="btn-info">Select Mpos</option>
                                                        @foreach ($mpos as $mpos_id)
                                                        <option value="{{$mpos_id->id}}">{{$mpos_id->id}}</option>
                                                        @endforeach
                                                    </select>
                                                    <style>
                                                        select {
                                                            text-align-last: center;
                                                        }
                                                    </style>
                                                </div>
                                            </div> --}}
                                        </div>


                                        <!--Footer-->
                                        <div class="modal-footer justify-content-right">
                                            {!! Form::submit('ADD',['class' => 'btn btn-success', 'id'=>"addproductsub"]) !!}
                                            <a type="button" class="btn btn-danger waves-effect close_reset" data-dismiss="modal">Cancel</a>
                                        </div>
                            
                                  
                                {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="modal fade" id="activateProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-notify modal-success " role="document">
                                <!--Content-->
                                <div class="modal-content container-fluid">
                                    <!--Header-->
                                    <div class="modal-header card-header-primary btn-success">
                                        <p class="heading lead">Product Details</p>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="white-text">&times;</span>
                                        </button>
                                    </div>
                                    <!--Body-->
                                    <div class="modal-body">

                                      {{--   <form action="/AddProduct" method="POST"> --}}
                                          

                                            <div class="row">
                                              
                                                        <img id="productImage"  class="pdetails" style=" height: 100%; width: 100%; " src="">

                                             
                                                        <hr class="btn-success">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">PRODUCT-NAME</label>
                                                        <span name="product_name" class="form-control" id="product_name"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">PRODUCT-DISCRIPTION</label>
                                                        <span id="product_discription" name="product_discription" class="form-control"></span>
                                                           
                                                    </div>
                                                </div>
                                            </div>
                                       
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">VAT</label>
                                                        <span id="vat" name="vat" class="form-control "></span>
                                                         
                                                        <style>
                                                            select {
                                                                text-align-last: center;
                                                            }
                                                        </style>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">PRODUCT-PRICE</label>
                                                        <span id="price" name="price" class="form-control"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">ARTICLE CODE</label>
                                                        <span id="article_id" name="article_id" class="form-control"></span>
                                                  
                                                </div>
                                               
                                             
                                            </div>
                                          
                                            <div class="modal-footer justify-content-right">

                                                    
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

                    $('.activate').on('click', function () {
                        var product_id = $(this).data("product_id");
                        var product_description = $(this).data("product_discription");
                        var product_name = $(this).data("product_name");
                        var vat = $(this).data("vat");
                        var article = $(this).data("article");
                        var price = $(this).data("price");

                        $.ajax({
                                headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url:'/productDetaisImage',
                                type:'POST',
                                dataType: 'JSON',
                                data:{ id:product_id},
                                success: function (data) {
                                    if(data == 'noImage'){
                                        $('#activateProduct').modal('show');
                                        $("#productImage").attr("src","http://portalpanidor.vivek.dev.local/storage/app/public/upload/product_3kk.jpg");
                                        $("#product_name").text(product_name);
                                        $("#vat").text(vat);
                                        $('#price').text(price);
                                        $('#article_id').text(article);
                                    }else{
                                                   
                                        $('#activateProduct').modal('show');
                                        $("#productImage").attr("src",data);
                                        $("#product_name").text(product_name);
                                        $("#vat").text(vat);
                                        $('#price').text(price);
                                        $('#article_id').text(article);
                                        $('#product_discription').text(product_description);


                                    }
                                
                                },
                            });



                      
                      

                     
                    });

                    $("#addProduct").on('hidden.bs.modal', function () {
                        $('#addName').val('');
                        $('#addDiscription').val('');
                        $('#article').val('');
                    });

                    if ('{{Session::has('msg')}}') {
                        if ('{{Session::has('success')}}') {
                            if ('{{Session::get('success')}}') {
                                swal({
                                    icon: 'success',
                                    title: 'Done!',
                                    text: '{{Session::get('msg')}}',
                                    timer: 3000,
                                    buttons: false
                                }).then(function () {},
                                    function (dismiss) {
                                        if (dismiss === "timer") {
                                            $("#addProduct").modal({"backdrop": "static"});
                                            $('#addProduct').modal('hide');
                                            location.reload();
                                        }
                                    }
                                );
                            } else {
                                $("#addProduct").modal();
                                swal({
                                    icon: "error",
                                    title: "Error!",
                                    text: '{{Session::get('msg')}}',
                                    timer: 3000,
                                    buttons: false
                                });
                            }
                        }
                        
                    }

                    // $("form").submit(function() {
                    // });

                    // $("#addproductsub").click(function () {
                    
                    //             var product_name = $('#addName').val();
                    //             var product_description = $('#addDiscription').val();
                    //             var codeArtigo = $('#article').val();

                    //             console.log(product_name)
                    //             console.log(product_description)
                    //             console.log(codeArtigo)

                    //             //     if (product_name.length === 0) {
                    //             //         $('#product_name').after('<span class="error">This field is required</span>');
                    //             //     }
                    //             //     if (product_description.length === 0) {
                    //             //         $('#product_description').after('<span class="error">This field is required</span>');
                    //             //     }
                    //             //     if (codeArtigo.length === 0) {
                    //             //         $('#codeArtigo').after('<span class="error">This field is required</span>');
                    //             //     }
                                
                    //             //     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    //             // $.ajax({
                    //             //         headers: {
                    //             //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //             //         },
                    //             //         url: '/AddProduct',
                    //             //         type: 'POST',
                    //             //         dataType: 'JSON',
                    //             //         data: {
                    //             //             product_name:product_name,
                    //             //             product_discription:product_description,
                    //             //             article:codeArtigo
                    //             //         },
                                       
                    //             //         success: function (data) {
                    //             //             if (data.success) {
                    //             //                 swal({
                    //             //                     title: "Done!",
                    //             //                     text: data.msg,
                    //             //                     type: "success",
                    //             //                     timer: 3000,
                    //             //                     buttons: false
                    //             //                 }).then(function () {},
                    //             //                     function (dismiss) {
                    //             //                         if (dismiss === "timer") {
                    //             //                             $("#addProduct").modal({"backdrop": "static"});
                    //             //                             $('#addProduct').modal('hide');
                    //             //                             location.reload();
                    //             //                         }
                    //             //                     }
                    //             //                 );
                                                    
                                                    
                                                    
                    //             //                 //     "Done!", data.msg, "success").then(res => {
                    //             //                 //     console.log(res);
                    //             //                 //     if (res) {
                    //             //                 //         location.reload();
                    //             //                 //     }
                    //             //                 // }); 
                    //             //             } else {
                    //             //                 swal("Error!", data.msg, "error"); 
                    //             //             }
                                        
                    //             //         },

                    //             //         error: function (response) {
                    //             //             console.log(response.responseText)
                    //             //         }
                    //             //     });

                    //             });

                </script>
                @endsection
