   <section ui-view>
			<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li class="is-active"><a >Sessions</a></li>
					  </ul>
					</nav>
				</div>
				<div class="column is-three-fifths">
						<div class="field has-addons is-expanded">
							<div class="control is-expanded">
								<input type="text" class="input" ng-model="filter_keys">
							</div>
							<div class="control">
								<a class="button is-intercoton-green is-static" >
									<span class="icon">
										<i class="fa fa-search"></i>
									</span>
									<span>Rechercher</span>
								</a>
							</div>
						</div>
				</div>
				<div class="column">
						<button class="button is-intercoton-green" ui-sref="admins.sessions.create">
							<span class="icon">
								<i class="fa fa-plus"></i>
							</span>
							<span>Créer une session</span>
						</button>
				</div>
			</div>
	    <!-- Pagintaion module -->
     	<div class="level is-mobile is-pad-bot-30">
     		<div class="level-left">
				<div class="field has-addons level-item">
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="previous_page()" ng-disabled="is_loading">
				      <span class="icon is-small">
				        <i class="fa fa-chevron-left"></i>
				      </span>
				      <span class="has-text-weight-semibold">Précédent</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-static is-disabled">
				      <span ng-bind="pagination.current_page" ng-hide="is_loading">1</span> sur <span ng-bind="pagination.all_pages" ng-hide="is_loading">45</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="next_page()" ng-disabled="is_loading">
				      <span class="has-text-weight-semibold">Suivant</span>
				      <span class="icon is-small">
				        <i class="fa fa-chevron-right"></i>
				      </span>
				    </a>
				  </p>
				</div>
     		</div>
     	</div>
			<!-- Table -->
			<table class="table is-fullwidth is-striped is-hoverable ">
				<thead>
					<tr class="intercoton-skygreen-b">
						<th>id</th>
						<th>Dénomination</th>
						<th>Code</th>
						<th>Date Création</th>
						<th>Date Début</th>
						<th>Date Clotûre</th>
						<th>Créé Par</th>
						<th>Rapports enregistrés</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="session in $root.sessions | orderBy:default_sessions_order | filter:filter_keys">
							<th> {{session.id}}</th>
							<td>	
								{{session.session_denomination}}
							</td>
							<td>{{session.session_code}}</td>
							<td>{{session.created | date:'dd/MM/yyyy HH:mm:ss'}} </td>
							<td>{{session.session_begin_date | date:'dd/MM/yyyy'}}</td>
							<td>{{session.session_end_date | date:'dd/MM/yyyy'}}</td>
							<td>{{session.creator}}</td>
							<td>{{session.count_reports}}</td>
							<td>
						       <div class="dropdown is-hoverable is-right">
								  <div class="dropdown-trigger">
								    <button class="button" ng-class="{{is-loading}}">
								      <span class="icon is-small">
										<i class="fa fa-sun-o"></i>
								      </span>
								    </button>
								  </div>
								  <div class="dropdown-menu" id="dropdown-menu" role="menu">
								    <div class="dropdown-content">
										  <a ng-if="session.count_reports > 0" ui-sref="admins.reports({session_id:session.id, page_id:1})" class="dropdown-item">
								            	Voir les rapports
										  </a>
										  <a ui-sref="admins.reports.create({session_id:session.id})" class="dropdown-item">
								            	Rédiger un rapport
										  </a>
										  <a ui-sref="admins.sessions.edit({session_id:session.id})" class="dropdown-item">
								            	Modifier la session
										  </a>
								    </div>
								  </div>
								</div>
							</td>
						</tr>
				</tbody>
			</table>
		    <!-- Pagintaion module -->
	     	<div class="level is-mobile is-pad-bot-30">
	     		<div class="level-left">
					<div class="field has-addons level-item">
					  <p class="control">
					    <a class="button is-intercoton-green" ng-click="previous_page()" ng-disabled="is_loading">
					      <span class="icon is-small">
					        <i class="fa fa-chevron-left"></i>
					      </span>
					      <span class="has-text-weight-semibold">Précédent</span>
					    </a>
					  </p>
					  <p class="control">
					    <a class="button is-static is-disabled">
					      <span ng-bind="pagination.current_page" ng-hide="is_loading">1</span> sur <span ng-bind="pagination.all_pages" ng-hide="is_loading">45</span>
					    </a>
					  </p>
					  <p class="control">
					    <a class="button is-intercoton-green" ng-click="next_page()" ng-disabled="is_loading">
					      <span class="has-text-weight-semibold">Suivant</span>
					      <span class="icon is-small">
					        <i class="fa fa-chevron-right"></i>
					      </span>
					    </a>
					  </p>
					</div>
	     		</div>
	     	</div>
	</section>

