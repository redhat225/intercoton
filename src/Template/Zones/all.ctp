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

<div>
	<!-- Pagintaion module -->
     	<div class="level is-mobile is-pad-bot-30">
     		<div class="level-left">
     			<div class="span level-item">
     				&nbsp;
     			</div>
     		</div>
     		<div class="level-right">
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
	  		<tr ng-repeat="zone in $root.zones | orderBy: default_zone_order | filter:filter_keys" ng-class="get_zone_state(zone.deleted)">
	  			<th>{{zone.id}}</th>
	  			<td>{{zone.zone_denomination}}</td>
	  			<td >
	  			   <span> {{zone.count_cooperatives}} </span>  
	  			   <span class="icon" ng-click="show_zone_cooperatives(zone.cooperatives,zone.zone_denomination)" ng-if="zone.count_cooperatives > 0">
	  			   	<i class="fa fa-info-circle"></i>
	  			   </span>
	  			</td>

	  			<td>{{zone.created | date:'dd/MM/yyyy HH:mm:ss' }}</td>
	  			<td>{{zone.modified | date:'dd/MM/yyyy HH:mm:ss'}}</td>
	  			<td>
						   <div class="dropdown is-hoverable is-right">
								  <div class="dropdown-trigger">
								    <button class="button">
								      <span class="icon is-small">
										<i class="fas fa-cogs menu-icon"></i>
								      </span>
								    </button>
								  </div>
								  <div class="dropdown-menu" id="dropdown-menu" role="menu">
								    <div class="dropdown-content">
										 <a ui-sref="admins.zones.edit({zone_id:zone.id})" class="dropdown-item">
								            	Modifier la zone
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
     			<div class="span level-item">
     				&nbsp;
     			</div>
     		</div>
     		<div class="level-right">
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

     	<!-- Modal linked cooperatives -->
     	<div class="modal {{is_active_zone_modal}}">
		  <div class="modal-background"></div>
		  <div class="modal-card">
		    <header class="modal-card-head intercoton-green-b">
		      <p class="modal-card-title has-text-white">Coopératives rattachées - {{modal_zone}}</p>
		      <button class="delete" aria-label="close" ng-click="close_modal_linked()"></button>
		    </header>
		    <section class="modal-card-body">
				<!-- Tabular view -->
				<table class=" table is-fullwidth is-hoverable is-striped">
					<thead>
						<tr class="intercoton-skygreen-b">
							<th>Dénomination</th>
							<th>Sigle</th>
							<th>Localisation</th>
							<th><abbr title="Sous-préfecture">S/P</abbr></th>
							<th>Date création</th>
							<th>Dernière modification</th>
							<th>Date Suppression</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="cooperative in modal_cooperatives" class="">
							<td>{{cooperative.cooperative_denomination}}</td>
							<td>{{cooperative.cooperative_sigle}}</td>
							<td>{{cooperative.cooperative_localisation}}</td>
							<td ng-if="cooperative.cooperative_sub_prefecture">{{cooperative.cooperative_sub_prefecture}}</td>
							<td ng-if="!cooperative.cooperative_sub_prefecture">non spécifié</td>
							<td>{{cooperative.created | date:'dd/MM/yyyy HH:mm:ss' }}</td>
							<td>{{cooperative.modified | date:'dd/MM/yyyy HH:mm:ss' }}</td>
							<td>{{cooperative.deleted | date:'dd/MM/yyyy HH:mm:ss' }}</td>
						</tr>
					</tbody> 
				</table>
		    </section>
		    <footer class="modal-card-foot">
		      <button class="button" ng-click="close_modal_linked()">Fermer</button>
		    </footer>
		  </div>
		</div>
</section>
