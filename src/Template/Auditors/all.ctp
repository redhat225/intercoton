   <section ui-view>
			<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li class="is-active"><a >Utilisateurs</a></li>
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
						<button class="button is-intercoton-green" ui-sref="admins.auditors.create">
							<span class="icon">
								<i class="fa fa-plus"></i>
							</span>
							<span>Ajouter utilisateur</span>
						</button>
				</div>
			</div>
			<!-- Table -->
			<table class="table is-fullwidth is-striped is-hoverable ">
				<thead>
					<tr class="intercoton-skygreen-b">
						<th>id</th>
						<th>Photo</th>
						<th>Nom Complet</th>
						<th>Sexe</th>
						<th>Contact</th>
						<th>Email</th>
						<th>Role</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="auditor in $root.auditors | orderBy:default_auditor_order | filter:filter_keys">
							<th> {{auditor.id}}</th>
							<td>
								<img ng-src="/img/assets/admins/photo/{{auditor.auditor_photo}}" width="80px" alt="">
							</td>
							<td>{{auditor.auditor_fullname}} </td>
							<td>{{auditor.auditor_sexe}} </td>
							<td>{{auditor.auditor_contact}} </td>
							<td>{{auditor.auditor_email}}</td>
							<td>{{auditor.auditor_accounts[0].role.role_denomination}}</td>
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
										  <a ui-sref="admins.auditors.edit({auditor_id:auditor.id})" class="dropdown-item">
								            	Modifier le compte
										  </a>
								          <a ng-if="auditor.auditor_accounts[0].account_is_active" ng-click="turn_off_account(auditor.id)" class="dropdown-item">
								            	Désactiver le compte
										  </a>
								          <a ng-if="!auditor.auditor_accounts[0].account_is_active" ng-click="turn_on_account(auditor.id)" class="dropdown-item">
								            	Activer le compte
										  </a>
								          <a ng-if="!auditor.auditor_accounts[0].account_is_active" class="dropdown-item" ng-click="soft_delete(auditor.id)">
								            	Supprimer le compte
										 </a>
								         <a href="#" class="dropdown-item" ng-click="reinit_account(auditor.id)">
								            	Réinitialiser le compte
										 </a>
								    </div>
								  </div>
								</div>
							</td>
						</tr>
				</tbody>
			</table>
	</section>

