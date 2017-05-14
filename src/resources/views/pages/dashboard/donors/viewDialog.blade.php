<md-dialog aria-label="Donor Dialog" id="dialog-donor"
    style="min-width: 650px;">
    <form name="dialogFormType" ng-submit="save($event)">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>View donor info for editing or creating</h2>
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
                        <label>Year:</label>
                        <md-select placeholder="Type" ng-model="data.year" 
                            style="padding-bottom: 0px;" flex-gt-xs required>
                            <md-option value="">Select year type</md-option>
                            <md-option value="This Year">This Year</md-option>
                            <md-option value="Last Year">Last Year</md-option>
                        </md-select> 
                        <div ng-messages="dialogFormType.year.$error"
                                ng-show="dialogFormType.year.$dirty && dialogFormType.year.$invalid">
                            <div ng-message="required">Year is required</div>
                        </div>
                    </md-input-container>

                    <md-input-container flex-gt-xs>
                        <label>Donor Name</label>
                        <input placeholder="Donor Name" ng-model="data.name" name="name">
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
