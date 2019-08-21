@extends('Layout.mainlayout')


<title itemprop="name">HOME</title>
<script src="{{ URL::asset('public/template/js/sweetalert.min.js') }}"></script>
<link rel="shortcut icon" href="http://panidor.pt/assets/img/system/favicon.ico">
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
<!--     Fonts and icons     -->
<script src="{{ URL::asset('public/template/js/Chart.bundle.js') }}"></script>

</head>

<body class="homepage">
    <div class="wrapper ">
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <span>
                            @if($user >='0')
                            <a href="/register"></a>
                            @endif
                        </span>
                    </div>
                    <div class="collapse navbar-collapse justify-content-end">
                        <form class="navbar-form">
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Search...">
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </form>
                        <!-- <ul class="navbar-nav">
                                <li class="nav-item">
                                  <a class="nav-link" href="/sync" >
                                    <i class="material-icons">sync</i>
                                    <p class="d-lg-none d-md-block">
                                      Stats
                                    </p>
                                  </a>
                                </li>
                              </ul> -->
                    </div>
                </div>
            </nav>
          
            <style>
                .tabtable{
            height:240px;  
            overflow-y:scroll;
         
}
          }
        
        </style>
     
            <!-- End Navbar -->
            <div class="content ">
                    <hr   style=" border:none;
                    height: 20px;
                       width: 100%;
                      height: 50px;
                      margin-top: 0;
                      border-bottom: 1px solid #1f1209;
                      box-shadow: 0 20px 20px -20px #333;
                    margin: -50px auto 10px; ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 card2">
                            <div class="card  card-stats">
                                <div class="card-header card-header-warning card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">content_copy</i>
                                    </div>
                                    <p class="card-category">Total Sale</p>
                                    <h3 class="card-title">{{ $total_saleprice}}
                                        <small>€</small>
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons text-danger">date_range</i>
                                        <a href="#pablo">Previous Day Sales</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-success card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">store</i>
                                    </div>
                                    <p class="card-category">MPOS</p>
                                    <h3 class="card-title">{{$mpos->count()}}</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Last 24 Hours
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-danger card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">local_shipping</i>
                                    </div>
                                    <p class="card-category">Total Order</p>
                                    <h3 class="card-title">{{$total_order_week->count()}} </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">local_offer</i> Previous Day Order
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-info card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">face</i>
                                    </div>
                                    <p class="card-category">New Client</p>
                                    <h3 class="card-title">{{$newClient->count()}}</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">update</i> Joined today
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-4">
                                <div class="card daily card-chart">
                                    <div class="card-header  ">
                                        <div class="ct-chart daily  " id="dailySalesChart"></div>
                                        <canvas class="daily" id="myChart" style="height:200px; width:400px;"></canvas>
                                        <script>
                                            var ctx = document.getElementById("myChart");
                                            var myChart = new Chart(ctx, {
                                                type: 'pie',
                                                data: {
                                                    labels: <?=json_encode($day_sales['labels'])?>,
                                                    datasets: [{
                                                        label: '# of Sales',
                                                        data: <?=json_encode($day_sales['data'])?>,
                                                        backgroundColor: [
                                                            'rgba(205,205,225, 0.9)',
                                                            'rgba(153, 102, 255, 0.2)',
                                                            'rgba(255, 106, 86, 0.2)',
                                                            'rgba(75, 152, 192, 0.2)',
                                                            'rgba(163, 102, 215, 0.2)',
                                                            'rgba(255, 109, 64, 0.2)'
                                                        ],
                                                        borderColor: [
                                                            'rgba(255,99,132,1)',
                                                            'rgba(54, 162, 235, 1)',
                                                            'rgba(255, 206, 86, 1)',
                                                            'rgba(75, 192, 192, 1)',
                                                            'rgba(153, 102, 255, 1)',
                                                            'rgba(255, 159, 64, 1)'
                                                        ],
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        yAxes: [{
                                                            ticks: {
                                                                beginAtZero:true
                                                            }
                                                        }]
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>
                                    <div class="card-body daily">
                                        <h4 class="card-title">Daily Sales</h4>
                                        <p class="card-category">
                                            <span class="text-success"> <?=$day_sales['total']?> </span> 
                                            total sales.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-chart">
                                    <div class="card-header card-info">
                                        <div class="" id="dailySalesChart"></div>
                                        <canvas class="daily" id="myChart2" style="height:200px; width:400px;"></canvas>
                                        <script>
                                            var ctx = document.getElementById("myChart2");
                                            var myChart2 = new Chart(ctx, {
                                                type: 'line',
                                                data: {
                                                    labels: <?=json_encode($month_sales['labels'])?>,
                                                    datasets: [{
                                                        label: '# of Sales',
                                                        data: <?=json_encode($month_sales['data'])?>,
                                                        backgroundColor: [
                                                            'rgba(255, 99, 132, 0.2)',
                                                            'rgba(54, 162, 235, 0.2)',
                                                            'rgba(255, 206, 86, 0.2)',
                                                            'rgba(75, 192, 192, 0.2)',
                                                            'rgba(153, 102, 255, 0.2)',
                                                            'rgba(255, 159, 64, 0.2)',
                                                            'rgba(255, 99, 132, 0.2)',
                                                            'rgba(54, 162, 235, 0.2)',
                                                            'rgba(255, 206, 86, 0.2)',
                                                            'rgba(75, 192, 192, 0.2)',
                                                            'rgba(153, 102, 255, 0.2)',
                                                            'rgba(255, 159, 64, 0.2)'
                                                        ],
                                                        borderColor: [
                                                            'rgba(255,99,132,1)',
                                                            'rgba(54, 162, 235, 1)',
                                                            'rgba(255, 206, 86, 1)',
                                                            'rgba(75, 192, 192, 1)',
                                                            'rgba(153, 102, 255, 1)',
                                                            'rgba(255, 159, 64, 1)',
                                                            'rgba(255,99,132,1)',
                                                            'rgba(54, 162, 235, 1)',
                                                            'rgba(255, 206, 86, 1)',
                                                            'rgba(75, 192, 192, 1)',
                                                            'rgba(153, 102, 255, 1)',
                                                            'rgba(255, 159, 64, 1)'
                                                        ],
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        yAxes: [{
                                                            ticks: {
                                                                beginAtZero:true
                                                            }
                                                        }]
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Monthly Sales</h4>
                                        <p class="card-category">
                                            <span class="text-success"><?=$month_sales['year']?> </span> 
                                            year of sales.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-chart">
                                    <div class="card-header ">
                                        <div class="ct-chart" id="completedTasksChart"></div>
                                        <canvas id="myChart3" class="daily" style="height:200px; width:400px;"></canvas>
                                        <script>
                                            var ctx = document.getElementById("myChart3");
                                            var myChart3 = new Chart(ctx, {
                                                type: 'doughnut',
                                                data: {
                                                    labels: <?=json_encode($product_year_sales['labels'])?>,
                                                    datasets: [{
                                                        label: '# of products',
                                                        data: <?=json_encode($product_year_sales['data'])?>,
                                                        backgroundColor: [
                                                            'rgba(255, 99, 132, 0.2)',
                                                            'rgba(54, 162, 235, 0.2)',
                                                            'rgba(255, 206, 86, 0.2)',
                                                            'rgba(75, 192, 192, 0.2)',
                                                            'rgba(153, 102, 255, 0.2)',
                                                            'rgba(255, 159, 64, 0.2)'
                                                        ],
                                                        borderColor: [
                                                            'rgba(255,99,132,1)',
                                                            'rgba(54, 162, 235, 1)',
                                                            'rgba(255, 206, 86, 1)',
                                                            'rgba(75, 192, 192, 1)',
                                                            'rgba(153, 102, 255, 1)',
                                                            'rgba(255, 159, 64, 1)'
                                                        ],
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        yAxes: [{
                                                            ticks: {
                                                                beginAtZero:true
                                                            }
                                                        }]
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Year Sales by Products</h4>
                                        <p class="card-category">
                                            <span class="text-success"> {{$product_year_sales['total']}} </span> 
                                            total number of products sold in this year.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-tabs card-header-primary">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <span class="nav-tabs-title">:</span>
                                            <ul class="nav nav-tabs" data-tabs="tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#neworder" data-toggle="tab">
                                                        <i class="material-icons">local_shipping</i>New Order
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link " href="#reviews" data-toggle="tab">
                                                        <i class="material-icons">code</i> New Reviews
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                {{-- <li class="nav-item">
                                                    <a class="nav-link" href="#voucher" data-toggle="tab">
                                                        <i class="material-icons">card_giftcard</i>Customer Voucher
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active  tabtable" id="neworder">
                                            <table class="table table-hover">
                                        <thead class="text-warning">
                                           
                                            <th>Client ID</th>
                                            <th>Order-ID</th>
                                            <th>MPOS -ID</th>
                                            <th>Total Price</th>
                                            <th>Take-Away Time</th>
                                        </thead>
                                        <tbody>
                                         
                                            @foreach($currentOrder as $neworder )

                                                
                                            
                                            <tr>
                                            <td>{{$neworder->id}}</td>
                                            <td>{{$neworder->clientUser_id}}</td>
                                            <td>{{$neworder->mpos_id}}</td>
                                            <td>{{$neworder->total_price}}</td>
                                            <td>{{$neworder->pickupTime}}</td>
                                            </tr>
                                            @endforeach
                                           
                                        </tbody>
                                    </table>
                                        </div>
                                        <div class="tab-pane tabtable" id="reviews">
                                            <table class="table">
                                                <tbody>
                                                    <thead class="text-warning">
                                                        <th></th>
                                                        <th>MPOS Name</th>
                                                        <th>Rattings Average</th>
                                                        <th>Rating Star</th>

                                                    </thead>

                                                    @foreach ($reviews as $userReview)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{$userReview->name}}</td>
                                                        <td>{{$userReview->mposRate()->avg('rate')}}</td>
                                                        {{-- <td>{{$userReview->client_id}}</td> --}}

                                                        <td>


                                                            @if ($userReview->mposRate()->avg('rate') == 0)
                                                            <span>No Reviews</span>
                                                            @endif
                                                            @if( number_format($userReview->mposRate()->avg('rate') )
                                                            == 2)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            @endif
                                                            @if( number_format($userReview->mposRate()->avg('rate') )
                                                            == 3)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            @endif
                                                            @if( number_format($userReview->mposRate()->avg('rate') )
                                                            == 4)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            @endif
                                                            @if( number_format($userReview->mposRate()->avg('rate') )
                                                            >= 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            @endif
                                                            {{-- @switch($userReview->mposRate()->avg('rate'))
                                                            @case($userReview->mposRate()->avg('rate') == 0)

                                                            @break
                                                            @case($userReview->mposRate()->avg('rate') <= 2) <span
                                                                class="fa fa-star checked"></span>

                                                                @break
                                                                @case($userReview->mposRate()->avg('rate') >= 2)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                @break
                                                                @case($userReview->mposRate()->avg('rate') > 3.1538)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                @break
                                                                @case($userReview->mposRate()->avg('rate')>4)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                @break
                                                                @case($userReview->mposRate()->avg('rate') > 5)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                @break
                                                                @default
                                                                @endswitch --}}
                                                        </td>
                                                        {{-- <td>{{ $userReview->comments}}</td>
                                                        <td>{{ $userReview->email}}</td> --}}
                                                    </tr>
                                                    @endforeach

                                                    {{-- <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="">
                                                                    <span class="form-check-sign">
                                                                        <span class="check"></span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Sign contract for "What are conference organizers afraid
                                                            of?"</td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane tabtable" id="voucher">
                                            <table class="table">
                                                <tbody>
                                                    <thead class="text-warning">
                                                        <th></th>
                                                        <th>Customer -ID</th>
                                                        <th>Voucher</th>
                                                        <th>Details</th>
                                                    </thead>
                                                    @foreach ($voucherR as $voucher)


                                                    <tr>
                                                        <td></td>
                                                        <td>{{$voucher->client_id}}</td>
                                                        <td>{{$voucher->voucher}}</td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Voucher Details"
                                                                class="btn btn-primary btn-link btn-sm">
                                                                <i class="material-icons">list</i>
                                                            </button>

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
                </div>
                <hr class="btn-primary">
            </div>

        </div>
    </div>
 
</body>

</html>

