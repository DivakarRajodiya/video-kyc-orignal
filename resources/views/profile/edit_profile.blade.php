<div id="EditProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            <form method="post" id="editProfileForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger d-none" id="editProfileValidationErrorsBox"></div>
                    <input type="hidden" name="user_id" id="pfUserId">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>First Name :</label>
                            <input type="text" name="first_name" id="pfName" class="form-control" required autofocus tabindex="1">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Last Name:</label>
                            <input type="text" name="last_name" id="plName" class="form-control" required autofocus tabindex="2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Email:</label>
                            <input type="email" name="email" id="pEmail" class="form-control" required tabindex="3">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Tenant:</label>
                            <input type="text" name="tenant" id="pTenant" class="form-control" required tabindex="4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('password', 'Password (If left blank will not be changed):') !!}
                            <input type="password" class="form-control" name="password" tabindex="5">
                        </div>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary" id="btnPrEditSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing..." tabindex="5">Save</button>
                        <button type="button" class="btn btn-secondary ml-1 edit-cancel-margin margin-left-5"
                                data-dismiss="modal">Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

