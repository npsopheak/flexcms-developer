<section id="page-posts">

    <md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
          <span>Article Listing</span>
        </h2>
        <span flex></span>
        <md-button class="md-icon-button" aria-label="Add"
            ng-click="create($event)">
          <md-icon md-font-icon="icon-plus"></md-icon>
        </md-button>
      </div>
    </md-toolbar>

    <md-content layout-padding="16" class="transparent-content">

        <md-content layout-padding="16" class="box-shadow-content">
            <form name="userForm" layout-gt-xs="row">
                <div class="md-toolbar-tools" flex-gt-xs>
                    <span>Article Listing</span>
                </div>
                <md-input-container flex-gt-xs>
                    <label>Search articles</label>
                    <input ng-model="search.query" ng-model-options="{ updateOn: 'default blur', debounce: { 'default': 1500, 'blur': 0 } }">
                </md-input-container>
            </form>
        </md-content>

   		<md-list class="box-shadow-content" style="margin-top: 15px">
        	<table class="directory-listing table-grid">
        		<thead>
        			<tr>
        				<td class="col-head" style="width: 40%">
        					Name
        				</td>
        				<td class="col-head" colspan="2">Description</td>
        			</tr>
        		</thead>
        		<tbody>
                    <tr ng-if="!data.length">
                        <td colspan="3" class="empty-cell">There is no listing yet! Please, add one or more from the left menu</td>
                    </tr>
        			<tr ng-repeat="item in data | startFrom: (pagination.current - 1) * pagination.limit | limitTo : pagination.limit ">
        				<td class="col-info" style="width: 390px;">
        					<div class="directory-image"
                                style="background-image: url('<% item.cover ? mediaUrl + item.cover.file_name :  item.photo_url %>');  width: 100px; height: 100px;"></div>
        					<div class="directory-basic-info" style="    padding-left: 120px;">
        						<div class="name"><% item.display_name %></div>
        						<div>
        							<span class="tag" ng-repeat="category in item.categories">
        								<span class="icon-price-tag"></span>
                                        <% category.display_name %>
        							</span>
        						</div>
        						<ul class="mini-gallery-list">
        							<li class="gallery-item"
                                        href="<% mediaUrl + item.file_name %>"
        								ng-repeat="item in item.photos | limitTo : 4"
        								style="background-image: url('<% mediaUrl + item.file_name %>')">
        						</ul>
        					</div>
        				</td>
        				<td class="col-info">
        					<div class="directory-desc-info">
        						<p class="desc" style="word-break: break-word;
                                    white-space: inherit;
                                    word-wrap: break-word;">
	        						<% item.description %>
	        					</p>
	        					{{-- <ul class="contact-info">
	        						<li style="word-break: break-word;
                                        white-space: inherit;
                                        word-wrap: break-word;">
	        							<span class="icon">
	        								<span class="icon-location"></span>
	        							</span>
	        							<span class="text"><% location.address %></span>
	        						<li>
	        							<span class="icon">
	        								<span class="icon-mobile2"></span>
	        							</span>
	        							<span class="text"><% phoneArrayToString(location.phone_numbers) %></span>
	        						<li>
	        							<span class="icon">
	        								<span class="icon-envelop"></span>
	        							</span>
	        							<span class="text"><% location.email_addresses.join(', ') %></span>
	        						<li>
	        							<span class="icon">
	        								<span class="icon-earth"></span>
	        							</span>
	        							<span class="text"><% location.website %></span>
	        					</ul> --}}
        					</div>

        				</td>
        				<td class="col-info">
        					<div class="directory-static-map">
        						<img src="<% getMapUrl(item) %>">
        					</div>

        					<div class="edit-action"  ng-click="view(item)">
        						<span class="icon-search"></span>
        					</div>
        				</td>
        			</tr>
        		</tbody>
        	</table>


	        {{-- <ul class="md-pagination">
	            <li ng-repeat="offset in pagination.total">
	                <md-button ng-click="changePage(offset)" ng-class="{'md-primary': offset - 1 == pagination.offset}"><% offset %></md-button>
	        </ul> --}}
    	</md-list>


        <md-content layout-padding="16" class="box-shadow-content" style="margin-top: 15px">

            <div class="text-center" layout="row" layout-align="center center" >

                <cl-paging flex cl-pages="pagination.total_record" cl-steps="10" cl-page-changed="onPageChanged()" cl-align="center center" cl-current-page="pagination.offset"></cl-paging>

            </div>
        </md-content>

    </md-content>
</section>
