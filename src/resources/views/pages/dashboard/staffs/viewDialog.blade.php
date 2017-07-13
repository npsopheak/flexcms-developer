<md-dialog aria-label="Staff Dialog" id="dialog-staff"
    style="min-width: 650px;">
    <form name="dialogFormType" ng-submit="save($event)">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>View staff info for editing or creating</h2>
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
                        <label>Staff Type</label>
                        <md-select placeholder="Staff Type" ng-model="data.type_id" 
                            style="padding-bottom: 0px;" flex-gt-xs>
                            <md-option value="">None</md-option>
                            <md-option value="<% item.id %>" ng-repeat="item in types"><% item.display_name %></md-option>
                        </md-select> 
                    </md-input-container>

                    <md-input-container flex-gt-xs >
                        <label>Quantity</label>
                        <input ng-model="data.quantity" name="quantity" required>
                    </md-input-container>

                    <md-input-container flex-gt-xs >
                        <label>Female Quantity</label>
                        <input ng-model="data.female_quantity" name="female_quantity" required>
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
