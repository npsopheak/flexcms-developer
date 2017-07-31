<div>
	<!-- START: HEADER TOOLBAR -->
	<md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
	        <span>
			    Create/Edit User Information
			</span>

        </h2>
        <span flex></span>
      </div>
    </md-toolbar>

    <!-- START: CONTENT DATA -->
    <md-content layout-padding="16" class="transparent-content">
		<md-content class="box-shadow-content">
			<form layout="row" layout-padding="16" name="userForm" layout-align="center center"
				ng-submit="submit()" ng-disabled="loading">
				<md-content style="width: 100%; max-width: 960px;"
					class="transparent-content enterprise-create">
					<div class="" layout-gt-xs="row">

				      	<div flex-gt-xs>
				      		<div layout-gt-xs="row">
					      		<md-input-container flex-gt-xs flex="33">
						          	<label>Name</label>
						          	<input ng-model="data.name" name="name" required ng-disabled="loading">
						          	<div ng-messages="userForm.name.$error"
						          		 ng-show="userForm.name.$dirty &&
						          		 	userForm.name.$invalid">
							          	<div ng-message="required">Name is needed</div>
							        </div>
						        </md-input-container>
                                <md-input-container flex-gt-xs flex="33">
                                    <label>Username</label>
						          	<input ng-model="data.email" name="username" required ng-disabled="loading">
						          	<div ng-messages="userForm.username.$error"
						          		 ng-show="userForm.username.$dirty &&
						          		 	userForm.username.$invalid">
							          	<div ng-message="required">Username is needed</div>
							        </div>
                                </md-input-container>
								<md-input-container flex-gt-xs flex="33">
									<label>Role</label>
									<md-select ng-model="data.role" name="role" required ng-disabled="loading || session.id == data.id">
										<md-option value="">Select a term</md-option>
										<md-option value="admin">Admin</md-option>
										<md-option value="user">User</md-option>
										<md-option value="hr-admin">HR Admin</md-option>
									</md-select>
								</md-input-container>
                                

						    </div>
				      	</div>

				      	<!-- <div flex-gt-xs>
					    </div> -->
			      	</div>
					<div class="" layout-gt-xs="column" ng-if="!data.id">
						<div flex-gt-xs>
							<div layout-gt-xs="row">
					      		<md-input-container flex-gt-xs flex="33">
						          	<label>Password</label>
						          	<input type="password" ng-model="data.password" name="password" required ng-disabled="loading">
						        </md-input-container>
					      		<md-input-container flex-gt-xs flex="33">
						          	<label>New Password</label>
						          	<input type="password" ng-model="data.password_confirm" name="password_confirm" required ng-disabled="loading">
						        </md-input-container>
                                <md-input-container flex-gt-xs flex="33"></md-input-container>
							</div>
					    </div>
					</div>
					<div class="" layout-gt-xs="column" ng-if="data.id">
						<div flex-gt-xs>
							<div layout-gt-xs="row">
					      		<md-input-container flex-gt-xs>
						          	<label>Old Password</label>
						          	<input type="password" ng-model="data.old_password" name="password" ng-disabled="loading">
						        </md-input-container>
					      		<md-input-container flex-gt-xs>
						          	<label>New Password to change</label>
						          	<input type="password" ng-model="data.password" name="new_password" ng-disabled="loading">
						        </md-input-container>
					      		<md-input-container flex-gt-xs>
						          	<label>Confirm New Password</label>
						          	<input type="password" ng-model="data.password_confirmation" name="new_password_confirm" ng-disabled="loading">
						        </md-input-container>
							</div>
					    </div>
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
