<section id="page-posts">

    <md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
          <span>Career Candidate Listing</span>
        </h2>
        <span flex></span>
        
      </div>
    </md-toolbar>

    <md-content layout-padding="16" class="transparent-content">

        <md-content layout-padding="16" class="box-shadow-content">
            <form name="userForm" layout-gt-xs="row">
                <div class="md-toolbar-tools" flex-gt-xs>
                    <span>Career Candidate Listing</span>
                </div>
                <md-input-container flex-gt-xs>
                    <label>Search candidate</label>
                    <input ng-model="search.query" ng-model-options="{ updateOn: 'default blur', debounce: { 'default': 1500, 'blur': 0 } }">
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
                    Shortlist
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
                <th md-column><span>Candidate</span></th>
                <th md-column><span>Phone</span></th>
                <th md-column><span>Email</span></th>
                <th md-column><span>Comment</span></th>
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
                <td md-cell><% item.job.name %></td>
                <td md-cell><% item.job.location %></td>
                <td md-cell><% item.full_name %></td>
                <td md-cell><% item.phone_number %></td>
                <td md-cell><% item.email %></td>
                <td md-cell><% item.comment %></td>
                <td md-cell><% formatUtcDate(item.created_at) %></td>
                <td md-cell>
                    Active
                </td>
              </tr>
              <tr md-row ng-show="!data.length">
                <td md-cell colspan="9">There is no jobs data</td>
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
