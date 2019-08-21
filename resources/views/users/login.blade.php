
<html>
<head>
  
    <link rel="stylesheet" type="text/css" href="style.css">   
    <meta charset=" UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0">
{{--     <link type="text/css" media="all" href="http://envision.wptation.com/wp-content/cache/autoptimize/css/autoptimize_17fe90a1acb94e3a59cde51718e56037.css"
        rel="stylesheet" /> --}}
        <link href="{{asset('public/template/css/mainlogin.css')}}" rel="stylesheet" type="text/css">
   {{--  <link type="text/css" media="screen" href="http://envision.wptation.com/wp-content/cache/autoptimize/css/autoptimize_8e3c7dac90177214b6583286ddaa141f.css"
        rel="stylesheet" /> --}}

    <title itemprop="name">PANIDOR - OFFICE-GUEST| Login </title>

    @if(Sentinel::check())
    <script type="text/javascript">
    window.location = "{{ url('/home') }}";
 </script>
 @endif
 @if(count($Newusers) == 0) 
 <a class="lost_password" href="/reg">Create New User
    </a>
    @endif


    <link rel="shortcut icon" href="http://panidor.pt/assets/img/system/favicon.ico">
</head>
    <body>
    <div class="login-box hvr-grow" >
    <img src="/public/img/avatar.png" class="avatar hvr-grow ">
        <h1>REAL-NATA</h1>
            <form method="post" action="/Auth" >
                {!! csrf_field() !!}
                @if(session('error'))
                <div class="form-control alert alert-danger">
                       {{session('error')}}
                   
                 </div>
                 @endif



                @if(session('incrorrect'))
                <script>
                    $(function () {

                        swal("ERROR", "Invalid Credentials", "error");
                      });
                    </script>

                @endif
                @if(session('delay'))
                <div class="alert alert-success" role="alert">
                        <strong>Maxmimum Limit exceded</strong>   {{session('delay')}}
                </div>

                @endif
                @if(session('notactive'))
                <script>
                    $(function () {

                        swal("SORRY", "Account Not Activated", "error");
                      });
                    </script>

                @endif                                                         
            	
            <p>Email</p>
            <input type="text"  name="email" id="user_login" placeholder="Enter Email">
            <p>Password</p>
            <input type="password"   name="password" id="user_pass"placeholder="Enter Password">
            <input type="submit" name="submit" value="Login">
          
            </form>
        
        
        </div>
        {{--     <script src="https://use.typekit.net/rej3xjd.js"></script>
         --}}
    
    </body>
</html>