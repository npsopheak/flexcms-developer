<md-dialog aria-label="Library Dialog" id="dialog-library"
    style="min-width: 650px;">
    <form name="dialogFormType" ng-submit="save($event)">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>View Library info for editing or creating</h2>
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
                        <label>Description</label>
                        <textarea placeholder="Description" ng-model="data.description" name="description"></textarea>
                    </md-input-container>

                    <md-input-container flex-gt-xs>
                        <label>Type</label>
                        <md-select placeholder="Type" ng-model="data.type_id" 
                            style="padding-bottom: 0px;" flex-gt-xs>
                            <md-option value="">None</md-option>
                            <md-option value="<% item.id %>" ng-repeat="item in types"><% item.display_name %></md-option>
                        </md-select> 
                    </md-input-container>

                    {{-- Upload khmer version --}}
                    {{--TODO CHANGE STYLE--}}
                    <div flex-gt-xs>
                        <div layout-padding-row="16" class="logo-container">
                            <div class="logo-inner" layout="column" layout-align="center center"
                                style="background-image: url('<% uploadingFile.src ? uploadingFile.src : data.primary_media.file_name %>')">

                                <span class="icon-camera" ng-show="!data.primary_media"></span>
                                <span class="upload-text" ng-show="!data.primary_media">Upload Khmer Version Here</span>
                                {{-- <span class="upload-text" ng-show="mode === 'create'">Please, save your listing first before upload</span> --}}
                                <div class="overlay"
                                    ng-class="{'show': uploadingFile.loading}"
                                    ng-show="mode === 'edit'"></div>
                                <md-progress-circular md-mode="determinate"
                                    ng-show="uploadingFile.loading"
                                    value="<% uploadingFile.progress %>"></md-progress-circular>
                            </div>
                            
                            {{-- <span class="icon-upload3" ng-class="{'center': !data.primary_media}" ng-show="!uploadingFile.loading"
                                ngf-select ng-model="files" ngf-change="uploadLogo(files)" multiple="false">
                            </span> --}}
                            <div class="center icon-remove-2 icon-cross selected" ng-show="data.primary_media" ng-click="deletePhotoLogo($event)"></div>

                        </div>
                    </div>

                    {{-- Upload english version --}}

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
