<md-dialog aria-label="Role Dialog" id="dialog-role"
    style="min-width: 650px;">
    <form name="dialogFormType" ng-submit="save($event)">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>View role info for editing or creating</h2>
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

                    <md-input-container flex-gt-xs>
                        <label>Email</label>
                        <input ng-model="data.email" name="email" type="text" required>
                        <div ng-messages="dialogFormType.email.$error"
                                ng-show="dialogFormType.email.$dirty && dialogFormType.email.$invalid">
                            <div ng-message="required">Email is required</div>
                        </div>
                    </md-input-container>

                    <md-input-container flex-gt-xs ng-if="!data.id">
                        <label>Password</label>
                        <input ng-model="data.password" name="password" required type="password">
                        <div ng-messages="dialogFormType.password.$error"
                                ng-show="dialogFormType.password.$dirty && dialogFormType.password.$invalid">
                            <div ng-message="required">Password is required</div>
                        </div>
                    </md-input-container>

                    <md-input-container flex-gt-xs ng-if="data.id">
                        <label>Change Password (Enter to change)</label>
                        <input ng-model="data.password" name="password" type="password">
                    </md-input-container>

                    <md-input-container flex-gt-xs>
                        <label>Role</label>
                        <md-select placeholder="Position" ng-model="data.role_id" 
                            style="padding-bottom: 0px;" flex-gt-xs>
                            <md-option value="">None</md-option>
                            <md-option value="<% item.id %>" ng-repeat="item in types"><% item.display_name %></md-option>
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
