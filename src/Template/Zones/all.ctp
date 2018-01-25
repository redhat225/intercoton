<section ui-view>

	<div class="columns">
		<div class="column">
			<nav class="breadcrumb" aria-label="breadcrumbs">
			  <ul>
			    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
			    <li class="is-active"><a >Zones</a></li>
			  </ul>
			</nav>
		</div>
		<div class="column is-three-fifths">
				<div class="field has-addons is-expanded">
					<div class="control is-expanded">
						<input type="text" class="input" name="search_input" ng-model="filter_keys">
					</div>
					<div class="control">
						<a class="button is-static">
							<span class="icon">
								<i class="fa fa-search"></i>
							</span>
							<span>Rechercher</span>
						</a>
					</div>
				</div>
		</div>
		<div class="column">
				<button class="button is-intercoton-green" ui-sref="admins.zones.create">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span>Ajouter une zone</span>
				</button>
		</div>
	</div>

	<table class="table is-striped is-hoverable is-fullwidth">
	  <thead>
	    <tr class="intercoton-skygreen-b">
	      <th>identifiant</th>
	      <th><abbr title="Nom de la zone">Dénomination</abbr></th>
	      <th>Coopératives Rattachées</th>
	      <th>Date Création</th>
	      <th>Dernière Modification</th>
	      <th>Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  		<tr ng-repeat="zone in $root.zones | orderBy: default_zone_order | filter:filter_keys">
	  			<th>{{zone.id}}</th>
	  			<td>{{zone.zone_denomination}}</td>
	  			<td>{{zone.zone_denomination}}</td>
	  			<td>{{zone.created | date:'dd/MM/yyyy HH:mm:ss' }}</td>
	  			<td>{{zone.modified | date:'dd/MM/yyyy HH:mm:ss'}}</td>
	  			<td>
						   <div class="dropdown is-hoverable is-right">
								  <div class="dropdown-trigger">
								    <button class="button">
								      <span class="icon is-small">
										<i class="fa fa-sun-o"></i>
								      </span>
								    </button>
								  </div>
								  <div class="dropdown-menu" id="dropdown-menu" role="menu">
								    <div class="dropdown-content">
										 <a ui-sref="admins.zones.edit({zone_id:zone.id})" class="dropdown-item">
								            	Modifier la zone
										 </a>

								         <a ng-show="zone.deleted==null" ng-click="turn_off_zone(zone.id)" class="dropdown-item">
												<abbr title="Cette action masquera cette zone dans la liste de sélecttion lors de la création d'une coopérative ou dans le cas d'une modification">Désactiver la zone</abbr> 
									    </a>
								        <a ng-show="zone.deleted!==null" ng-click="turn_on_zone(zone.id)" class="dropdown-item">
													<abbr title="Cette action réaffichera cette zone dans la liste de sélecttion lors de la création d'une coopérative ou dans le cas d'une modification">Réactiver la zone</abbr> 
										</a>
								    </div>
								  </div>
								</div>
	  			</td>
	  		</tr>
	  </tbody>
	 </table>
</section>
