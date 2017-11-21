<md-dialog aria-label="Candidate Dialog" id="dialog-candidate"
    style="min-width: 650px;">
    <form name="dialogFormType" ng-submit="save($event)">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>View candidate document</h2>
                <span flex></span>
                <md-button type="button" class="md-icon-button" ng-click="close()">
                    <md-icon md-font-icon="icon-cross" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>
        <md-dialog-content class="dimension-create">
            <div layout-gt-xs="column" style="margin-top: 15px;">
                <div layout-gt-xs="column">

                    <p>
                        <% data.comment || 'There are no comment' %>
                    </p>

                    <md-input-container flex-gt-xs ng-repeat="item in data.attachments">
                        <p><% item.caption %></p>
                        <div class="document-group" layout-gt-xs="row">
                            <div flex-gt-xs flex="20" class="document-preview">

                                <div flex-gt-xs style="background-image: url('<% item.file_name %>')">
                                    
                                </div>
                            </div>
                            <div flex-gt-xs flex="80" class="document-description">
                                <div layout-gt-xs="column">
                                    <div flex-gt-xs class="document-name" >
                                        <span>
                                            Filename: <% item.caption %>
                                        </span>

                                        <br>
                                        <span class="" style="font-size: 12px; color: gray">
                                            Size: <% item.content_length / 1024 %> KB
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div flex-gt-xs flex="20" class="document-action">
                                <div layout-gt-xs="column">
                                    <md-button  type="button" class="md-primary"
                                        ng-click="previewDocument(item.file_name)">
                                        Preview
                                    </md-button>

                                </div>
                            </div>
                        </div>
                    </md-input-container>

                </div>
            </div>
        </md-dialog-content>
        <div class="md-actions" layout="row">
			<div layout="row"
				layout-align="space-around center" style="width: 100%">
	            <md-button type="button" ng-click="close()" class="md-primary">
	                Close
	            </md-button>
	            
			</div>
        </div>
    </form>
</md-dialog>
