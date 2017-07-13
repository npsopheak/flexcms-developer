<section id="page-posts">

    <md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
          <span>Posts Listing</span>
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
                    <span>Posts Listing</span>
                </div>
                <md-input-container flex-gt-xs>
                    <label>Search Posts</label>
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
        					
        					<div class="directory-basic-info" style="padding-left: 0px;">
        						<div class="name"><% item.title %></div>
        						<div>
        							<span class="tag" ng-repeat="category in [item.category, item.type]">
        								<span class="icon-price-tag"></span>
                                        <% category.display_name %>
        							</span>
        						</div>
        						
        					</div>
        				</td>
        				<td class="col-info">
        					<div class="directory-desc-info">
                                <div class="desc" style="    word-break: break-word;
                                    white-space: inherit;
                                    word-wrap: break-word;
                                    max-height: 80px;
                                    overflow: hidden;" ng-bind-html="item.description"></div>
        						<div ng-if="item.customs">
                                    <div ng-repeat="itemCustom in item.customs">
                                        <b><% itemCustom.display_name %></b> <% itemCustom.model %>
                                    </div>
                                </div>
        					</div>

        					<div class="edit-action"  ng-click="view(item)">
        						<span class="icon-search"></span>
        					</div>

        				</td>
        			</tr>
        		</tbody>
        	</table>

    	</md-list>


        <md-content layout-padding="16" class="box-shadow-content" style="margin-top: 15px">

            <div class="text-center" layout="row" layout-align="center center" >

                <cl-paging flex cl-pages="pagination.total_record" cl-steps="10" cl-page-changed="onPageChanged()" cl-align="center center" cl-current-page="pagination.offset"></cl-paging>

            </div>
        </md-content>

    </md-content>
</section>
