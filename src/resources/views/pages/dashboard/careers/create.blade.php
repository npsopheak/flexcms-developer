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
									</md-select>
								</md-input-container>

						    </div>
				      	</div>

				      	<!-- <div flex-gt-xs>
					    </div> -->
			      	</div>
					<div class="" layout-gt-xs="row">

						<div flex-gt-xs>
							<div layout-gt-xs="column">
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
							</div>
					    </div>
						<div flex-gt-xs>
							<div layout-gt-xs="column">
					      		<md-input-container flex-gt-xs>
						          	<label>Experience</label>
						          	<input ng-model="data.experience" name="experience" required ng-disabled="loading">
						        </md-input-container>
					      		<md-input-container flex-gt-xs>
						          	<label>Number of Hiring</label>
						          	<input ng-model="data.number_hire" name="number_hire" required ng-disabled="loading">
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

			            	            <md-input-container flex-gt-xs>
			            	                <label>Order Number</label>
			            	                <input ng-model="data.seq_no" step="any" name="order" type="number">
			            		          	<div ng-messages="dialogFormType.order.$error"
			            		          		 ng-show="dialogFormType.order.$dirty && dialogFormType.order.$invalid">
			            			          	<div ng-message="invalid">Order number is not valid</div>
			            			        </div>
			            	            </md-input-container>
			            	            
								      	<md-input-container  flex-gt-xs>
							                <label>Description</label>
							                <textarea ng-model="data.description"
							                	style="min-height: 100px;"
							                	ng-disabled="loading" columns="1" name="description"
							                	md-maxlength="200"></textarea>
								      	</md-input-container>
							      	</div>
					        	</md-content>
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
