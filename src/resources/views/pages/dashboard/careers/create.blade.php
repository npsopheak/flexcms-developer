<div>
	<!-- START: HEADER TOOLBAR -->
	<md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
	        <span>
			    Create/Edit Career Information
			</span>

        </h2>
        <span flex></span>
      </div>
    </md-toolbar>

    <!-- START: CONTENT DATA -->
    <md-content layout-padding="16" class="transparent-content">
		<md-content class="box-shadow-content">
			<form layout="row" layout-padding="16" name="jobForm" layout-align="center center"
				ng-submit="submit()" ng-disabled="loading">
				<md-content style="width: 100%; max-width: 960px;"
					class="transparent-content enterprise-create">
					<div class="" layout-gt-xs="row">

				      	<div flex-gt-xs>
				      		<div layout-gt-xs="column">
					      		<md-input-container flex-gt-xs>
						          	<label>Job title</label>
						          	<input ng-model="data.name" name="name" required ng-disabled="loading">
						          	<div ng-messages="jobForm.name.$error"
						          		 ng-show="jobForm.name.$dirty &&
						          		 	jobForm.name.$invalid">
							          	<div ng-message="required">Job title is needed</div>
							        </div>
						        </md-input-container>
								<md-input-container flex-gt-xs>
									<label>Job Term</label>
									<md-select ng-model="data.job_term" name="job_term" required ng-disabled="loading">
										<md-option value="">Select a term</md-option>
										<md-option value="full-time">Full Time</md-option>
										<md-option value="part-time">Part Time</md-option>
										<md-option value="intern">Intern</md-option>
									</md-select>
								</md-input-container>

						    </div>
				      	</div>

				      	<!-- <div flex-gt-xs>
					    </div> -->
			      	</div>
					<div class="" layout-gt-xs="column">

						<div flex-gt-xs>
							<div layout-gt-xs="row">
					      		<md-input-container flex-gt-xs>
						          	<label>Job Location</label>
						          	<input ng-model="data.location" name="location" required ng-disabled="loading">
						          	<div ng-messages="jobForm.location.$error"
						          		 ng-show="jobForm.location.$dirty &&
						          		 	jobForm.location.$invalid">
							          	<div ng-message="required">Job location is needed</div>
							        </div>
						        </md-input-container>

					      		<md-input-container flex-gt-xs>
						          	<label>Closing date</label>
						          	<input ng-model="data.closing_date" name="closing_date" required ng-disabled="loading">
						          	<div ng-messages="jobForm.closing_date.$error"
						          		 ng-show="jobForm.closing_date.$dirty &&
						          		 	jobForm.closing_date.$invalid">
							          	<div ng-message="required">Job closing_date is needed</div>
							        </div>
						        </md-input-container>
					      		<md-input-container flex-gt-xs>
						          	<label>Number of Hiring</label>
						          	<input ng-model="data.number_hire" name="number_hire" required ng-disabled="loading">
						        </md-input-container>
							</div>
					    </div>
						<div flex-gt-xs>
							<div layout-gt-xs="row">
					      		<md-input-container flex-gt-xs>
						          	<label>Experience</label>
						          	<input ng-model="data.experience" name="experience" required ng-disabled="loading">
						        </md-input-container>
					      		<md-input-container flex-gt-xs>
						          	<label>Age from</label>
						          	<input ng-model="data.age_from" name="age_from" ng-disabled="loading">
						        </md-input-container>
					      		<md-input-container flex-gt-xs>
						          	<label>Age to</label>
						          	<input ng-model="data.age_to" name="age_to" ng-disabled="loading">
						        </md-input-container>
							</div>
					    </div>
						<div flex-gt-xs>
							<div layout-gt-xs="row">
					      		<md-input-container flex-gt-xs>
									<label>Gender</label>
									<md-select ng-model="data.gender" name="gender" required ng-disabled="loading">
										<md-option value="">Select a gender</md-option>
										<md-option value="Male">Male</md-option>
										<md-option value="Female">Female</md-option>
									</md-select>
								</md-input-container>
							</div>
					    </div>
					</div>

			      	<div layout-gt-xs="column" style="margin-top: 15px;">
			      		<md-tabs md-dynamic-height md-border-bottom>
			      			{{-- Detail Description --}}
					      	<md-tab label="detail">
					        	<md-content class="md-padding">
					          		<div layout-gt-xs="column">

										<md-input-container  flex-gt-xs>
							                <label>Qualification</label>
							                <textarea ng-model="data.qualification"
							                	style="min-height: 100px;"
							                	ng-disabled="loading" columns="1" name="qualification"
							                	md-maxlength="200"></textarea>
								      	</md-input-container>
			            	            
								      	{{-- <md-input-container  flex-gt-xs>
							                <label>Description</label>
							                <textarea ng-model="data.description"
							                	style="min-height: 100px;"
							                	ng-disabled="loading" columns="1" name="description"
							                	md-maxlength="200"></textarea>
								      	</md-input-container> --}}
										<md-input-container  flex-gt-xs>
											<label style="margin-bottom: 40px;">Responsibility</label>
											<textarea name="post-editor"
												co-editor
												id="res-editor" ng-model="data.responsibility" rows="10" 
												cols="80">
											</textarea>
										</md-input-container>
										<md-input-container  flex-gt-xs>
											<label style="margin-bottom: 40px;">Requirement</label>
											<textarea name="post-editor"
												co-editor
												id="requirement-editor" ng-model="data.requirement" rows="10" 
												cols="80">
											</textarea>
										</md-input-container>


			            	            <md-input-container flex-gt-xs>
			            	                <label>Order Number</label>
			            	                <input ng-model="data.seq_no" step="any" name="order" type="number">
			            		          	<div ng-messages="dialogFormType.order.$error"
			            		          		 ng-show="dialogFormType.order.$dirty && dialogFormType.order.$invalid">
			            			          	<div ng-message="invalid">Order number is not valid</div>
			            			        </div>
			            	            </md-input-container>
							      	</div>
					        	</md-content>
					      	</md-tab>
							{{-- Candidate listing --}}
							<md-tab label="candidates">
								<md-toolbar class="md-table-toolbar alternate toolbar-selected-item" ng-show="selected.length" aria-hidden="false"
										style="min-height: 45px;">
									<div class="md-toolbar-tools layout-align-space-between-stretch" layout-align="space-between">
										<div class="title"><% selected.length %> items selected</div>
										<div class="buttons" layout-align="end center">
											<md-button class="md-icon-button md-button md-ink-ripple"
												ng-hide="selected.length > 1"
												type="button" ng-click="showDetail($event)" aria-label="edit">
												<md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
											</md-button>
										</div>
									</div>
									</md-toolbar>

									<md-table-container class="box-shadow-content">
										<table md-table md-row-select ng-model="selected" md-progress="promise">
											<thead md-head md-order="query.order" md-on-reorder="listing">
												<tr md-row>
													<th md-column><span>No</span></th>
													<th md-column><span>Candidate</span></th>
													<th md-column><span>Phone</span></th>
													<th md-column><span>Email</span></th>
													<th md-column><span>Comment</span></th>
													<th md-column>Created at</th>
													<th md-column>
														Status
													</th>
												</tr>
												</thead>
												<tbody md-body>
												<tr md-row md-select="item" md-select-id="id" md-auto-select ng-repeat="item in candidates">
													<td md-cell>
														<% $index + 1 %>
													</td>
													<td md-cell><% item.full_name %></td>
													<td md-cell><% item.phone_number %></td>
													<td md-cell><% item.email %></td>
													<td md-cell><% item.comment %></td>
													<td md-cell><% formatUtcDate(item.created_at) %></td>
													<td md-cell>
														<span ng-show="item.status == 'active'">Active</span>
														<span ng-show="item.status == 'inactive'">Inactive</span>
														<span ng-show="item.status == 'shortlisted'">Shortlisted</span>
													</td>
												</tr>
												<tr md-row ng-show="!data.length">
													<td md-cell colspan="9">There is no jobs data</td>
												</tr>
												</tbody>
										</table>
									</md-table-container>
								</md-tab>
				    	</md-tabs>

			      	</div>

			        <section layout="row" layout-sm="column"
			        	style="margin-top: 15px; margin-bottom: 15px;">
			        	<section layout="row" layout-sm="column" layout-align="start center" flex="50">
			        		<md-button class="md-raised md-primary" type="submit"
				      			fng-click="save($event)">Save</md-button>
			        		<md-button class="md-raised md-danger" type="button"
				      			ng-click="delete($event)">Delete</md-button>
			        	</section>
			        </section>
			    </md-content>
		    </form>
	    </md-content>
    </md-content>
</div>
