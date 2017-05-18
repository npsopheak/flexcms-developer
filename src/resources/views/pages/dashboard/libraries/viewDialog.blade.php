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

                    <md-input-container flex-gt-xs>
                        <p>Document in Khmer</p>
                        <div class="document-group" layout-gt-xs="row">
                            <div flex-gt-xs flex="20" class="document-preview">

                                <div flex-gt-xs style="background-image: url('<% uploadingFile_document_khmer_id.src ? uploadingFile_document_khmer_id.src : data.document_khmer.file_name %>')">
                                    
                                </div>
                            </div>
                            <div flex-gt-xs flex="80" class="document-description">
                                <div layout-gt-xs="column">
                                    <div flex-gt-xs class="document-name" >
                                        <span ng-show="data.document_khmer && !uploadingFile_document_khmer_id" ng-init="splitItem = data.document_khmer.file_name.split('/')">
                                            Filename: <% splitItem[splitItem.length - 1] %>
                                        </span>
                                        <span ng-show="!data.document_khmer && !uploadingFile_document_khmer_id">
                                            Upload new file
                                        </span>

                                        <span ng-show="uploadingFile_document_khmer_id">
                                            New file selected: <% uploadingFile_document_khmer_id.file.name %>
                                        </span>

                                        <br>
                                        <span class="" style="font-size: 12px; color: gray">
                                            Size: <% data.document_khmer ? data.document_khmer.content_length / 1024 : '(TBD)' %> KB
                                        </span>
                                    </div>
                                    <div flex-gt-xs class="document-progress"
                                        ng-show="uploadingFile_document_khmer_id.loading">
                                        <div class="document-progress-bar">
                                            <div class="bar-inner" style="width: <% uploadingFile_document_khmer_id.progress %>%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div flex-gt-xs flex="20" class="document-action">
                                <div layout-gt-xs="column">

                                    <md-button  type="button" class="md-primary"
                                        ng-if="!data.document_khmer"
                                        ngf-select ng-model="files" ngf-change="uploadDocument(files, 'document_khmer_id', $event)" multiple="false">
                                        Upload
                                    </md-button>

                                    <md-button  type="button" class="md-primary"
                                        ng-if="data.document_khmer"
                                        ngf-select ng-model="files" ngf-change="uploadDocument(files, 'document_khmer_id', $event)" multiple="false">
                                        Replace
                                    </md-button>

                                    <md-button  type="button" class="md-primary"
                                        ng-click="previewDocument(data.document_khmer)"
                                        ng-if="data.document_khmer">
                                        Preview
                                    </md-button>

                                    <md-button  type="button" class="md-primary"
                                        ng-if="data.document_khmer" 
                                        ng-click="deleteKhmerDocument(null, $event)">
                                        Remove
                                    </md-button>
                                </div>
                            </div>
                        </div>
                    </md-input-container>
                    

                    {{-- Upload english version --}}
                    <md-input-container flex-gt-xs>
                        <p>Document in English</p>
                        <div class="document-group" layout-gt-xs="row">
                            <div flex-gt-xs flex="20" class="document-preview">

                                <div flex-gt-xs style="background-image: url('<% uploadingFile_document_english_id.src ? uploadingFile_document_english_id.src : data.document_english.file_name %>')">
                                    
                                </div>
                            </div>
                            <div flex-gt-xs flex="80" class="document-description">
                                <div layout-gt-xs="column">
                                    <div flex-gt-xs class="document-name" >
                                        <span ng-show="data.document_english && !uploadingFile_document_english_id" ng-init="splitItem = data.document_english.file_name.split('/')">
                                            Filename: <% splitItem[splitItem.length - 1] %>
                                        </span>
                                        <span ng-show="!data.document_english && !uploadingFile_document_english_id">
                                            Upload new file
                                        </span>

                                        <span ng-show="uploadingFile_document_english_id">
                                            New file selected: <% uploadingFile_document_english_id.file.name %>
                                        </span>

                                        <br>
                                        <span class="" style="font-size: 12px; color: gray">
                                            Size: <% data.document_english ? data.document_english.content_length / 1024 : '(TBD)' %> KB
                                        </span>
                                    </div>
                                    <div flex-gt-xs class="document-progress"
                                        ng-show="uploadingFile_document_english_id.loading">
                                        <div class="document-progress-bar">
                                            <div class="bar-inner" style="width: <% uploadingFile_document_english_id.progress %>%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div flex-gt-xs flex="20" class="document-action">
                                <div layout-gt-xs="column">

                                    <md-button  type="button" class="md-primary"
                                        ng-if="!data.document_english"
                                        ngf-select ng-model="files" ngf-change="uploadDocument(files, 'document_english_id', $event)" multiple="false">
                                        Upload
                                    </md-button>

                                    <md-button  type="button" class="md-primary"
                                        ng-if="data.document_english"
                                        ngf-select ng-model="files" ngf-change="uploadDocument(files, 'document_english_id', $event)" multiple="false">
                                        Replace
                                    </md-button>

                                    <md-button  type="button" class="md-primary"
                                        ng-click="previewDocument(data.document_english)"
                                        ng-if="data.document_english">
                                        Preview
                                    </md-button>

                                    <md-button  type="button" class="md-primary"
                                        ng-if="data.document_english" 
                                        ng-click="deleteEnglishDocument(null, $event)">
                                        Remove
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
	                Cancel
	            </md-button>
	            <md-button  type="submit" class="md-primary">
	                Save
	            </md-button>
			</div>
        </div>
    </form>
</md-dialog>
