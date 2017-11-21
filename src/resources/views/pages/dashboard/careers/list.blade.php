<section id="page-posts">

    <md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
          <span>Career Listing</span>
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
                    <span>Career Listing</span>
                </div>
                <md-input-container flex-gt-xs>
                    <label>Search careers</label>
                    <input ng-model="search.query" ng-model-options="{ updateOn: 'default blur', debounce: { 'default': 1500, 'blur': 0 } }">
                </md-input-container>

				<md-input-container flex-gt-xs>
					<label>Select job status</label>
					<md-select placeholder="Job status" ng-model="search.status" 
						ng-change="onStatusChanged()"
					style="padding-bottom: 0px;" flex-gt-xs>
						<md-option value="">All</md-option>
						<md-option value="active">Active</md-option>
						<md-option value="inactive">Inactive</md-option>
					</md-select>  
				</md-input-container>
            </form>
        </md-content>

        <md-toolbar class="md-table-toolbar alternate toolbar-selected-item" ng-show="selected.length" aria-hidden="false">
          <div class="md-toolbar-tools layout-align-space-between-stretch" layout-align="space-between">
            <div class="title"><% selected.length %> items selected</div>
            <div class="buttons" layout-align="end center">
                <md-button class="md-icon-button md-button md-ink-ripple"
                    style="width: 100px"
                    type="button" ng-click="view($event)" aria-label="Block Items">
                    <md-icon md-font-icon="icon-blocked" class="md-font material-icons icon-office" 
                        style="display: inline-block;" aria-hidden="true"></md-icon>
                    Edit
                </md-button>
                <md-button class="md-icon-button md-button md-ink-ripple" type="button" ng-click="remove($event)" aria-label="Remove" style="width: 120px">
                    <md-icon md-font-icon="icon-bin2" class="md-font material-icons icon-bin2" 
                        style="display: inline-block;" 
                        aria-hidden="true"></md-icon>
                    Remove
                </md-button>
            </div>
          </div>
        </md-toolbar>

        <md-table-container class="box-shadow-content">
          <table md-table md-row-select ng-model="selected" md-progress="promise">
            <thead md-head md-order="query.order" md-on-reorder="listing">
              <tr md-row>
              	<th md-column><span>No</span></th>
                <th md-column><span>Job Title</span></th>
                <th md-column><span>Location</span></th>
                <th md-column><span>Job Term</span></th>
                <th md-column><span>Closing Date</span></th>
                <th md-column><span>Seq No</span></th>
                <th md-column>Created at</th>
                <th md-column>
                	Status
                </th>
              </tr>
            </thead>
            <tbody md-body>
              <tr md-row md-select="item" md-select-id="id" ng-click="viewDetail(item)" md-auto-select ng-repeat="item in data">
                <td md-cell>
                	<% $index + 1 %>
                </td>
                <td md-cell><% item.name %></td>
                <td md-cell><% item.location %></td>
                <td md-cell><% item.job_term %></td>
                <td md-cell><% item.closing_date %></td>
                <td md-cell><% item.seq_no %></td>
                <td md-cell><% formatUtcDate(item.created_at) %></td>
                <td md-cell>
                    Active
                </td>
              </tr>
              <tr md-row ng-show="!data.length">
                <td md-cell colspan="8">There is no jobs data</td>
              </tr>
            </tbody>
          </table>
        </md-table-container>
       
        <md-content layout-padding="16"
            ng-show="pagination.total.length"
            class="box-shadow-content" style="margin-top: 15px;">
            <md-table-pagination md-limit="pagination.limit" md-limit-options="[5, 10, 15]" md-page="pagination.offset" md-total="<% pagination.count %>" md-on-paginate="onPageChanged()" md-page-select></md-table-pagination>
        </md-content>

    </md-content>
</section>
