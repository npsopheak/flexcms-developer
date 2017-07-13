<md-dialog aria-label="Actvity Dialog" id="dialog-actvity"
    style="min-width: 650px;">
    <form name="dialogFormType" ng-submit="save($event)">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>View Actvity info for editing or creating</h2>
                <span flex></span>
                <md-button type="button" class="md-icon-button" ng-click="close()">
                    <md-icon md-font-icon="icon-cross" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content class="dimension-create">
            <div layout-gt-xs="column" style="margin-top: 15px;">
                <div style="margin-top: 15px;" layout-gt-xs="column">

                    <md-input-container flex-gt-xs>
                        <label>Name</label>
                        <input ng-model="data.name" name="name" required>
                        <div ng-messages="dialogFormType.name.$error"
                                ng-show="dialogFormType.name.$dirty && dialogFormType.name.$invalid">
                            <div ng-message="required">Name is required</div>
                        </div>
                    </md-input-container>

                    {{-- <md-input-container flex-gt-xs>
                        <label>Location</label>
                        <input placeholder="Location" ng-model="data.location" name="location">
                    </md-input-container>--}}

                    <md-input-container flex-gt-xs>
                        <label>Location:</label>
                        <md-select placeholder="Location" ng-model="data.location_id" 
                                style="padding-bottom: 0px;" flex-gt-xs>
                            <md-option value="">Select item type</md-option>
                            <md-option value="<% item.id %>" ng-repeat="(k, item) in locations"><% item.display_name %></md-option>
                        </md-select> 
                    </md-input-container>

                    <md-input-container flex-gt-xs>
                        <label>Activity Date (DD-MM-YYYY)</label>
                        <input placeholder="Activity Date" ng-model="data.activity_date" name="activity_date">
                    </md-input-container>

                    <md-input-container flex-gt-xs>
                        <label>Description</label>
                        <textarea placeholder="Description" ng-model="data.description" name="description"></textarea>
                    </md-input-container>

                    <md-input-container flex-gt-xs>
                        <label>Order Priority</label>
                        <input placeholder="Order Priority" ng-model="data.seq_no" name="seq_no">
                    </md-input-container>

                </div>
            </div>
        </md-dialog-content>
        <div class="md-actions" layout="row">
			<div layout="row"
				layout-align="space-around center" style="width: 100%">
	            <md-button type="button" ng-click="close()" class="md-primary">
	                Cancel
	            </md-button>
	            <md-button  type="submit" class="md-primary">
	                Save
	            </md-button>
			</div>
        </div>
    </form>
</md-dialog>
