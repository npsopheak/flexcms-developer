<section id="page-posts">


	<div class="listStaff">
		<div class="row headlabel">
			<h1 class="col-md-6">List All Staff</h1>
			<input type="text" class="form-group col-md-3" placeholder="Search Staff">
			<select class="form-group col-md-3">
				<option>team</option>
				<option>admin</option>
			</select>
		</div>
		<div class="row">

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
    </div>
</section>
