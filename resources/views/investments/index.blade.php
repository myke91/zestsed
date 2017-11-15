@extends('layout')
@section('content')
    <style>
        #myInput {

            background-position: 10px 12px; /* Position the search icon */
            background-repeat: no-repeat; /* Do not repeat the icon image */
            width: 100%; /* Full-width */
            font-size: 16px; /* Increase font-size */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
        }
    </style>
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Investments</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="/addInvestments">Add Investments</a></li>
                        <li><a href="/investments">Investments</a></li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>



            <!-- ============================================================== -->
            <!-- approved contributions table -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="white-box">
                        <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for investor..">
                        </div>
                        <h3 class="box-title">List of Investments</h3>

                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table" id="investTable">
                                    <thead>
                                    <tr>
                                        <th>CONTRIBUTOR</th>
                                        <th>INTEREST RATE</th>
                                        <th>DATE OF CONTRIBUTION</th>
                                    </tr>
                                    </thead>
                                    @forelse($invests as $invest)
                                        <tbody>
                                        <tr>
                                            <td>{{$invest->firstName." ".$invest->otherNames." ".$invest->lastName}}</td>
                                            <td class="txt-oflo">{{$invest->interestRate}}</td>
                                            <td class="txt-oflo">{{$invest->dateOfInvestment}}</td>
                                        </tr>
                                        </tbody>
                                        @empty
                                        No data
                                    @endforelse
                                </table>
                        </div>
                        <div class="row">
                            <div class="col-md-10 ">
                                {{$invests->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("investTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

    </script>
@endsection
