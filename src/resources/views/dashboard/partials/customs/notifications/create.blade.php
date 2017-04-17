<div>
	<!-- START: HEADER TOOLBAR -->
	<md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
	        <span>
			    Create/Edit Notification Information
			</span>

        </h2>
        <span flex></span>
      </div>
    </md-toolbar>

    <!-- START: CONTENT DATA -->
    <md-content layout-padding="16" class="transparent-content">
		<md-content class="box-shadow-content">
			<form layout="row" layout-padding="16" name="enterpriseForm" layout-align="center center"
				ng-submit="submit()" ng-disabled="loading">
				<md-content style="width: 100%; max-width: 960px;"
					class="transparent-content enterprise-create">
					<div class="" layout-gt-xs="row">

				      	<div flex-gt-xs>
				      		<div layout-gt-xs="column">
					      		<md-input-container flex-gt-xs>
						          	<label>Notification Title</label>
						          	<input ng-model="data.title" name="title" required ng-disabled="loading">
						          	<div ng-messages="siteForm.title.$error"
						          		 ng-show="siteForm.title.$dirty &&
						          		 	siteForm.title.$invalid">
							          	<div ng-message="required">Notification title is needed</div>
							        </div>
						        </md-input-container>

					      		<md-input-container flex-gt-xs>
						          	<label>Notification Subtitle</label>
						          	<input ng-model="data.subtitle" name="subtitle" required ng-disabled="loading">
						          	<div ng-messages="siteForm.subtitle.$error"
						          		 ng-show="siteForm.subtitle.$dirty &&
						          		 	siteForm.subtitle.$invalid">
							          	<div ng-message="required">Notification subtitle is needed</div>
							        </div>
						        </md-input-container>

					      		<md-input-container flex-gt-xs>
						          	<label>Media Type</label>
							         <md-select ng-model="data.media_type" placeholder="Media type" class="md-no-underline">
										<md-option value="">Select media type</md-option>
										<md-option value="image">Image</md-option>
										<md-option value="video">Video</md-option>
							        </md-select>
						        </md-input-container>

					      		<md-input-container flex-gt-xs>
						          	<label>Video Url</label>
						          	<input ng-model="data.video_url" name="video_url" ng-disabled="loading">
						        </md-input-container>

						      	<md-input-container  flex-gt-xs>
					                <label>Description</label>
					                <textarea ng-model="data.description"
					                	style="min-height: 200px;"
					                	ng-disabled="loading" columns="1" name="description"
					                	md-maxlength="1000"></textarea>
						      	</md-input-container>

						    </div>
				      	</div>

				      	{{-- Start: Logo block --}}
				      	<div flex-gt-xs>
					         <div layout-padding-row="16" class="logo-container">
					         	<div class="logo-inner" layout="column" layout-align="center center"
					         		style="background-image: url('<% uploadingFile.src ? uploadingFile.src : data.image.thumbnail_url_link %>')">

					         		<span class="icon-camera" ng-show="!data.image"></span>
					         		<span class="upload-text" ng-show="!data.image">Promotion Logo Here</span>
					         		{{-- <span class="upload-text" ng-show="mode === 'create'">Please, save your listing first before upload</span> --}}
					         		<div class="overlay"
					         			ng-class="{'show': uploadingFile.loading}"
					         			ng-show="mode === 'edit'"></div>
					         		<md-progress-circular md-mode="determinate"
					         			ng-show="uploadingFile.loading"
					         			value="<% uploadingFile.progress %>"></md-progress-circular>
					         	</div>
					         	
					         	<span class="icon-upload3" ng-class="{'center': !data.image }" ng-show="!uploadingFile.loading"
					         		ngf-select ng-model="files" ngf-change="uploadLogo(files)" multiple="false">
					         	</span>
					         	<div class="right icon-remove-2 icon-cross selected" ng-show="data.image" ng-click="deletePhotoLogo($event)"></div>
					         </div>
							 
				      	</div>
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
