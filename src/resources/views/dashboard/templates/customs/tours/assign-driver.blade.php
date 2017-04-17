<md-dialog aria-label="New Type" id="dialog-new-type">
    <form name="dialogFormType" ng-submit="save($event)">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>Assign tour order driver</h2>
                <span flex></span>
                <md-button type="button" class="md-icon-button" ng-click="close()">
                    <md-icon md-font-icon="icon-cross" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content class="dimension-create">
            <div layout-gt-xs="column" style="margin-top: 15px;">
              <md-tabs md-dynamic-height md-border-bottom>
                  {{-- Detail Description --}}
                    <md-tab label="detail">
                    	<div style="margin-top: 15px;" layout-gt-xs="column">
            	            <md-input-container flex-gt-xs>
            	                <label>Tour Name</label>
            	                <input ng-value="data.order.tour.name" name="display_name" required ng-disabled="true">
            	            </md-input-container>
            	            <md-input-container flex-gt-xs>
            	                <label>Customer</label>
            	                <input ng-value="data.order.contact_name" name="contact_name" required ng-disabled="true">
            	            </md-input-container>
            	                <label>Customer Phone</label>
            	                <input ng-value="data.order.contact_phone" name="contact_phone" required ng-disabled="true">
            	            </md-input-container>
            	            <md-input-container flex-gt-xs >
            	                <label>Remark</label>
            	                <textarea ng-model="data.order.remark" columns="1" name="description"></textarea>
            	            </md-input-container>

		                    <md-input-container flex-gt-xs>
		                        <label>Assign driver</label>
		                        <md-select placeholder="Assign driver" ng-model="data.driver_id" 
		                        style="padding-bottom: 0px;" flex-gt-xs>
			                        <md-option value="">None</md-option>
			                        <md-option value="<% driver._id %>" ng-repeat="driver in drivers"><% driver.profile.full_name %></md-option>
			                    </md-select>  
		                    </md-input-container>
                        </div>
                    </md-tab>

                </md-tab>
            </md-tabs>
        </div>
        </md-dialog-content>
        <div class="md-actions" layout="row">
			<div layout="row"
				layout-align="space-around center" style="width: 100%">
	            <md-button type="button" ng-click="close()" class="md-primary">
	                Cancel
	            </md-button>
	            <md-button  type="submit" class="md-primary">
	                Confirm save
	                {{-- <span ng-show="!data.driver">Confirm set requesting</span> --}}
	            </md-button>
			</div>
        </div>
    </form>
</md-dialog>
