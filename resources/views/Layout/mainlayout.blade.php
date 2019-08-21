@if(Sentinel::check())
@else
<script>
    window.location = "{{ url('/login') }}";
</script>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>

    </title>
    <link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="/public/img/favicon.ico">
    <script src="{{ URL::asset('public/template/js/sweetalert.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
    <link href="{{asset('public/template/css/material-dashboard.min.css?v=2.1.0')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{ URL::asset('public/template/js/core/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('public/template/js/core/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('public/template/js/core/popper.min.js') }}"></script>
    <script src="{{ URL::asset('public/template/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>
    <script src="{{ URL::asset('public/template/js/plugins/chartist.min.js') }}"></script>
    <script src="{{ URL::asset('public/template/js/plugins/bootstrap-notify.js') }}"></script>
    <script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="{{asset('public/template/demo/newstyle.css')}}" rel="stylesheet" type="text/css">
</head>

<body class="new">
    <style>
        /*   .content  {background-image: linear-gradient(to top, #fad0c4 0%, #ffd1ff 100%)} */
   .navbar{background-color: #45526e;}
   .card{background-color:  #eeeeee;} 
   .modal-body{background-color: #ecf0f1;} 
     .new {background-color:#CFD8DC;}    
     .card-n{background-color:#4E4E4E }
     .navigation{background-color:powderblue;}
     .navlist{ background-color: darkgoldenrod}
     .homepage{ background-color:#E8EAF6 }
    
  </style>
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="white">
           {{--  @if(Sentinel::check())
            <script type="text/javascript">
            window.location = "{{ url('/userdetails') }}";
         </script>
         @endif  --}}
            <div class="sidebar-wrapper navigation">
                <ul class="nav  pulse">
                    <li class="nav-item active ">
                        @if(Sentinel::check())
                        <a class="nav-link  " href="/home">
                           
                            <i href="/home" class="material-icons ">home</i>
                            <p style="color:#ffffff;font-weight:bold ">Welcome -- {{Sentinel::getUser()->first_name}}</p>
                        </a>
                        @endif

                    </li>
                    
                    <a class="navbar-brand" href="#"></a>
                    <li class="nav-item  ">
                        <a class="nav-link " href="/Poslist">
                            <i class="material-icons btn-dark">library_books</i>
                            <p><b>LIST MPOS</b></p>
                        </a>
                    </li>
                    <hr   style=" border:none;
                    height: 20px;
                       width: 100%;
                      height: 50px;
                      margin-top: 0;
                      border-bottom: 1px solid #1f1209;
                      box-shadow: 0 20px 20px -20px #333;
                    margin: -50px auto 10px; ">
                    <li class="nav-item hvr-curl-bottom-left hvr-sink">
                        <a class="nav-link" href="/Products">
                            <i class="material-icons btn-dark">local_play</i>
                            <p><b>PRODUCTS</b> </p>
                        </a>
                    </li>
                  {{--   <li class="nav-item ">
                        <a class="nav-link" href="/staticstic">
                            <i class="material-icons">timeline</i>
                            <p><b>STATICS</b> </p>
                        </a>
                    </li> --}}
                    <hr   style=" border:none;
                    height: 20px;
                       width: 100%;
                      height: 50px;
                      margin-top: 0;
                      border-bottom: 1px solid #1f1209;
                      box-shadow: 0 20px 20px -20px #333;
                    margin: -50px auto 10px; ">

                    <li class="nav-item hvr-curl-bottom-left hvr-sink">
                        <a class="nav-link" href="/getCamp">
                            <i class="material-icons btn-dark">casino</i>
                            <p class="btn-"><b>CAMPAIGN</b> </p>
                        </a>
                    </li>
                  
                    @if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug =='master')
                    <hr   style=" border:none;
                    height: 20px;
                       width: 100%;
                      height: 50px;
                      margin-top: 0;
                      border-bottom: 1px solid #1f1209;
                      box-shadow: 0 20px 20px -20px #333;
                    margin: -50px auto 10px; ">
                    <li class="nav-item hvr-curl-bottom-left hvr-sink ">
                        <a class="nav-link"  data-toggle="modal" data-backdrop="static"
                         data-target="#adduser" >
                            <i class="material-icons btn-dark"> person_add</i>
                           
                            <p> <b> Add - USER</b></p>
                           
                        </a>
                    </li>
                    <hr   style=" border:none;
                    height: 20px;
                       width: 100%;
                      height: 50px;
                      margin-top: 0;
                      border-bottom: 1px solid #1f1209;
                      box-shadow: 0 20px 20px -20px #333;
                    margin: -50px auto 10px; ">
                     <li class="nav-item hvr-curl-bottom-left hvr-sink">
                            <a class="nav-link" href="/userdetails">
                                <i class="material-icons btn-dark">supervisor_account</i>
                                <p> USER-LIST</p>
                            </a>
                        </li> 
                   
                    @endif
                    <hr   style=" border:none;
                    height: 20px;
                       width: 100%;
                      height: 50px;
                      margin-top: 0;
                      border-bottom: 1px solid #1f1209;
                      box-shadow: 0 20px 20px -20px #333;
                    margin: -50px auto 10px; ">
                    <li class="nav-item  hvr-curl-bottom-left hvr-sink">
                        <a class="nav-link" href="/logout"> <i class="material-icons btn-dark">power_settings_new</i>
                            <p><b>LOG-OUT</b> </p>
                        </a>
                        </form>
                    </li>
                    <hr   style=" border:none;
                    height: 20px;
                       width: 100%;
                      height: 50px;
                      margin-top: 0;
                      border-bottom: 1px solid #1f1209;
                      box-shadow: 0 20px 20px -20px #333;
                    margin: -50px auto 10px; ">
                </ul>
                
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                    </div>
                </div>
            </nav>
            
            <div class="content">
                @yield('content')

            </div>  
        </div>
        <div>
        </div>
    </div>
    </div>
    </div>
    </div>




    

    <div class="modal fade" id="listUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success " role="document">
        <!--Content-->
        <div class="modal-content container-fluid">
            <!--Header-->
            <div class="modal-header card-header-primary btn-success">
                <p class="heading lead">User List</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">

          
                    <table id="datatab2"  class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
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
                                    style="width: 450px;" aria-label="NUMBER: activate to sort column ascending"><p><b>ACTIVATE</b> </p></th></th>
                            </tr>
                        </thead>
                      
                        <tbody>
                        
                            <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1">1</td>
                              

                                <td>   2</td>
                                <td> 
                                       
                                                
                              3
                                        
                                </td>
                                <td>
                                  <a  class="btn btn-link btn-success btn-just-icon edit " ><i class="material-icons activate"    title="activate">how_to_reg</i></a>
                                </td>
                            </tr>
                        
                        </tbody>
                    </table>
               
                   
                  
                    <div class="modal-footer justify-content-right">

                            
                    </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success " role="document">
        <!--Content-->
        <div class="modal-content container-fluid">
            <!--Header-->
            <div class="modal-header card-header-primary btn-success">
                <p class="heading lead">ADD - New User</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <form action="/RegUser" method="POST">
                    {!! csrf_field() !!}
                    @if(session('ADDPRODUCT'))
                    <script>
                        $(function () {
    
                            swal("", "NEW Product Added", "success");
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
                    @if(session('FOUND'))
                    <script>
                        $(function () {
    
                            swal("SORRY", "Product already exsist", "error");
                          });
                        </script>

                    @endif
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="bmd-label-floating">NAME</label>
                                <input type="text" name="first_name" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input type="email" name="email" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                    <label class="bmd-label-floating">ROLE</label>
                                    <select type="text" name="role" class="form-control" required>
                                        <option class="text_mmc">------</option>
                                        <option class="text_mmc" value="master">Master</option>
                                        <option class="text_mmc" value="admin">Admin</option>
                                        <option class="text_mmc" value="client">Client</option>
                                      
                                    </select>
                                <style>
                                    select {
                                            text-align-last: center;

                                        }
                                    </style>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="bmd-label-floating">Password</label>
                                <input type="password" name="password" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="bmd-label-floating">Confirm Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                
                    </div>




                 
                    <div class="modal-footer justify-content-right">
                        <button type="submit" class="btn btn-success">Create </button>
                        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

</body>

</html>
