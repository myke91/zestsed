<div class="modal fade" id="registration-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Registration Details for
                    <b><input type="text" id="names" style="border:none" readonly="true"></b></h4>
            </div>
            <div class="panel-body" style="border-bottom: 1px solid #ccc;">
                <div class="panel-panel-default">
                    <input type="hidden" name="registrationId" id="registrationId">
                    <div class="form-group">
                        <div class="col-sm-5">
                            <label for="academic-year">First Name</label>
                            <div class="input-group">
                                <input type="text" name = "firstName"  id = "firstName"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="program">Last Name</label>
                            <div class="input-group">
                                <input type="text" name = "lastName"  id = "lastName"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="level">Other Names</label>
                            <div class="input-group">
                                <input type="text" name = "otherNames"  id = "otherNames"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="shift">Email</label>
                            <div class="input-group">
                                <input type="text" name = "email"  id = "email"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="time">Phone Number</label>
                            <div class="input-group">
                                <input type="text" name = "phoneNumber"  id = "phoneNumber"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="batch">Gender</label>
                            <div class="input-group">
                                <input type="text" name = "gender"  id = "gender"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="group">Next of Kin</label>
                            <div class="input-group">
                                <input type="text" name = "nextOfKin"  id = "nextOfKin"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="startDate">Next of Kin Telephone</label>
                            <div class="input-group">
                                <input type="text" name = "nextOfKinTelephone"  id = "nextOfKinTelephone"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="endDate">Residential Address</label>
                            <div class="input-group">
                                <input type="text" name = "residentialAddress"  id = "residentialAddress"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="endDate">Occupation</label>
                            <div class="input-group">
                                <input type="text" name = "occupation"  id = "occupation"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="endDate">Purpose of Investing</label>
                            <div class="input-group">
                                <input type="text" name = "purposeOfInvesting"  id = "purposeOfInvesting"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="endDate">Approved</label>
                            <div class="input-group">
                                <input type="text" name = "isApproved"  id = "isApproved"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="endDate">Date of Approval</label>
                            <div class="input-group">
                                <input type="text" name = "dateOfApproval"  id = "dateOfApproval"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            </div>
        </div>
    </div>
</div>