<section id="page-posts">
    <div class="UserDetail">
        <div class="row">
            <div class="col-md-6 form">
                <div class="form-group">
                    <label>ID </label>
                    <input type="text" class="form-control" value="<%person[0].id%>">
                    </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" value="<%person[0].name%>">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" value="<%person[0].username%>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="<%person[0].email%>">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" class="form-control" value="<%person[0].status%>">
                </div>
                 <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" value="<%person[0].registrationdate%>">
                </div>

            </div>
            <div class="col-md-6 image">
                <div class="kdaob">
                    <span class="fa fa-cloud-download fa-lg topicon"></span> 
                    <h3 class="des"> Drag & Drop a file</h3>
                    <div class="des"> or select an option below</div>
                    <div class="row upload">
                        <button class="btn btn-success fa fa-image fa-lg  icon"></button>
                        <button class="btn btn-primary fa fa-video-camera fa-lg icon"></button>
                        <button class="btn btn-danger fa fa-link fa-lg icon"></button>
                    </div>
                    <div class="des"> Maximun Upload File Size: 25MB</div>
                </div>

            </div>
        </div>
        <div class="row button">
            <a class="btn btn-success btn-lg">Save</a>
            <a class="btn btn-secondary btn-lg" >Cancel</a>
            <a class="btn btn-secondary btn-lg">Change Password</a>
        </div>
    </div>
</section>
