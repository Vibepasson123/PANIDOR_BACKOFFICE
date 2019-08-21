@extends('Layout.mainlayout')
@section('content')
<link href="{{asset('public/template/css/datatableBs4.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('public/template/js/datatableBS4.min.js') }}"></script>
<script src="{{ URL::asset('public/template/js/sweetalert.min.js') }}"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Update location</h4>
                </div>
                <div class="card-body">
                    <form action="/AddNewlocation" method="POST">
                        <div class="row">
                            {!! csrf_field() !!}
                            @if(session('locupdate'))
                            <script>
                                $(function () {
                        swal("", "MPOS- UPDATED SUCCESSFULLY", "success");
                        window.location = "{{ url('/Poslist') }}";
                      });
                    </script>
                            @endif
                            <div class="col-md-4">
                                <p>longitude</p>
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{$locationvalue ->longitude}}</label>
                                    <input type="text" value="{{$locationvalue ->longitude}}" name="longitude" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>latitude</p>
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{$locationvalue ->latitude}}</label>
                                    <input type="text" value="{{$locationvalue ->latitude}}" name="latitude" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>Street</p>
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{$locationvalue ->streetname}}</label>
                                    <input type="text" value="{{$locationvalue ->streetname}}" name="street" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Employee-ID</p>
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{$locationvalue ->employee}}</label>
                                    <input type="text" value="{{$locationvalue ->employee}}" name="employee_id" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>Active</p>
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{$locationvalue ->active}}</label>
                                    <input type="text" value="{{$locationvalue ->active}}" name="active" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-danger pull-right" type="button" value="Go back!" onclick="history.back()">CANCEL</button>
                        <button type="submit" value="{{$call_id}}" name="locationid" class="btn btn-primary pull-right">UPDATE
                            LOCATION</button>
                        <div class="clearfix"></div>

                    </form>

                </div>
            </div>
        </div>




        @endsection
