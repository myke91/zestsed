<div class="modal fade" id="user-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit User
                    <b><input type="text" id="names" style="border:none" readonly="true"></b></h4>
            </div>
            <div class="panel-body" style="border-bottom: 1px solid #ccc;">
                            <div id="userupdatemessages" class="hide" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div id="userupdatemessages_content">
                                </div>
                            </div>
                            <form class="form-horizontal" role="form" id="frm-update-user" action="">
                                <input type="hidden" id="user-id-edit" name="id"/>
                                <div class="form-group has-success">
                                    <label class="col-sm-4 control-label">Full Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="fullname-edit" name="fullname" required>
                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <label class="col-sm-4 control-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="username-edit" name="username" required>
                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <label class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email-edit" name="email" required>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button type="button" class="btn btn-success btn-sm  btn-update-user">Update User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

