
<section id="page-categories" class="data-content">

    <md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
          <span>Tour Package Listing</span>
        </h2>
        <span flex></span>
        <md-button class="md-icon-button" aria-label="Add"
            ng-click="createTour($event)">
          <md-icon md-font-icon="icon-plus"></md-icon>
        </md-button>
      </div>
    </md-toolbar>


    <md-content layout-padding="16" class="transparent-content">
        <md-content layout-padding="16" class="box-shadow-content">
            <form name="userForm" layout-gt-xs="row">
                <div class="md-toolbar-tools" flex-gt-xs>
                    <span>Tour Package Listing</span>
                </div>
                <md-input-container flex-gt-xs>
                    <label>Search tour packages</label>
                    <input ng-model="search">
                </md-input-container>
            </form>
        </md-content>
        <!-- exact table from live demo -->
        <md-toolbar class="md-table-toolbar alternate toolbar-selected-item" ng-show="selected.length" aria-hidden="false">
          <div class="md-toolbar-tools layout-align-space-between-stretch" layout-align="space-between">
            <div class="title"><% selected.length %> items selected</div>
            <div class="buttons" layout-align="end center">
                <md-button class="md-icon-button md-button md-ink-ripple"
                    ng-hide="selected.length > 1"
                    type="button" ng-click="edit()" aria-label="edit">
                    <md-icon md-font-icon="icon-pencil" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
                </md-button>
                <md-button class="md-icon-button md-button md-ink-ripple" type="button" ng-click="delete($event)" aria-label="delete">
                    <md-icon md-font-icon="icon-bin2" class="md-font material-icons icon-office" aria-hidden="true"></md-icon>
                </md-button>
            </div>
          </div>
        </md-toolbar>

        <md-table-container class="box-shadow-content">
          <table md-table md-row-select multiple ng-model="selected" md-progress="promise">
            <thead md-head md-order="query.order" md-on-reorder="items">
              <tr md-row>
                <th md-column md-order-by="nameToLower"><span>Tour Name</span></th>
                <th md-column><span>Description</span></th>
                <th md-column><span>Location</span></th>
                <th md-column><span>Ppl Allowance</span></th>
                <th md-column style="width: 80px;"><span>Start Time</span></th>
                <th md-column style="width: 80px;"><span>End Time</span></th>
                <th md-column>Updated at</th>
                {{-- <th md-column md-numeric>Protein (g)</th>
                <th md-column md-numeric>Sodium (mg)</th>
                <th md-column md-numeric>Calcium (%)</th>
                <th md-column md-numeric>Iron (%)</th> --}}
              </tr>
            </thead>
            <tbody md-body>
              <tr md-row md-select="item" md-select-id="_id" ng-click="view(item)" md-auto-select ng-repeat="item in items">
                <td md-cell><% item.name %></td>
                <td md-cell><% item.short_description || item.description %></td>
                <td md-cell><% item.location %></td>
                <td md-cell><% item.people_allowance %></td>
                <td md-cell class="text-center"><% formatUtcDate(item.start_time, 'HH:mm') %></td>
                <td md-cell class="text-center"><% formatUtcDate(item.end_time, 'HH:mm') %></td>
                <td md-cell><% formatUtcDate(item.updated_at) %></td>
                {{-- <td md-cell><%dessert.protein.value | number: 1%></td>
                <td md-cell><%dessert.sodium.value%></td>
                <td md-cell><%dessert.calcium.value%><%dessert.calcium.unit%></td>
                <td md-cell><%dessert.iron.value%><%dessert.iron.unit%></td> --}}
              </tr>
            </tbody>
          </table>
        </md-table-container>
        
        <md-content layout-padding="16"
            ng-show="pagination.total.length"
            class="box-shadow-content" style="margin-top: 15px;">
            {{-- <ul class="md-pagination">
                <li ng-repeat="offset in pagination.total">
                    <md-button class="md-raised"
                        ng-class="{'md-primary': offset - 1 == pagination.offset}"
                        ng-click="changeOffset(offset - 1)"><% offset %></md-button>
            </ul> --}}
            <md-table-pagination md-limit="pagination.limit" md-limit-options="[5, 10, 15]" md-page="pagination.page" md-total="<% pagination.count %>" md-on-paginate="loadData()" md-page-select></md-table-pagination>
        </md-content>
    </md-content>
</section>
