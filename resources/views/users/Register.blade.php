

                                           



  
<!DOCTYPE html>
<html class="no-js html-loading wf-active modern-browser responsive>
<head>
        <meta charset=" UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0">
        <link type="text/css" media="all" href="http://envision.wptation.com/wp-content/cache/autoptimize/css/autoptimize_17fe90a1acb94e3a59cde51718e56037.css"
            rel="stylesheet" />
        <link type="text/css" media="screen" href="http://envision.wptation.com/wp-content/cache/autoptimize/css/autoptimize_8e3c7dac90177214b6583286ddaa141f.css"
            rel="stylesheet" />
    
            <title itemprop="name">PANIDOR - OFFICE-GUEST| Create user </title>
            

<!--[if IE 8]> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->

<!--[if IE 7]>
<link rel='stylesheet' id='theme-fontawesome-ie7-css'  href='http://envision.wptation.com/wp-content/themes/envision/includes/modules/module.fontawesome/source/css/font-awesome-ie7.min.css' media='all' />
<![endif]-->
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://envision.wptation.com/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://envision.wptation.com/wp-includes/wlwmanifest.xml" />

<link rel='shortlink' href='http://envision.wptation.com/?p=1428' />
<link rel="shortcut icon" href="http://envision.wptation.com/wp-content/uploads/2013/11/favicon.png" />
</head>

