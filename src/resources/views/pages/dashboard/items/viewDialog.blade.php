<md-dialog aria-label="Item Dialog" id="dialog-Item"
    style="min-width: 650px;">
    <form name="dialogFormType" ng-submit="save($event)">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>View Item info for editing or creating</h2>
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
                        <label>Display name</label>
                        <input ng-model="data.display_name" name="display_name" ng-change="onDisplayNameChange()" required>
                        <div ng-messages="dialogFormType.display_name.$error"
                                ng-show="dialogFormType.display_name.$dirty && dialogFormType.display_name.$invalid">
                            <div ng-message="required">Display name is required</div>
                        </div>
                    </md-input-container>

                    {{-- <md-input-container flex-gt-xs>
                        <label>Name</label>
                        <input placeholder="Name (Slug)" disabled="disabled" ng-model="data.name" name="name">
                    </md-input-container> --}}

                    <md-input-container flex-gt-xs>
                        <label>Description</label>
                        <textarea placeholder="Description" ng-model="data.description" name="description"></textarea>
                    </md-input-container>

                    <md-input-container flex-gt-xs>
                        <label>Order Priority</label>
                        <input placeholder="Order Priority" ng-model="data.seq_number" name="seq_number">
                    </md-input-container>

                    <md-input-container flex-gt-xs>
                        <label>Type:</label>
                        <md-select placeholder="Type" ng-model="data.item_type" 
                            style="padding-bottom: 0px;" flex-gt-xs>
                            <md-option value="">Select item type</md-option>
                            <md-option value="<% k %>" ng-repeat="(k, item) in item_types"><% item %></md-option>
                        </md-select> 
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
