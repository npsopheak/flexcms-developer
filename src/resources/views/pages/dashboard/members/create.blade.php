<div>
	<!-- START: HEADER TOOLBAR -->
	<md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
	        <span>
			    Create/Edit Member Information
			</span>

        </h2>
        <span flex></span>
      </div>
    </md-toolbar>

    <!-- START: CONTENT DATA -->
    <md-content layout-padding="16" class="transparent-content">
		<md-content class="box-shadow-content">
			<form layout="row" layout-padding="16" name="enterpriseForm" layout-align="center center"
				ng-submit="submit()" ng-disabled="loading">
				<md-content style="width: 100%; max-width: 960px;"
					class="transparent-content enterprise-create">
					<div class="" layout-gt-xs="row">

				      	<div flex-gt-xs>
				      		<div layout-gt-xs="column">
					      		<md-input-container flex-gt-xs>
						          	<label>Member name</label>
						          	<input ng-model="data.name" name="name" required ng-disabled="loading">
						          	<div ng-messages="siteForm.name.$error"
						          		 ng-show="siteForm.name.$dirty &&
						          		 	siteForm.name.$invalid">
							          	<div ng-message="required">Member name is needed</div>
							        </div>
						        </md-input-container>
                                <md-input-container fake-md-no-float  flex-gt-xs>
							      	<md-icon md-font-icon="icon-mobile2" class="icon-contact"></md-icon>
							      	<input ng-model="data.phones" ng-disabled="loading" type="text" placeholder="Phone Number (required)" ng-required="false"  name="phone">
							    </md-input-container>
							    <md-input-container  flex-gt-xs>
							      	<!-- Use floating placeholder instead of label -->
							      	<md-icon md-font-icon="icon-envelop" class="email icon-contact"></md-icon>
							      	<input ng-model="data.emails" ng-disabled="loading"
							      		type="email" placeholder="Email" name="email"
							      		fake-ng-required="true">
							    </md-input-container>
							    <md-input-container  flex-gt-xs>
							      	<md-icon md-font-icon="icon-earth" class="icon-contact" style="display:inline-block;"></md-icon>
							      	<input ng-model="data.websites" ng-disabled="loading" type="text" placeholder="Website"  name="website">
							    </md-input-container>
							    <md-input-container  flex-gt-xs>
							      	<md-icon md-font-icon="icon-location2" class="icon-contact" style="display:inline-block;"></md-icon>
							      	<input ng-model="data.address" ng-disabled="loading" type="text" placeholder="Address (required)" name="address"
							      	ng-required="true">
							    </md-input-container>
						    </div>
				      	</div>

				      	<div flex-gt-xs>
					         <div layout-padding-row="16" class="logo-container">
					         	<div class="logo-inner" layout="column" layout-align="center center"
					         		style="background-image: url('<% uploadingFile.src ? uploadingFile.src : data.logo.file_name %>')">

					         		<span class="icon-camera" ng-show="!data.logo"></span>
					         		<span class="upload-text" ng-show="!data.logo">Member Logo Here</span>
					         		{{-- <span class="upload-text" ng-show="mode === 'create'">Please, save your listing first before upload</span> --}}
					         		<div class="overlay"
					         			ng-class="{'show': uploadingFile.loading}"
					         			ng-show="mode === 'edit'"></div>
					         		<md-progress-circular md-mode="determinate"
					         			ng-show="uploadingFile.loading"
					         			value="<% uploadingFile.progress %>"></md-progress-circular>
					         	</div>
					         	
					         	<span class="icon-upload3" ng-class="{'center': !data.logo}" ng-show="!uploadingFile.loading"
					         		ngf-select ng-model="files" ngf-change="uploadLogo(files)" multiple="false">
					         	</span>
					         	<div class="center icon-remove-2 icon-cross selected" ng-show="data.logo" ng-click="deletePhotoLogo($event)"></div>

					         </div>
									 <div layout-padding="16">
											<div layout-gt-xs="column">
												<md-input-container flex-gt-xs>
														<label>NGO Type:</label>
														<md-select placeholder="NGO Type" ng-model="data.category_id" 
																style="padding-bottom: 0px;" flex-gt-xs>
																<md-option value="">Select item type</md-option>
																<md-option value="<% item.id %>" ng-repeat="(k, item) in ngo_types"><% item.display_name %></md-option>
														</md-select> 
												</md-input-container>
												<md-input-container flex-gt-xs>
														<label>Project Type:</label>
														<md-select placeholder="Project Type" ng-model="data.project_type_id" 
																style="padding-bottom: 0px;" flex-gt-xs>
																<md-option value="">Select item type</md-option>
																<md-option value="<% item.id %>" ng-repeat="(k, item) in project_types"><% item.display_name %></md-option>
														</md-select> 
												</md-input-container>
												
											</div>
										</div>
				      	</div>
			      	</div>

			      	<div layout-gt-xs="column" style="margin-top: 15px;">
			      		<md-tabs md-dynamic-height md-border-bottom>
			      			{{-- Detail Description --}}
					      	<md-tab label="detail">
					        	<md-content class="md-padding">
					          		<div layout-gt-xs="column">

			            	            <md-input-container flex-gt-xs>
			            	                <label>Order Number</label>
			            	                <input ng-model="data.seq_no" step="any" name="order" type="number">
			            		          	<div ng-messages="dialogFormType.order.$error"
			            		          		 ng-show="dialogFormType.order.$dirty && dialogFormType.order.$invalid">
			            			          	<div ng-message="invalid">Order number is not valid</div>
			            			        </div>
			            	            </md-input-container>
			            	            
								      	<md-input-container  flex-gt-xs>
							                <label>Short Description</label>
							                <textarea ng-model="data.short_description"
							                	style="min-height: 100px;"
							                	ng-disabled="loading" columns="1" name="shortDescription"
							                	md-maxlength="200"></textarea>
								      	</md-input-container>

								      	<md-input-container  flex-gt-xs>
							                <label>Background</label>
							                <textarea ng-model="data.background"
							                	style="min-height: 200px;"
							                	ng-disabled="loading" columns="1" name="background"
							                	md-maxlength="1000"></textarea>
											{{-- <textarea name="post-editor"
												co-editor
												id="post-editor" ng-model="data.description" rows="10" 
												cols="80">
												Your text goes here!
											</textarea> --}}
								      	</md-input-container>

								      	<md-input-container  flex-gt-xs>
							                <label>Vision</label>
							                <textarea ng-model="data.vision"
							                	style="min-height: 200px;"
							                	ng-disabled="loading" columns="1" name="vision"
							                	md-maxlength="1000"></textarea>
								      	</md-input-container>

								      	<md-input-container  flex-gt-xs>
							                <label>Mission</label>
							                <textarea ng-model="data.mission"
							                	style="min-height: 200px;"
							                	ng-disabled="loading" columns="1" name="mission"
							                	md-maxlength="1000"></textarea>
								      	</md-input-container>
								      	<md-input-container  flex-gt-xs>
							                <label>Goal</label>
							                <textarea ng-model="data.goal"
							                	style="min-height: 200px;"
							                	ng-disabled="loading" columns="1" name="goal"
							                	md-maxlength="1000"></textarea>
								      	</md-input-container>
							      	</div>
					        	</md-content>
					      	</md-tab>
                  {{-- staff --}}
					      	<md-tab label="staff">
										{{-- staff toolbar --}}
					        	<md-toolbar class="md-table-toolbar alternate toolbar-selected-item" ng-show="staff_selected.length" aria-hidden="false"
									style="min-height: 45px;">
						          <div class="md-toolbar-tools layout-align-space-between-stretch" layout-align="space-between">
						            <div class="title"><% staff_selected.length %> items selected</div>
						            <div class="buttons" layout-align="end center">
						                <md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="staff_selected.length > 1"
						                    type="button" ng-click="editStaff($event)" aria-label="edit">
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														<md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="staff_selected.length > 1"
						                    type="button" ng-click="removeStaff($event)" aria-label="remove">
						                    <md-icon md-font-icon="icon-cancel-circle" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
						            </div>
						          </div>
						        </md-toolbar>
										{{-- staff table --}}
						        <md-table-container class="box-shadow-content">
						          <table md-table md-row-select ng-model="staff_selected" md-progress="promise">
						            <thead md-head md-order="query.order" md-on-reorder="items">
						              <tr md-row>
						                <th md-column md-order-by="nameToLower"><span>Staff Name</span></th>
						                <th md-column><span>Description</span></th>
						                <th md-column>Gender</th>
                                        <th md-column>Type</th>
						                <th md-column>Updated at</th>
						              </tr>
						            </thead>
						            <tbody md-body>
						              <tr md-row md-select="item" md-select-id="_id" md-auto-select ng-repeat="item in staffs">
						                <td md-cell><% item.name %></td>
						                <td md-cell><% item.description %></td>
						                <td md-cell><% item.gender == 'm' ? 'Male' : 'Female' %></td>
						                <td md-cell><% item.type.display_name %></td>
						                <td md-cell><% formatUtcDate(item.updated_at) %></td>
						              </tr>
													<tr md-row ng-show="staffs.length <= 0">
														<td md-cell colspan="4">There is no staff data.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addStaff($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
													<tr md-row ng-show="staffs.length > 0">
														<td md-cell colspan="4">Add more staff.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addStaff($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-plus" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
						            </tbody>
						          </table>
						        </md-table-container>
					      	</md-tab>
                  {{-- budget --}}
					      	<md-tab label="budget">
					        	<md-toolbar class="md-table-toolbar alternate toolbar-selected-item" ng-show="budget_selected.length" aria-hidden="false"
									style="min-height: 45px;">
						          <div class="md-toolbar-tools layout-align-space-between-stretch" layout-align="space-between">
						            <div class="title"><% budget_selected.length %> items selected</div>
						            <div class="buttons" layout-align="end center">
						                <md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="budget_selected.length > 1"
						                    type="button" ng-click="editBudget($event)" aria-label="edit">
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														<md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="budget_selected.length > 1"
						                    type="button" ng-click="removeBudget($event)" aria-label="remove">
						                    <md-icon md-font-icon="icon-cancel-circle" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
						            </div>
						          </div>
						        </md-toolbar>

						        <md-table-container class="box-shadow-content">
						          <table md-table md-row-select ng-model="budget_selected" md-progress="promise">
						            <thead md-head md-order="query.order" md-on-reorder="budgets">
						              <tr md-row>
						                <th md-column md-order-by="nameToLower"><span>Budget Year</span></th>
						                <th md-column><span>Organizational Budget</span></th>
						                <th md-column>Project cost</th>
														<th md-column>Admin cost</th>
														<th md-column>Other cost</th>
														<th md-column>Education Project Budget</th>
						                <th md-column>Updated at</th>
						              </tr>
						            </thead>
						            <tbody md-body>
						              <tr md-row md-select="item" md-select-id="_id" md-auto-select ng-repeat="item in budgets">
						                <td md-cell><% item.year %></td>
						                <td md-cell><% item.org_budget %></td>
						                <td md-cell><% item.project_cost %></td>
						                <td md-cell><% item.admin_cost %></td>
                            <td md-cell><% item.other_cost %></td>
														<td md-cell><% item.edu_project_cost %></td>
						                <td md-cell><% formatUtcDate(item.updated_at) %></td>
						              </tr>
													<tr md-row ng-show="budgets.length <= 0">
														<td md-cell colspan="6">There is no budget data.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addBudget($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
													<tr md-row ng-show="budgets.length > 0">
														<td md-cell colspan="6">Add more budget.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addBudget($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-plus" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
						            </tbody>
						          </table>
						        </md-table-container>
					      	</md-tab>
                            {{-- donor --}}
					      	<md-tab label="donor">
					        	<md-toolbar class="md-table-toolbar alternate toolbar-selected-item" ng-show="donor_selected.length" aria-hidden="false"
									style="min-height: 45px;">
						          <div class="md-toolbar-tools layout-align-space-between-stretch" layout-align="space-between">
						            <div class="title"><% donor_selected.length %> items selected</div>
						            <div class="buttons" layout-align="end center">
						                <md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="donor_selected.length > 1"
						                    type="button" ng-click="editDonor($event)" aria-label="edit">
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														<md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="donor_selected.length > 1"
						                    type="button" ng-click="removeDonor($event)" aria-label="remove">
						                    <md-icon md-font-icon="icon-cancel-circle" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
						            </div>
						          </div>
						        </md-toolbar>

						        <md-table-container class="box-shadow-content">
						          <table md-table md-row-select ng-model="donor_selected" md-progress="promise">
						            <thead md-head md-order="query.order" md-on-reorder="donors">
						              <tr md-row>
						                <th md-column md-order-by="nameToLower"><span>Donor Year</span></th>
						                <th md-column><span>Donor Name</span></th>
						                <th md-column>Description</th>
						                <th md-column>Updated at</th>
						              </tr>
						            </thead>
						            <tbody md-body>
						              <tr md-row md-select="item" md-select-id="_id" md-auto-select ng-repeat="item in donors">
						                <td md-cell><% item.year %></td>
						                <td md-cell><% item.name %></td>
						                <td md-cell><% item.description %></td>
						                <td md-cell><% formatUtcDate(item.updated_at) %></td>
						              </tr>
													<tr md-row ng-show="donors.length <= 0">
														<td md-cell colspan="3">There is no donor data.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addDonor($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
													<tr md-row ng-show="donors.length > 0">
														<td md-cell colspan="3">Add more donor.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addDonor($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-plus" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
						            </tbody>
						          </table>
						        </md-table-container>
					      	</md-tab>
                  {{-- activities --}}
					      	<md-tab label="activity">
					        	<md-toolbar class="md-table-toolbar alternate toolbar-selected-item" ng-show="activity_selected.length" aria-hidden="false"
									style="min-height: 45px;">
						          <div class="md-toolbar-tools layout-align-space-between-stretch" layout-align="space-between">
						            <div class="title"><% activity_selected.length %> items selected</div>
						            <div class="buttons" layout-align="end center">
						                <md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="activity_selected.length > 1"
						                    type="button" ng-click="editActivity($event)" aria-label="edit">
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														<md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="staff_selected.length > 1"
						                    type="button" ng-click="removeActivity($event)" aria-label="remove">
						                    <md-icon md-font-icon="icon-cancel-circle" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
						            </div>
						          </div>
						        </md-toolbar>

						        <md-table-container class="box-shadow-content">
						          <table md-table md-row-select ng-model="activity_selected" md-progress="promise">
						            <thead md-head md-order="query.order" md-on-reorder="donors">
						              <tr md-row>
						                <th md-column md-order-by="nameToLower"><span>Project Name</span></th>
						                <th md-column><span>Location</span></th>
						                <th md-column>Description</th>
                            <th md-column>Date</th>
						                <th md-column>Updated at</th>
						              </tr>
						            </thead>
						            <tbody md-body>
						              <tr md-row md-select="item" md-select-id="_id" md-auto-select ng-repeat="item in activities">
						                <td md-cell><% item.name %></td>
						                <td md-cell><% item.location_obj.display_name %></td>
						                <td md-cell><% item.description %></td>
                            <td md-cell><% item.activity_date %></td>
						                <td md-cell><% formatUtcDate(item.updated_at) %></td>
						              </tr>
													<tr md-row ng-show="activities.length <= 0">
														<td md-cell colspan="4">There is no activity data.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addActivity($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
													<tr md-row ng-show="activities.length > 0">
														<td md-cell colspan="4">Add more activity.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addActivity($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-plus" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
						            </tbody>
						          </table>
						        </md-table-container>
					      	</md-tab>
                  {{-- contact --}}
					      	<md-tab label="contact">
					        	<md-toolbar class="md-table-toolbar alternate toolbar-selected-item" ng-show="contact_selected.length" aria-hidden="false"
									style="min-height: 45px;">
						          <div class="md-toolbar-tools layout-align-space-between-stretch" layout-align="space-between">
						            <div class="title"><% contact_selected.length %> items selected</div>
						            <div class="buttons" layout-align="end center">
						                <md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="contact_selected.length > 1"
						                    type="button" ng-click="editContact($event)" aria-label="edit">
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														<md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="contact_selected.length > 1"
						                    type="button" ng-click="removeContact($event)" aria-label="remove">
						                    <md-icon md-font-icon="icon-cancel-circle" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
						            </div>
						          </div>
						        </md-toolbar>

						        <md-table-container class="box-shadow-content">
						          <table md-table md-row-select ng-model="contact_selected" md-progress="promise">
						            <thead md-head md-order="query.order" md-on-reorder="donors">
						              <tr md-row>
						                <th md-column md-order-by="nameToLower"><span>Name</span></th>
						                <th md-column><span>Position</span></th>
						                <th md-column>Email</th>
														<th md-column>Phone</th>
														<th md-column>Social Network</th>
						                <th md-column>Updated at</th>
						              </tr>
						            </thead>
						            <tbody md-body>
						              <tr md-row md-select="item" md-select-id="_id" md-auto-select ng-repeat="item in contacts">
						                <td md-cell><% item.name %></td>
						                <td md-cell><% item.position.display_name %></td>
						                <td md-cell><% item.email %></td>
														<td md-cell><% item.phone %></td>
														<td md-cell><% item.social_network %></td>
														<td md-cell><% formatUtcDate(item.updated_at) %></td>
						              </tr>
													<tr md-row ng-show="contacts.length <= 0">
														<td md-cell colspan="5">There is no contact data.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addContact($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
													<tr md-row ng-show="contacts.length > 0">
														<td md-cell colspan="5">Add more contact.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addContact($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-plus" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
						            </tbody>
						          </table>
						        </md-table-container>
					      	</md-tab>
									{{-- library --}}
					      	<md-tab label="library">
					        	<md-toolbar class="md-table-toolbar alternate toolbar-selected-item" ng-show="library_selected.length" aria-hidden="false"
									style="min-height: 45px;">
						          <div class="md-toolbar-tools layout-align-space-between-stretch" layout-align="space-between">
						            <div class="title"><% library_selected.length %> items selected</div>
						            <div class="buttons" layout-align="end center">
						                <md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="library_selected.length > 1"
						                    type="button" ng-click="editLibrary($event)" aria-label="edit">
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														<md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="library_selected.length > 1"
						                    type="button" ng-click="removeLibrary($event)" aria-label="remove">
						                    <md-icon md-font-icon="icon-cancel-circle" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
						            </div>
						          </div>
						        </md-toolbar>

						        <md-table-container class="box-shadow-content">
						          <table md-table md-row-select ng-model="library_selected" md-progress="promise">
						            <thead md-head md-order="query.order" md-on-reorder="donors">
						              <tr md-row>
						                <th md-column md-order-by="nameToLower"><span>Name</span></th>
						                <th md-column><span>Description</span></th>
						                <th md-column>English</th>
														<th md-column>Khmer</th>
														<th md-column>Downloads (Eng)</th>
														<th md-column>Downloads (Khm)</th>
						                <th md-column>Updated at</th>
						              </tr>
						            </thead>
						            <tbody md-body>
						              <tr md-row md-select="item" md-select-id="_id" md-auto-select ng-repeat="item in libraries">
						                <td md-cell><% item.name %></td>
						                <td md-cell><% item.description %></td>
						                <td md-cell style="<% item.document_english ? 'font-weight: bold': ''%>"><% item.document_english ? 'Yes' : 'No' %></td>
														<td md-cell style="<% item.document_khmer ? 'font-weight: bold': ''%>"><% item.document_khmer ? 'Yes' : 'No' %></td>
														<td md-cell style="<% item.document_english ? 'font-weight: bold': ''%>"><% item.document_english_download %></td>
														<td md-cell style="<% item.document_khmer ? 'font-weight: bold': ''%>"><% item.document_khmer_download %></td>
														<td md-cell><% formatUtcDate(item.updated_at) %></td>
						              </tr>
													<tr md-row ng-show="libraries.length <= 0">
														<td md-cell colspan="6">There is no library data.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addLibrary($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
													<tr md-row ng-show="libraries.length > 0">
														<td md-cell colspan="6">Add more library.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addLibrary($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-plus" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
						            </tbody>
						          </table>
						        </md-table-container>
					      	</md-tab>

									{{-- user --}}
					      	<md-tab label="user">
					        	<md-toolbar class="md-table-toolbar alternate toolbar-selected-item" ng-show="user_selected.length" aria-hidden="false"
									style="min-height: 45px;">
						          <div class="md-toolbar-tools layout-align-space-between-stretch" layout-align="space-between">
						            <div class="title"><% user_selected.length %> items selected</div>
						            <div class="buttons" layout-align="end center">
						                <md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="user_selected.length > 1"
						                    type="button" ng-click="editUser($event)" aria-label="edit">
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														<md-button class="md-icon-button md-button md-ink-ripple"
						                    ng-hide="user_selected.length > 1"
						                    type="button" ng-click="removeUser($event)" aria-label="remove">
						                    <md-icon md-font-icon="icon-cancel-circle" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
						            </div>
						          </div>
						        </md-toolbar>

						        <md-table-container class="box-shadow-content">
						          <table md-table md-row-select ng-model="user_selected" md-progress="promise">
						            <thead md-head md-order="query.order" md-on-reorder="users">
						              <tr md-row>
						                <th md-column md-order-by="nameToLower"><span>Name</span></th>
						                <th md-column>Email</th>
														<th md-column>Role</th>
						                <th md-column>Updated at</th>
						              </tr>
						            </thead>
						            <tbody md-body>
						              <tr md-row md-select="item" md-select-id="_id" md-auto-select ng-repeat="item in users">
						                <td md-cell><% item.name %></td>
						                <td md-cell><% item.email %></td>
														<td md-cell><% item.role.display_name %></td>
														<td md-cell><% formatUtcDate(item.updated_at) %></td>
						              </tr>
													<tr md-row ng-show="users.length <= 0">
														<td md-cell colspan="3">There is no user data.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addUser($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
													</tr>
													<tr md-row ng-show="users.length > 0">
														<td md-cell colspan="3">Add more user.</td>
														<td md-cell colspan="1">
															 <md-button class="md-primary md-button md-ink-ripple"
						                    type="button" ng-click="addUser($event)" aria-label="addStaff">
																Add
						                    <md-icon md-font-icon="icon-plus" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
						                </md-button>
														</td>
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
