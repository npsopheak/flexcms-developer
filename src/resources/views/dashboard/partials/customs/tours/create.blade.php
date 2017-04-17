<div>
	<!-- START: HEADER TOOLBAR -->
	<md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
	        <span>
			    Create/Edit Tour Information
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
						          	<label>Tour Name</label>
						          	<input ng-model="data.name" name="name" required ng-disabled="loading">
						          	<div ng-messages="siteForm.name.$error"
						          		 ng-show="siteForm.name.$dirty &&
						          		 	siteForm.name.$invalid">
							          	<div ng-message="required">Tour name is needed</div>
							        </div>
						        </md-input-container>
						      	
							    <md-input-container  flex-gt-xs>
							      	<!-- Use floating placeholder instead of label -->
							      	<md-icon md-font-icon="icon-users" class="email icon-contact"></md-icon>
							      	<input ng-model="data.people_allowance" ng-disabled="loading"
							      		type="people_allowance" placeholder="People Allowance" name="text"
							      		fake-ng-required="true">
							    </md-input-container>

							    <md-input-container  flex-gt-xs>
							      	<md-icon md-font-icon="icon-calendar" class="icon-contact" style="display:inline-block;"></md-icon>
							      	<input ng-model="data.start_time_string" ng-disabled="loading" type="text" placeholder="Time"  name="start_time_string">
							    </md-input-container>

							    <md-input-container  flex-gt-xs>
							      	<md-icon md-font-icon="icon-coin-dollar" class="icon-contact" style="display:inline-block;"></md-icon>
							      	<input ng-model="data.price" ng-disabled="loading" type="text" placeholder="Price"  name="price">
							    </md-input-container>

							    <md-input-container  flex-gt-xs>
							      	<md-icon md-font-icon="icon-hour-glass" class="icon-contact" style="display:inline-block;"></md-icon>
							      	<input ng-model="data.duration" ng-disabled="loading" type="text" placeholder="Duration (hrs)"  name="duration">
							    </md-input-container>

							    <md-input-container  flex-gt-xs>
							      	<md-icon md-font-icon="icon-location2" class="icon-contact" style="display:inline-block;"></md-icon>
							      	<input ng-model="data.location" ng-disabled="loading" type="text" placeholder="Location description (required)" name="location"
							      	ng-required="true">
							    </md-input-container>

							    <md-input-container flex-gt-xs>
	            	                <md-icon md-font-icon="icon-sort-numeric-asc" class="icon-contact" style="display:inline-block;"></md-icon>
	            	                <input ng-model="data.order" step="any" name="order" type="number" placeholder="Order Number">
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
					         		style="background-image: url('<% uploadingFile.src ? uploadingFile.src : data.logo.thumbnail_url_link %>')">

					         		<span class="icon-camera" ng-show="!data.logo"></span>
					         		<span class="upload-text" ng-show="!data.logo">Tour Logo Here</span>
					         		{{-- <span class="upload-text" ng-show="mode === 'create'">Please, save your listing first before upload</span> --}}
					         		<div class="overlay"
					         			ng-class="{'show': uploadingFile.loading}"
					         			ng-show="mode === 'edit'"></div>
					         		<md-progress-circular md-mode="determinate"
					         			ng-show="uploadingFile.loading"
					         			value="<% uploadingFile.progress %>"></md-progress-circular>
					         	</div>
					         	
					         	<span class="icon-upload3" ng-class="{'center': !data.logo}" ng-show="!uploadingFile.loading"
					         		ngf-select ng-model="files" ngf-change="uploadLogo(files)" multiple="false">
					         	</span>
					         	<div class="right icon-remove-2 icon-cross selected" ng-show="data.logo" ng-click="deletePhotoLogo($event)"></div>
					         </div>
							 <div layout-gt-xs="row" layout-padding-row="16">
								<md-input-container  flex-gt-xs>
							      	<md-icon md-font-icon="icon-calendar" class="icon-contact" style="display:inline-block;"></md-icon>
							      	{{-- <input ng-model="data.end_date" ng-disabled="loading" type="text" placeholder="End Date"> --}}
							      	<input mdc-datetime-picker date="false" time="true" type="text" id="time" short-time="true"
						               placeholder="Start Date"
						               ng-model="data.start_time">
							    </md-input-container>
								<md-input-container  flex-gt-xs>
							      	<md-icon md-font-icon="icon-calendar" class="icon-contact" style="display:inline-block;"></md-icon>
							      	{{-- <input ng-model="data.end_date" ng-disabled="loading" type="text" placeholder="End Date"> --}}
							      	<input mdc-datetime-picker date="false" time="true" type="text" id="time" short-time="true"
						               placeholder="End Date"
						               ng-model="data.end_time">
							    </md-input-container>
							</div>
							 <div layout-gt-xs="row" layout-padding-row="16">
								 <md-input-container  flex-gt-xs>
								 	<md-icon md-font-icon="icon-location2" class="icon-contact" style="display:inline-block;"></md-icon>
									<input ng-model="data.latitude" ng-change="onLatLngChanged()"
									 	ng-disabled="loading" type="text" placeholder="Latitude"  name="lat">
								 </md-input-container>
								 <md-input-container  flex-gt-xs>
								 	<md-icon md-font-icon="icon-location2" class="icon-contact" style="display:inline-block;"></md-icon>
									<input ng-model="data.longitude" ng-change="onLatLngChanged()"
									 	ng-disabled="loading" type="text" placeholder="Longitude"  name="long">
								 </md-input-container>
							</div>
			      			<div layout="column" layout-padding-row="16">
			      			 	{{-- <ng-map center="mapInstance.center"
			      			 		on-click="doThat()"></ng-map> --}}

			      				<input id="pac-input" ng-show="showMapSearchBox"
			      					class="controls-search-map" type="text" placeholder="Search Box">

			      				<ui-gmap-google-map center='map.center'
			      					events="map.events"
		      						control="map.control"
			      					zoom='map.zoom'>
			      					<ui-gmap-marker coords="marker.coords"
			      						options="marker.options"
			      						events="marker.events"
			      						idkey="marker.id">
		        					</ui-gmap-marker>
			      				</ui-gmap-google-map>
			      			</div>
				      	</div>
			      	</div>

			      	<div layout-gt-xs="column" style="margin-top: 15px;">
			      		<md-tabs md-dynamic-height md-border-bottom>
			      			
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
							      		<div class="media uploaded" flex="33" ng-repeat="media in data.gallery">
							      			<div class="logo-inner" layout="column" layout-align="center center"
							      				style="background-image: url('<% media.thumbnail_url_link %>')">
								         		<div class="overlay"></div>
								         		<div class="remove icon-cross" ng-click="deletePhoto(media)"></div>
								         	</div>
								         	{{-- <span class="icon-search left" href="<% mediaUrl ? mediaUrl + media.file_name : '/' + media.file_name %>" data-title="<% data.name %>"></span> --}}
								         	<span class="icon-heart center" ng-class="{'selected': data.cover_media == media._id}" href="javascript:void(0)" ng-click="updateCover(media, $event)" data-title="<% data.name %>"></span>
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
