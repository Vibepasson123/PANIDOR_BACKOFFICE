@extends('Layout.mainlayout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Update Mpos</h4>
                </div>
                <div class="card-body">
                    <form action="/updateD" method="POST">
                        <div class="row">
                            {!! csrf_field() !!}
                            @if(session('done'))
                            <script>
                                $(function () {
                        swal("", "MPOS- UPDATED SUCCESSFULLY", "success");
                      });
                    </script>
                            @endif
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating"></label>
                                    {{-- @if (empty($updateValue->MPOS_LOCATION_id))
                                    --}}

                                    {{-- <script>
                                        $(function () {
                            swal("NOT FOUND", "MPOS Loction Found Empty", "error");
                          });
                        </script>
                                    --}}
                                    {{-- @endif --}}
                                    <input type="text" name="name" class="form-control" placeholder="{{$updateValue->name}}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{$updateValue->discription}}</label>
                                    <input type="text" value="{{$updateValue->discription}}" name="Discription" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">OGURL</label>
                                    <input type="text" value="{{$updateValue->OGURL}}" name="URLog" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">OGapiUser</label>
                                    <input type="text" value="{{$updateValue->OGapiUser}}" name="userapi" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">OGapipass</label>
                                    <input type="text" value="{{$updateValue->OGapipass}}" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{$updateValue->MPOS_LOCATION_id}}</label>
                                    <input type="text" value="{{$updateValue->MPOS_LOCATION_id}}" name="locationId"
                                        class="form-control" placeholder="Location ID ">
                                </div>
                            </div> --}}
                        </div>
                        <button class="btn btn-danger pull-right" type="button" value="Go back!" onclick="history.back()">CANCEL</button>
                        <button type="submit" value="{{$updateValue->id}}" name="pos" class="btn btn-primary pull-right">UPDATE
                            MPOS</button>

                        <div class="clearfix"></div>
                    </form>
                    <hr class=" btn-primary">
                 
                    <form method="post" action="{{url('uploadpic')}}" enctype="multipart/form-data">
                        
                                 {!! csrf_field() !!}
                        <div class="form-group" style=" padding-top: 90px;" id="">

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary pull-left btn-file">
                                        SELECT PICTURE <input type="file" name="image" id="imgInp">
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                                <button class="btn btn-success pull-right " name="mpos" type="submit" value="{{$updateValue->id}}" id="upload">
                                    UPLOAD
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
      


            <div class="modal fade" id="imageupload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-notify modal-success " role="document">

                    <div class="modal-content container-fluid">

                        <div class="modal-header card-header-primary ">
                            <p class="heading lead" id="head"></p>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="white-text">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <img id='img-upload' style=" height: 100%; width: 100%; " />

                          
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="card" id="tab" >
           {{--  <img src="{{asset('storage/app/public/upload/image1')}}" alt="gvftytkrfrt"> --}}
                <div class="card-header card-header-primary card-header-icon">
                   
                      
                    <div class="card-icon test">
                        <i class="material-icons">assignment</i>
                    </div>
                <h4 class="card-title"><b>Image -List</b> </b>  </h4>
             
                </div>
                <div class="card-body" >
                    
                        
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label><span class="bmd-form-group bmd-form-group-sm">
                                     
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatab2"  class="table table-striped table-no-bordered ">
                                        <thead style="background-color:powderblue;font-family:verdana;">
                                            <tr role="row">
                                                <th >ID
                                               </th>                                           
                                                <th >File-Name </th> 
                                                <th> File-URL</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mpos_image as $image_items)
                                                
                                           
                                            <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{$image_items->id}}</td>
           
                                                <td>{{$image_items->filename}}  </td>
                                                <td> {{$image_items->url}}</td>
                                            <td>   <a  class="btn btn-link btn-danger btn-just-icon edit" id="deleteImage" data-id="{{$image_items->id}}" data-file_id="{{$image_items->file_id}}" ><i
                                                class="material-icons" title="location details">delete</i></a>
                                                <a  class="btn btn-link btn-primary btn-just-icon check"  data-id="{{$image_items->id}}"  ><i
                                                    class="material-icons" title="Check Image">cast</i></a>
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
        <script>
            $(document).ready(function () {
            $(document).on('change', '.btn-file :file', function () {
                    var input = $(this),
                        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                    input.trigger('fileselect', [label]);
                });
                $('.btn-file :file').on('fileselect', function (event, label) {

                    var input = $(this).parents('.input-group').find(':text'),
                        log = label;
                    if (input.length) {
                        input.val(log);
                    } else {
                        if (log) alert(log);
                    }

                });

                function readURL(input, label) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $("#imageupload").modal("show");

                            $('#img-upload').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);


                    }
                }

                $("#imgInp").change(function () {
                    readURL(this);


                });
            });
            $('#datatab2').on('click', '.edit', function() {

                var image_id = $(this).data("id");
                var image_file_id = $(this).data("file_id");
             $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url:'/deletepic',
                 type:'POST',
                 dataType: 'JSON',
                 data:{ id:image_id,image_file_id:image_file_id},
                 success: function (data) {
                    if(data == 'Deleted'){
                        location.reload();  
                    }else{
                     alert(data);
                    }
                
                },
               });


            });
            $('#datatab2').on('click','.check',function(){
                       
                       var image_id = $(this).data("id");
                      $.ajax({
                       headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:'/imageDetails',
                      type:'POST',
                      dataType: 'JSON',
                      data:{ id:image_id},
                      success: function (data) {
                          if(data == 'noImage'){
                           alert("ERROR");
                          }else
                          {
                              $("#imageupload").modal("show");
              
                              $('#img-upload').attr("src",data);
                          }
                          },
                     });
                  });


        </script>

        @endsection
