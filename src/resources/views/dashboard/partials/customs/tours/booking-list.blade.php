
<section id="page-categories" class="data-content">

    <md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
          <span>Tour Booking</span>
        </h2>
        <span flex></span>
      </div>
    </md-toolbar>


    <md-content layout-padding="16" class="transparent-content">
        <md-content layout-padding="16" class="box-shadow-content">
            <form name="userForm" layout-gt-xs="column">
                <div layout-gt-xs="row" flex-gt-xs>
                            
                    <div class="md-toolbar-tools" flex-gt-xs>
                        <span>Booking Listing</span>
                    </div>
                    <md-input-container flex-gt-xs>
                        <label>Search bookings</label>
                        <input ng-model="search.query" ng-model-options="{ updateOn: 'default blur', debounce: { 'default': 1500, 'blur': 0 } }">
                    </md-input-container>
                </div>
                <div layout-gt-xs="row" flex-gt-xs>

                    <div class="md-toolbar-tools" flex-gt-xs>
                        <span>Filter options:</span>
                    </div>
                    <md-select placeholder="Filter" ng-model="search.filter" 
                        style="padding-bottom: 0px;" flex-gt-xs>
                        <md-option value="">None</md-option>
                        <md-option value="requesting">Requesting</md-option>
                        <md-option value="accepted">Confirmed</md-option>
                        <md-option value="completed">Completed</md-option>
                    </md-select>  
                    <div class="md-toolbar-tools" flex-gt-xs>
                        <span>Order by options:</span>
                    </div>
                    <md-select placeholder="Sort Options" ng-model="search.sort" 
                        style="padding-bottom: 0px;" flex-gt-xs>
                        <md-option value="">Default</md-option>
                        <md-option value="-created_at">Last booked</md-option>
                        {{-- <md-option value="directory_name">Shop Name</md-option> --}}
                    </md-select>  
                </div>
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
                <th md-column><span>Customer</span></th>
                <th md-column><span>Driver Assigned</span></th>
                <th md-column><span>Booking date</span></th>
                <th md-column style="width: 80px;"><span>Start Time</span></th>
                <th md-column style="width: 80px;"><span>End Time</span></th>
                <th md-column><span>Updated</span></th>
                <th md-column>Status</th>
                {{-- <th md-column md-numeric>Protein (g)</th>
                <th md-column md-numeric>Sodium (mg)</th>
                <th md-column md-numeric>Calcium (%)</th>
                <th md-column md-numeric>Iron (%)</th> --}}
              </tr>
            </thead>
            <tbody md-body>
              <tr md-row md-select="item" md-select-id="_id" ng-click="view(item)" md-auto-select ng-repeat="item in items">
                <td md-cell><% item.order.tour.name %></td>
                <td md-cell><% item.order.contact_name %> / <% item.order.contact_phone %></td>
                <td md-cell><% item.driver ? item.driver.profile.full_name : '' %></td>
                <td md-cell><% item.order.ordered_at %></td>
                <td md-cell class="text-center"><% formatUtcDate(item.order.tour.start_time, 'HH:mm') %></td>
                <td md-cell class="text-center"><% formatUtcDate(item.order.tour.end_time, 'HH:mm') %></td>
                <td md-cell><% formatUtcDate(item.updated_at) %></td>
                <td md-cell>
                	
                	<i ng-show="item.status == 'requesting'">Requesting</i>		
                	<b ng-show="item.status !== 'requesting'">Confirmed</b>		
                </td>
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
            <md-table-pagination md-limit="pagination.limit" md-limit-options="[5, 10, 15]" md-page="pagination.page" md-total="<% pagination.count %>" md-on-paginate="loadData()" md-page-select></md-table-pagination>
        </md-content>
    </md-content>
</section>
