<section id="page-posts">

    <md-toolbar class="md-theme-indigo md-default-theme">
      <div class="md-toolbar-tools">
        <h2>
          <span>Quote Listing</span>
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
                    <span>Quote Listing</span>
                </div>
                <md-input-container flex-gt-xs>
                    <label>Search quotes</label>
                    <input ng-model="search.query" ng-model-options="{ updateOn: 'default blur', debounce: { 'default': 1500, 'blur': 0 } }">
                </md-input-container>

				<md-input-container flex-gt-xs>
					<label>Select admin quote status</label>
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

        <md-table-container class="box-shadow-content">
          <table md-table md-row-select ng-model="selected" md-progress="promise">
            <thead md-head md-order="query.order" md-on-reorder="listing">
              <tr md-row>
              	<th md-column><span>No</span></th>
                <th md-column><span>Company</span></th>
                <th md-column><span>Contact Person</span></th>
                <th md-column><span>Phone</span></th>
                <th md-column><span>Email</span></th>
                <th md-column><span>Description</span></th>
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
                <td md-cell><% item.customs.company %></td>
                <td md-cell><% item.customs.contact_person_name %></td>
                <td md-cell><% item.customs.contact_phone %></td>
                <td md-cell><% item.customs.contact_email %></td>
                <td md-cell>
                    FCL 20': <b><% item.customs.fcl_cntr20 || 0 %></b>, FCL 40': <b><% item.customs.fcl_cntr40 || 0 %></b>, FCL 45': <b><% item.customs.fcl_cntr45 || 0 %></b> <br/>
                    LCL Height: <b><% item.customs.lcl_height || 0 %></b>, LCL Length: <b><% item.customs.lcl_length || 0 %></b>, LCL Weight: <b><% item.customs.lcl_width || 0 %></b> <br/>
                    POR: <b><% item.customs.por %></b>, POD: <b><% item.customs.pod %></b> <br/>
                    Commodity: <b><% item.customs.commodity %></b> (KGS), Cargo Weight: <b><% item.customs.cargo_weight %></b> (KGS), Net Gross Weight: <b><% item.customs.gross_weight %></b> <br/>

                </td>
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