<body class="page page-id-1428 page-template page-template-page-no-header-footer page-template-page-no-header-footer-php run layout--fullwidth">
    <div id="side-panel-pusher">
        <div id="main-container">
            <div id="page-wrap">
                <div id="header-overlapping-helper"></div>
                <div id="page-content" class="no-sidebar-layout">
                    <div class="container">
                        <div id="the-content">
                            <div id="video-background-1" class="ui--video-background-wrapper fullwidth-content clearfix ui--section-content-v-center color--dark"
                                style="margin-top: -30px;  margin-bottom: -12px;">
                                <div class="ui--video-background-holder">
                                    <div class="ui--video-background-video hidden-phone ">
                                      
                                            
                                    </div>
                                    <div class="ui--video-background-poster"></div>
                                    <div class="ui--video-background">
                                        <div class="ui--gradient"></div>
                                    </div>
                                </div>
                                <div class="ui--section-content container clearfix">
                                    <div class="ui--animation-in make--fx--flipIn-X ui--pass clearfix" data-fx="fx--flipIn-X"
                                        data-delay="200" data-start-delay="0">
                                        <div class="ui-row row">
                                            <div class="ui-column span3"></div>
                                            <div class="ui-column span6">
                                                <div class="ui--icon-box position--top">
                                                    <span class="ui--icon-box-icon ui--animation"><i class="ui--icon icomoon-key icon-inline-block icon-with-background radius-circle"
                                                            style="font-size: 60px;  width: 64px;  height: 64px;  border-width: 5px;  border-style: solid;"></i></span>
                                                    <div class="ui--icon-box-content"></div>
                                                </div>
                                                <h1 id="custom-title-h1-1" class="ui--animation " style="text-align: center; margin-bottom: 0px; "><strong>Welcome
                                                        to MPOS</strong>
                                                </h1>
                                                <h4 id="custom-title-h4-1" class="ui--animation " style="text-align: center; "></h4>
                                            </div>
                                            <div class="ui-column span3"></div>
                                        </div>
                                        <div class="ui--space clearfix" data-responsive="{&quot;css&quot;:{&quot;height&quot;:{&quot;phone&quot;:null,&quot;tablet&quot;:null,&quot;widescreen&quot;:null}}}"></div>
                                        <div class="ui-row row">
                                            <div class="ui-column span4"></div>
                                            <div class="ui-column span4">
                                                <div class="ui--custom-login ui--pass">
                                                    <div id="login-form-container" class="ui--custom-login login-form-container">
                                                        <form method="post" action="/RegUser" class="login-form form-horizontal ui-row">
                                                            {!! csrf_field() !!}
                                                            @if(session('done'))
                                                            <script>
                                                              $(function () {
                                        
                                                                swal("", "Campaign Added", "success");
                                                              });
                                                            </script>
                                        
                                                            @endif
                                                            @if(session('error'))
                                                               <script>
                                                              $(function () {

                                                             swal("sad", "Sorry Please try again...!!! Something went wrong ?", "success");
                                                                                     });
                                                                                    </script>
                                                                                    @endif
                                                            <div class="form-elements">
                                                                <div class="ui-row row">
                                                                    <p class="control-group">
                                                                        <label class="control-label ui--animation" for="user_login">First
                                                                            Name</label>
                                                                        <span class="controls ui--animation">
                                                                            <input tabindex="100" type="text" class="input-text"
                                                                                name="first_name" id="us" value="" />
                                                                        </span>
                                                                    </p>
                                                                    <p class="control-group">
                                                                        <label class="control-label ui--animation" for="user_login">Last
                                                                            Name</label>
                                                                        <span class="controls ui--animation">
                                                                            <input tabindex="100" type="text" class="input-text"
                                                                                name="last_name" id="ud" value="" />
                                                                        </span>
                                                                    </p>
                                                                    <p class="control-group">
                                                                        <label class="control-label ui--animation" for="user_login">Email</label>
                                                                        <span class="controls ui--animation">
                                                                            <input tabindex="100" type="email" class="input-text"
                                                                                name="email" id="u" value="" />
                                                                        </span>
                                                                    </p>
                                                                    <p class="control-group">
                                                                        <label class="control-label ui--animation" for="user_login">Password</label>
                                                                        <span class="controls ui--animation">
                                                                            <input tabindex="100" type="password" class="input-text"
                                                                                name="password" id="password" value="" />
                                                                        </span>
                                                                    </p>

                                                                    <p class="control-group">
                                                                        <label class="control-label ui--animation" for="user_login">Confirm
                                                                            Password</label>
                                                                        <span class="controls ui--animation">
                                                                            <input tabindex="100" type="password" class="input-text"
                                                                                name="password" id="" value="" />
                                                                        </span>
                                                                    </p>
                                                                    <p class="control-group">
                                                                        <label class="control-label ui--animation" for="user_login">Select
                                                                            Role</label>
                                                                        <span class="controls ui--animation">
                                                                            <select name="role">
                                                                                <option value="">------</option>
                                                                                <option value="master">Master</option>
                                                                                <option value="admin">Admin</option>
                                                                                <option value="client">Client</option>
                                                                             

                                                                            </select>
                                                                        </span>
                                                                    </p>

                                                                </div>
                                                            </div>
                                                            <div class="custom-login-form-actions clearfix">

                                                                <p class="control-group pull-left"> <button type="submit"
                                                                        class="ui--animation btn btn-primary" tabindex="102"
                                                                        name="wpt_login" value="Login">Register</button>
                                                                </p>
                                                                <div class="clearfix"></div>
                                                       </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ui-column span4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="side-panel" class="ui-row" style="display: none;">
            <div id="ui--side-content-widget-1">
                <h3><strong>Contact Us</strong></h3>
                <div role="form" class="wpcf7" id="wpcf7-f47-o1" dir="ltr">
                    <div class="screen-reader-response"></div>
                    <form action="/login-full-page-video-background/?_wpcf7_is_ajax_call=1&amp;_wpcf7=47&amp;_wpcf7_request_ver=1536066993706#wpcf7-f47-o1"
                        method="post" class="wpcf7-form" novalidate="novalidate">
                        <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="47" />
                            <input type="hidden" name="_wpcf7_version" value="4.3.1" />
                            <input type="hidden" name="_wpcf7_locale" value="" />
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f47-o1" />
                            <input type="hidden" name="_wpnonce" value="eb62acc317" />
                        </div>
                        <p>Your Email (required)<br />
                            <span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email"
                                    value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                    aria-required="true" aria-invalid="false" /></span> </p>
                        <p>Your Message<br />
                            <span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40"
                                    rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span>
                        </p>
                        <p class="text-right" style="margin-bottom:0;"><button type="submit" class="btn btn-primary btn-small">Send
                                Message</button></p>
                        <div class="wpcf7-response-output wpcf7-display-none"></div>
                    </form>
                </div>
            </div>



            <a class="btn btn-normal btn-icon-left btn-primary ui--animation" id="ui--side-panel-close-button" href="javascript:;"
                style=""><i class="ui--icon fontawesome-remove" style="font-size: 16px;  width: 18px;  height: 18px;"></i></a>
        </div>
    </div>
   


    <div id="theme-options" class="o--off">



    </div>
    <script src="https://use.typekit.net/rej3xjd.js"></script>
    <script type="text/javascript">
        // <![CDATA[
        var styleElement = document.createElement("style");
        styleElement.type = "text/css";

        var cloudfw_dynamic_css_code =
            "@media ( min-width: 979px ) { .modern-browser #header-container.stuck #logo img {height: 30px;  margin-top: 20px !important;  margin-bottom: 20px !important;}  }\r\n\r\n\r\nhtml #video-background-1 .ui--video-background {-ms-filter: \"progid:DXImageTransform.Microsoft.Alpha(Opacity=65)\";opacity: 0.65;} html #video-background-1 .ui--video-background .ui--gradient {background-color:#3a1e40; *background-color: #0e6591; background-image:url('data:image\/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPg0KICAgIDxkZWZzPg0KICAgICAgICA8bGluZWFyR3JhZGllbnQgaWQ9ImxpbmVhci1ncmFkaWVudCIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiIHNwcmVhZE1ldGhvZD0icGFkIj4NCiAgICAgICAgICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiMwZTY1OTEiIHN0b3Atb3BhY2l0eT0iMSIvPg0KICAgICAgICAgICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjM2ExZTQwIiBzdG9wLW9wYWNpdHk9IjEiLz4NCiAgICAgICAgPC9saW5lYXJHcmFkaWVudD4NCiAgICA8L2RlZnM+DQogICAgPHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgc3R5bGU9ImZpbGw6IHVybCgjbGluZWFyLWdyYWRpZW50KTsiLz4NCjwvc3ZnPg=='); background-image: -moz-linear-gradient(top, #0e6591, #3a1e40) ; background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0e6591), to(#3a1e40)); background-image: -webkit-linear-gradient(top, #0e6591, #3a1e40); background-image: -o-linear-gradient(top, #0e6591, #3a1e40); background-image: linear-gradient(to bottom, #0e6591, #3a1e40); filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#0e6591', endColorstr='#3a1e40'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#0e6591', endColorstr='#3a1e40')\"; background-repeat: repeat-x ;} html #video-background-1 .ui--video-background-poster {-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='http:\/\/envision.wptation.com\/wp-content\/uploads\/2014\/01\/login_bg_2.jpg',sizingMethod='scale'); -ms-filter: \"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='public/img/bg.png')\";  background-image: url('public/img/bg.png');} html #video-background-1 .ui--section-content , html #video-background-1 .ui--section-content p, html #video-background-1 .ui--section-content h1, html #video-background-1 .ui--section-content h2, html #video-background-1 .ui--section-content h3, html #video-background-1 .ui--section-content h4, html #video-background-1 .ui--section-content h5, html #video-background-1 .ui--section-content h6 {color: #ffffff;} html #video-background-1 .ui--section-content a {color: #cccccc;} html #video-background-1 .ui--section-content a:hover {color: #ffffff;} ";

        if (styleElement.styleSheet) {
            styleElement.styleSheet.cssText = cloudfw_dynamic_css_code;
        } else {
            styleElement.appendChild(document.createTextNode(cloudfw_dynamic_css_code));
        }

        document.getElementsByTagName("head")[0].appendChild(styleElement);

        // ]]>

    </script>
    <script src="{{ URL::asset('public/template/js/login.js') }}"></script>

</body>

</html>