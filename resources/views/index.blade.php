@extends('admin_dashboard') 
@section('admin')

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<meta charset=utf-8 />


<style> 
    body {
        font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
        background-color: #fff;
    }
</style>
<div class="page-content">
    <div class="container-fluid">


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



        <!-- <div class="row"> -->

        <!-- pie chart by category -->
        <div id="container" style="width:100%; height:400px;"></div>
        <div class="container">
            <table id="example" class="display nowrap" width="100%">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Stock Position</th>
                        <th>Category</th>
                        <th>Expiry Date</th>
                        <th>Supplier</th>
                        <th>Price</th>
                    </tr>
                </thead>


                <tbody>

                    @foreach($products as $item)
                    <tr>
                        <td>{{$item->product_name}}</td>
                        <td align="center">
<!-- if products <=20 it'll be red if its >=20 it'll be black -->
                            <span style="color: {{ ($item->product_store <= 20) ? 'red' : 'black' }}">
                                {{ $item->product_store }}
                            </span>

                        </td>
                        <td>{{$item['category']['category_name']}}</td>

                        <td> {{$item->expire_date}} </td>

                        {{-- <td style="color: {{ (strtotime($item->expire_date) >= strtotime('+2 weeks')) ? 'red' : 'black' }}">
                        {{$item->expire_date}}
                        </td>--}}

                        <td>{{$item['supplier']['name']}}</td>
                        <td><span style="color: green;">NGN</span> {{$item->selling_price}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- end of pie chart by category -->
    </div>

    <br><br><br>

    <h2 ></h2>
    <div class="row">
        <div class="col-xl-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">


                            <!-- stock position table -->
                            <div class="container">

                                <table id="basic-datatable" class="display nowrap" width="100%">
                                    <h3>Products that are running out of stock</h3>
                                    <a href="{{ url('/stock/configure') }}"> <p>Please Check them now!</p> </a>
                                    <br>
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Stock Posiotion</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @foreach($out_of_stock as $item)
                                        <tr>
                                            <td>{{ $item['product_name'] }}</td>
                                            <td>{{ $item['product_store'] }}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- end of stock position table -->




                        </div>

                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->


        <!-- expiry date table -->

        <div class="col-xl-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <div class="container">

                                <tablProducts that are expiring soon</h3>
                                    <a href="{{ url('/all/product') }}"><p>Please Check them now!</p></a>
                                    <br>
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Expiry Date</th>
                                        </tr>
                                    </thead>e id="basic-datatable" class="table dt-responsive nowrap w-100" width="100%">
                                    <h3>


                                    <tbody>

                                        @foreach($expiringSoon as $item)
                                        <tr>
                                            <td>{{ $item['product_name'] }}</td>
                                            <td>{{ $item['expire_date'] }}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- expiry date table -->




                        </div>

                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    <!-- pie chart javascript -->
    <script>
        $(document).ready(function() {
            var table = $("#example").DataTable();

            var myChart = Highcharts.chart("container", {
                chart: {
                    type: "pie"
                },
                title: {
                    text: "Stock Position Based On Category"
                },
                series: [{
                    data: chartData(table)
                }]
            });

            // Set the data for the first series to be the map returned from the chartData function
            table.on("draw", function() {
                myChart.series[0].setData(chartData(table));
            });
        });

        function chartData(table) {
            var counts = {};

            // Count the number of entries for each office
            table
                .column(2, {
                    search: 'applied'
                })
                .data()
                .each(function(val) {
                    if (counts[val]) {
                        counts[val] += 1;
                    } else {
                        counts[val] = 1;
                    }
                });

            // And map it to the format highcharts uses
            return $.map(counts, function(val, key) {
                return {
                    name: key,
                    y: val,
                };
            });
        }
    </script>

    <!-- end of pie chart javascript -->

    @endsection