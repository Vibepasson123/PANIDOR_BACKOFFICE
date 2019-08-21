@if(Sentinel::check())
@else
<script>
    window.location = "{{ url('/login') }}";
  </script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" charset="utf-8"></script>
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>
@extends('Layout.mainlayout')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header card-header-rose card-header-text">

                <h4 class="card-title">FROM</h4>
            </div>
            <div class="card-body ">
                <div class="form-group">
                <input type="text" class="form-control datetimepicker1" id="datetimepicker1" value="{{Carbon::today()}}">
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker();
                });

            </script>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header card-header-rose card-header-text">

                <h4 class="card-title">TO</h4>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <input type="text" class="form-control datepicker" id="datetimepicker2"value="{{Carbon::today()}}">
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker2').datetimepicker();
                });

            </script>
        </div>
    </div>

</div>






<div class="row">
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header card-header-rose card-header-text">

                <h4 class="card-title">Today Sale </h4>
            </div>
            <div class="card-body ">

                <canvas id="salePerDist" style="height:200px; width:400px;"></canvas>
                <script>
                    var late = {!!$lat!!
                    };
                    var longe = {!!$long!!
                    };
                    var distsale = document.getElementById("salePerDist");
                    var mixedChart = new Chart(distsale, {

                        type: 'bar',
                        data: {
                            datasets: [{
                                label: 'Sale ',
                                data: [late]
                            }, {

                                label: 'Day',
                                data: [longe],
                                type: 'line'

                            }],
                            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday']
                        },

                    });

                </script>

            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header card-header-rose card-header-text">

                <h4 class="card-title">District Sale </h4>
            </div>
            <div class="card-body ">
                <canvas id="myChart" style="height:200px; width:400px;"></canvas>
                <script>
                    var ctx = document.getElementById("myChart");
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                            datasets: [{
                                label: '# of Votes',
                                data: [12, 19, 3, 5, 2, 3],
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
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });

                </script>
            </div>

        </div>
    </div>

</div>




<script src="{{ URL::asset('public/template/js/core/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/template/js/bootstrap-datetimepicker.min.js') }}"></script>




@endsection
