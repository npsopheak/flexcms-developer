<section id="page-posts">


	<div class="listStaff">
		<div class="row">
			<h1 class="col-md-6">List All Staff</h1>
			<div class="form-group col-md-3">
				<input type="text" class="form-control " placeholder="Search Staff">
			</div>
			<div class="form-group col-md-3">
				<select class="form-control ">
					<option>team</option>
					<option>admin</option>
				</select>
			</div>
		</div>
		 <div class="card-body">
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
		                <div class="form-group">
							<input class="form-control">
								
							</input>
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		                <button type="button" class="btn btn-success">Save</button>
		            </div>
		        </div>
		    </div>
        </div>
       <table class="table table-bordered  table-striped">
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
	</div>
</section>
