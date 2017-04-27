<div>
	<!-- START: HEADER TOOLBAR -->
	<md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
	        <span>
			    Create/Edit Article Information
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
						          	<label>Title</label>
						          	<input ng-model="data.title" name="name" required ng-disabled="loading">
						          	<div ng-messages="siteForm.name.$error"
						          		 ng-show="siteForm.name.$dirty &&
						          		 	siteForm.name.$invalid">
							          	<div ng-message="required">Title is needed</div>
							        </div>
						        </md-input-container>
						    </div>
				      	</div>

				      	<div flex-gt-xs>
					         <div layout-padding-row="16" class="logo-container">
					         	<div class="logo-inner" layout="column" layout-align="center center"
					         		style="background-image: url('<% uploadingFile.src ? uploadingFile.src : data.primary_media.file_name %>')">

					         		<span class="icon-camera" ng-show="!data.primary_media"></span>
					         		<span class="upload-text" ng-show="!data.primary_media">Article Cover Logo Here</span>
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
			      	</div>

			      	<div layout-gt-xs="column" style="margin-top: 15px;">
			      		<md-tabs md-dynamic-height md-border-bottom>
			      			{{-- Detail Description --}}
					      	<md-tab label="detail">
					        	<md-content class="md-padding">
					          		<div layout-gt-xs="column">

			            	            <md-input-container flex-gt-xs>
			            	                <label>Order Number</label>
			            	                <input ng-model="data.seq_no" step="any" name="order" type="number">
			            		          	<div ng-messages="dialogFormType.order.$error"
			            		          		 ng-show="dialogFormType.order.$dirty && dialogFormType.order.$invalid">
			            			          	<div ng-message="invalid">Order number is not valid</div>
			            			        </div>
			            	            </md-input-container>
			            	            
								      	<md-input-container  flex-gt-xs>
							                <label>Short Description</label>
							                <textarea ng-model="data.short_description"
							                	style="min-height: 100px;"
							                	ng-disabled="loading" columns="1" name="shortDescription"
							                	md-maxlength="200"></textarea>
								      	</md-input-container>

								      	<md-input-container  flex-gt-xs>
							                <label>Description</label>
							                {{-- <textarea ng-model="data.description"
							                	style="min-height: 200px;"
							                	ng-disabled="loading" columns="1" name="description"
							                	md-maxlength="1000"></textarea> --}}
											<textarea name="post-editor"
												co-editor
												id="post-editor" ng-model="data.description" rows="10" 
												cols="80">
												Your text goes here!
											</textarea>
								      	</md-input-container>
							      	</div>
					        	</md-content>
					      	</md-tab>
				      		{{-- Media & Gallery --}}
				      		<md-tab label="gallery">
				        		<md-content class="md-padding">
				        			<h1 class="md-display-2">Media & Gallery </h1>

							      	<section layout="row" layout-sm="column"
							      		class="media-gallery"
							      		style="margin-top: 15px; margin-bottom: 15px;">
							      		<div class="media" flex="33">
							      			<div class="logo-inner" layout="column" layout-align="center center">
								         		<span class="icon-camera"></span>
								         		<span class="upload-text">Upload your gallery here</span>
								         		{{-- <span class="upload-text" ng-show="mode === 'create'">Please, save your listing first before upload</span> --}}
								         		<div class="overlay" ng-show="mode === 'edit'"></div>
								         	</div>
								         	<span class="icon-upload3 center"
								         		ngf-select ng-model="files" ngf-change="uploadMedia(files)"
								         		multiple="false">
								         	</span>
							      		</div>
							      		{{-- Media --}}
							      		<div class="media uploaded" flex="33" ng-repeat="media in data.photos">
							      			<div class="logo-inner" layout="column" layout-align="center center"
							      				style="background-image: url('<% media.file_name %>')">
								         		<div class="overlay"></div>
								         		<div class="remove icon-cross" ng-click="deletePhoto(media)"></div>
								         	</div>
								         	{{-- <span class="icon-search left" href="<% mediaUrl ? mediaUrl + media.file_name : '/' + media.file_name %>" data-title="<% data.name %>"></span> --}}
								         	<span class="icon-heart center" ng-class="{'selected': data.primary_photo_id == media.id}" href="javascript:void(0)" ng-click="updateCover(media, $event)" data-title="<% data.name %>"></span>
							      		</div>
							      		{{-- Pending --}}
							      		<div class="media" flex="33" ng-repeat="media in pendingFiles">
							      			<div class="logo-inner" layout="column" layout-align="center center"
							      				style="background-image: url('<% media.src %>')">
								         		<div class="overlay" ng-show="mode === 'edit'"></div>
								         		<md-progress-circular md-mode="determinate"
								         			ng-show="media.loading"
								         			value="<% media.progress %>"></md-progress-circular>
								         		<div ng-show="!media.loading" class="remove icon-cross" ng-click="deletePendingPhoto(media)"></div>
								         	</div>
							      		</div>
							      	</section>
				        		</md-content>
				      		</md-tab>
				    	</md-tabs>


						{{-- <div class="switch-active" ng-class="{'active': data.is_active}" style="margin-top: 25px;">
							<md-switch class="md-primary"  ng-disabled="loading" aria-label="Enable this listing"
								ng-model="data.is_active">
								<label>Make this listing active</label>
							</md-switch>
				        </div>	 --}}

				      	{{-- <md-input-container flex>
			                <label>Long Description</label>
			                <textarea ng-model="data.description" ng-disabled="loading" columns="1" name="description"
			                	style="min-height: 120px"
			                	md-maxlength="1200"></textarea>
				      	</md-input-container> --}}

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
