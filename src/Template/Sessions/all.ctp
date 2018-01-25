   <section ui-view>
			<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li class="is-active"><a >Enquêtes</a></li>
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
										  <a ui-sref="admins.reports({session_id:session.id})" class="dropdown-item">
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
	</section>

