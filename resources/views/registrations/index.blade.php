@extends('layout')
@section('content')
@include('registrations.RegistrationDetails')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Registrations</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Registrations</a></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- ============================================================== -->
        <!-- registrationstable -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for member..">
                    </div>
                    <h3 class="box-title">List of Registrations</h3>
                    <div class="table-responsive">
                        <table class="table" id="regTable">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE NUMBER</th>
                                    <th>OCCUPATION</th>
                                    <th>NEXT OF KIN</th>
                                    <th>OCCUPATION</th>
                                    <th colspan="2">APPROVE</th>
                                </tr>
                            </thead>
                            @foreach($regs as $reg)
                            <tr>
                                <td>{{$reg->firstName." ".$reg->otherNames." ".$reg->lastName}}</td>
                                <td class="txt-oflo">{{$reg->email}} </td>
                                <td>{{$reg->phoneNumber}}</td>
                                <td class="txt-oflo">{{$reg->occupation}}</td>
                                <td>{{$reg->nextOfKin}}</td>
                                <td>
                                    {{$reg->occupation}}
                                </td>
                                <td>
                                    @if($reg->isApproved==1)
                                    <i class="fa fa-check" id="checked"></i>
                                    @else
                                    <a href="{{route('approveRegistration',$reg->registrationId)}}" onclick="return confirm('Are you sure you want to approve this registration?');"><i class="fa fa-times" id="notchecked"></i></a>
                                    @endif
                                </td>
                                <td><Button value="{{$reg->registrationId}}" class="btn btn-success" id="show-reg">View Details</Button></td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-10 ">
                            {{$regs->links()}}
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
        table = document.getElementById("regTable");
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