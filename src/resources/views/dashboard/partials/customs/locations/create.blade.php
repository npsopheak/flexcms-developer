<div>
	<!-- START: HEADER TOOLBAR -->
	<md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
	        <span>
			    Create/Edit Location Information
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
						          	<label>Location Name</label>
						          	<input ng-model="data.display_name" name="name" required ng-disabled="loading">
						          	<div ng-messages="siteForm.name.$error"
						          		 ng-show="siteForm.name.$dirty &&
						          		 	siteForm.name.$invalid">
							          	<div ng-message="required">Location name is needed</div>
							        </div>
						        </md-input-container>

					      		{{-- <md-input-container flex>
							        <md-select placeholder="Organization Category" ng-model="data.category_id"
							        	style="padding-bottom: 0px;" name="category" required  ng-disabled="loading">
										<md-option ng-repeat="category in categories" value="<% category.id %> ">
											<% category.display_name %>
										</md-option>
									</md-select>
						          	<div ng-messages="siteForm.category.$error"
						          		 ng-show="siteForm.category.$dirty && siteForm.category.$invalid">
							          	<div ng-message="required">Year value is invalid</div>
							        </div>
								</md-input-container> --}}
						      	<md-input-container fake-md-no-float  flex-gt-xs>
							      	<md-icon md-font-icon="icon-mobile2" class="icon-contact"></md-icon>
							      	<input ng-model="data.phones" ng-disabled="loading" type="text" placeholder="Phone Number"  name="phone">
							    </md-input-container>
							    <md-input-container  flex-gt-xs>
							      	<!-- Use floating placeholder instead of label -->
							      	<md-icon md-font-icon="icon-envelop" class="email icon-contact"></md-icon>
							      	<input ng-model="data.emails" ng-disabled="loading"
							      		type="email" placeholder="Email" name="email">
							    </md-input-container>
							    <md-input-container  flex-gt-xs>
							      	<md-icon md-font-icon="icon-earth" class="icon-contact" style="display:inline-block;"></md-icon>
							      	<input ng-model="data.website" ng-disabled="loading" type="text" placeholder="Website"  name="website">
							    </md-input-container>
							    <md-input-container  flex-gt-xs>
							      	<md-icon md-font-icon="icon-location2" class="icon-contact" style="display:inline-block;"></md-icon>
							      	<input ng-model="data.address" ng-disabled="loading" type="text" placeholder="Address" name="address">
							    </md-input-container>
						    </div>
				      	</div>

				      	<div flex-gt-xs>
					         <div layout-padding-row="16" class="logo-container">
					         	<div class="logo-inner" layout="column" layout-align="center center"
					         		style="background-image: url('<% uploadingFile.src ? uploadingFile.src : data.logo.thumbnail_url_link %>')">

					         		<span class="icon-camera" ng-show="!data.logo"></span>
					         		<span class="upload-text" ng-show="!data.logo">Location Logo Here</span>
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
									 <input ng-model="data.latitude" ng-change="onLatLngChanged()"
									 	ng-disabled="loading" type="text" placeholder="Latitude"  name="lat">
								 </md-input-container>
								 <md-input-container  flex-gt-xs>
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
			      			{{-- Detail Description --}}
					      	<md-tab label="detail">
					        	<md-content class="md-padding">
					          		<div layout-gt-xs="column">

			            	            <md-input-container flex-gt-xs>
			            	                <label>Order Number</label>
			            	                <input ng-model="data.seq_number" step="any" name="order" type="number">
			            		          	<div ng-messages="dialogFormType.order.$error"
			            		          		 ng-show="dialogFormType.order.$dirty && dialogFormType.order.$invalid">
			            			          	<div ng-message="invalid">Order number is not valid</div>
			            			        </div>
			            	            </md-input-container>

			            	            <md-input-container flex-gt-xs>
			            	                <label>Rate</label>
			            	                <input ng-model="data.rate" step="any" name="rate" type="number">
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
					        	</md-content>
					      	</md-tab>
			      			{{-- Localization --}}
					      	{{-- <md-tab label="localization">
					        	<md-content class="md-padding">
					          		<div layout-gt-xs="column">
							      		<md-input-container flex-gt-xs>
								          	<label>Location Name (Khmer)</label>
								          	<input ng-model="data.locale.kh.directory_name" name="name" ng-disabled="loading">
								        </md-input-container>

								      	<md-input-container  flex-gt-xs>
							                <label>Short Description (Khmer)</label>
							                <textarea ng-model="data.locale.kh.short_description"
							                	style="min-height: 100px;"
							                	ng-disabled="loading" columns="1" name="shortDescription"
							                	md-maxlength="200"></textarea>
								      	</md-input-container>
								      	<md-input-container  flex-gt-xs>
							                <label>Description (Khmer)</label>
							                <textarea ng-model="data.locale.kh.description"
							                	style="min-height: 200px;"
							                	ng-disabled="loading" columns="1" name="description"
							                	md-maxlength="1000"></textarea>
								      	</md-input-container>
							      	</div>
					        	</md-content>
					      	</md-tab> --}}
			      			
					      	{{-- Categories & Features --}}
			      	 		<md-tab label="features">
				        		<md-content class="md-padding">
				        			<div layout-gt-xs="column">
				        				<md-chips ng-model="selectedCategories" md-autocomplete-snap
									              fake-md-transform-chip="ctrl.transformChip($chip)"
									              fake-md-require-match="ctrl.autocompleteDemoRequireMatch">
									      <md-autocomplete
									          md-selected-item="selectedItem"
									          md-search-text="searchText"
									          md-items="item in querySearchCategory(searchText)"
									          md-item-text="item"
									          placeholder="Search for a category">
									          <md-item-template>
											        <span >
											        	<% item %>
											        </span>
										       	</md-item-template>
									        {{-- <span md-highlight-text="searchText"><span ng-bind="item.value"></span></span> --}}
									      </md-autocomplete>
									      <md-chip-template>
									        <span>
									          <strong ng-bind="$chip"><% $chip %></strong>
									        </span>
									      </md-chip-template>
									    </md-chips>

				        				{{-- categories --}}
							      		{{-- <div flex-gt-xs class="chips-group">
											<md-chips ng-model="select_categories"
												ng-change="itemChange()"
												md-autocomplete-snap
												md-transform-chip="newItems($chip, 'select_features')"
												md-require-match="false">
												<md-autocomplete
											          md-selected-item="selectedItem"
											          md-search-text="searchText"
											          md-items="item in querySearch(searchText)"
											          md-search-text-change="itemChange()"
											          md-item-text="item.name"
											          placeholder="Manage Purpose"
											          md-item-text="item.display_name">
											        <md-item-template>
												        <span >
												        	<% item.display_name %>
												        </span>
											       	</md-item-template>
											    </md-autocomplete>
												<md-chip-template >
													<strong><% ($chip.display_name || $chip)  %></strong>
												</md-chip-template>
											</md-chips>
										</div> --}}

				        				{{-- features --}}
							      		{{-- <div flex-gt-xs class="chips-group">
											<md-chips ng-model="select_features"
												ng-change="itemChangeGeneric('select_features')"
												md-transform-chip="newItems($chip, 'select_features')"
												md-require-match="false"
												md-autocomplete-snap >
												<md-autocomplete
											          md-selected-item="selectedItem"
											          md-search-text="searchText"
											          md-items="item in querySearchGeneric(searchText, 'features')"
											          md-search-text-change="itemChangeGeneric('select_features')"
											          md-item-text="item.name"
											          placeholder="Manage Feature"
											          md-item-text="item.display_name">
											        <md-item-template>
												        <span >
												        	<% item.display_name %>
												        </span>
											       	</md-item-template>
											    </md-autocomplete>
												<md-chip-template >
													<strong><% ($chip.display_name || $chip) %></strong>
												</md-chip-template>
											</md-chips>
										</div> --}}

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
