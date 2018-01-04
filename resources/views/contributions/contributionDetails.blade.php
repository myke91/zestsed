<div class="modal fade" id="contribution-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Contribution Details for
                    <b><input type="text" id="names" style="border:none" readonly="true"></b></h4>
            </div>
            <div class="panel-body" style="border-bottom: 1px solid #ccc;">
                <div class="panel-panel-default">
                    <input type="hidden" name="contributionId" id="contributionId">
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
                            <label for="shift">Mode of Payment</label>
                            <div class="input-group">
                                <input type="text" name = "modeOfPayment"  id = "modeOfPayment"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="time">Source of Payment</label>
                            <div class="input-group">
                                <input type="text" name = "sourceOfPayment"  id = "sourceOfPayment"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="batch">Vendor Name</label>
                            <div class="input-group">
                                <input type="text" name = "vendorName"  id = "vendorName"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="group">Date Of Contribution</label>
                            <div class="input-group">
                                <input type="text" name = "dateOfContribution"  id = "dateOfContribution"  class="form-control" readonly="true">
                            </div>
                        </div>
                        {{------------------}}
                        <div class="col-sm-5">
                            <label for="startDate">Contribution Amount</label>
                            <div class="input-group">
                                <input type="text" name = "contributionAmount"  id = "contributionAmount"  class="form-control" readonly="true">
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
                            <label for="endDate">Date Of Approval</label>
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