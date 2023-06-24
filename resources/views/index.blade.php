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

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Total Sales</p>
                                <h4 class="mb-2">1452</h4>
                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="ri-shopping-cart-2-line font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">New Orders</p>
                                <h4 class="mb-2">938</h4>
                                <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-currency-usd font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Unique Visitors</p>
                                <h4 class="mb-2">29670</h4>
                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>from previous period</p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-currency-btc font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

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

                            <span style="color: {{ ($item->product_store >= 20) ? 'red' : 'black' }}">
                                {{ $item->product_store }}
                            </span>

                        </td>
                        <td>{{$item['category']['category_name']}}</td>

                        <td style="color: {{ (strtotime($item->expire_date) >= strtotime('+2 weeks')) ? 'red' : 'black' }}">
                            {{$item->expire_date}}
                        </td>

                        <td>{{$item['supplier']['name']}}</td>
                        <td><span style="color: green;">NGN</span> {{$item->selling_price}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- end of pie chart by category -->



    </div>


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