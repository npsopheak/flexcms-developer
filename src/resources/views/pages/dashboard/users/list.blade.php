<section id="page-posts">
	<div class="listStaff">
		<div class="row">
			<h1 class="col-md-6">List All Staff</h1>
			<div class="form-group col-md-3">
				<input type="text" class="form-control " placeholder="Search Staff">
			</div>
			<div class="form-group col-md-3">
				<selectize placeholder='Choose one below' options='myOptions' config="myConfig" ng-model="myModel" ng-disabled='disable' required='true'></selectize>
			</div>
		</div>
		<div class="card-body btn-bar text-right">
            <button type="button" class="btn btn-success fa fa-plus fa-lg" data-toggle="modal" data-target="#successModal">
            </button>
        </div>
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-success modal-lg" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h4 class="modal-title">Create Staff</h4>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">×</span>
		                </button>
		            </div>
		            <div class="modal-body">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" data-target="#home" role="tab" aria-controls="home" aria-expanded="true">Detail</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" data-target="#profile" role="tab" aria-controls="profile" aria-expanded="false">Cover Image</a>
							</li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">
								<div class="form-group">
									<label for="name">Display Name *</label>
									<input type="text" class="form-control" id="name">
								</div>   
								<div class="form-group">
									<label for="name">Description</label>
									<input type="text" class="form-control" id="name">  
								</div>                          
								<div class="form-group">
									<label for="name">Order Number</label>
									<input type="number" min="1" class="form-control" id="name">
								</div>   
							</div>
							<div class="tab-pane" id="profile" role="tabpanel" aria-expanded="false">
								<div class="text-center">
									<div class="upload-img">
										<div class="cloud">
											<span class="fa fa-cloud-download"></span>
										</div>
										<div class="text-under">
											<p class="big-text">Drag & Drop a File</p>
											<p>or select an option below</p>
										</div>
										<div class="btn-group">
											<button type="button" class="btn btn-success"><span class="fa fa-photo"></span></button>
											<button type="button" class="btn btn-primary"><span class="fa fa-video-camera"></span></button>
											<button type="button" class="btn btn-danger"><span class="fa fa-chain"></span></button>
										</div>
									</div>
								</div>
							</div>
						</div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-success">Save</button>
		            </div>
		        </div>
		    </div>
        </div>
       	<table class="table table-bordered table-striped table-md">
			<thead>
				<tr>
					<th><input type="checkbox" name="myTextEditBox" value="checked"></th>
					<th>ID</th>
					<th>Name</th>
					<th>UserName</th>
					<th>Email</th>
					<th>Status</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
			    <tr ng-repeat="p in person">
			        <td>
			            <input type="checkbox" name="myTextEditBox" value="checked" />
			        </td>
			        <td><%p.id%></td>
			        <td><%p.name%></td>
			        <td><%p.username%></td>
			        <td><%p.email%></td>
			        <td>
						<span ng-class ="{'badge badge-success': p.status=='Active','badge badge-secondary': p.status=='Inactive','badge badge-warning': p.status=='Pending','badge badge-danger': p.status=='Banned'}">
			        		<%p.status%>
			        	</span>
			        </td>
			        <td><%p.registrationdate%></td>
			    </tr>
			</tbody>
		</table>
		<nav>
            <ul class="pagination">
                <li class="page-item"><a class="page-link" data-target="#">Prev</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" data-target="#">1</a>
                </li>
                <li class="page-item"><a class="page-link" data-target="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" data-target="#">3</a>
                </li>
                <li class="page-item"><a class="page-link" data-target="#">4</a>
                </li>
                <li class="page-item"><a class="page-link" data-target="#">Next</a>
                </li>
            </ul>
        </nav>
	</div>
</section>
