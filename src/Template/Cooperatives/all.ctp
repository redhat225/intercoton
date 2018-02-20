<section ui-view>
	  <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
	<div class="columns">
		<div class="column">
			<nav class="breadcrumb" aria-label="breadcrumbs">
			  <ul>
			    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
			    <li class="is-active"><a >Cooperatives</a></li>
			  </ul>
			</nav>
		</div>
		<div class="column">
				<div class="field has-addons is-expanded">
					<div class="control is-expanded">
						<input type="text" class="input" ng-model="filter_keys">
					</div>
					<div class="control">
						<a class="button is-intercoton-green is-static">
							<span class="icon">
								<i class="fa fa-search"></i>
							</span>
							<span>Rechercher</span>
						</a>
					</div>
				</div>



		</div>
		<div class="column">
				<button class="button is-intercoton-green" ui-sref="admins.cooperatives.create">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span>Ajouter coopérative</span>
				</button>
		</div>
		<div class="column">
				<div class="tabs">
				  <ul>
				    <li class="tabs-cooperative-link is-active"><a ng-click="currenTab='tabular'" class="tabs-cooperative-item button">
					<span class="icon">
						<i class="fa fa-table"></i>
					</span>
					<span>Tableau</span>
				    </a></li>
				    <li class="tabs-cooperative-link"><a ng-click="currenTab='cards'" class="tabs-cooperative-item button">
				      <span class="icon">
				      	<i class="fa fa-object-group"></i>
				      </span> 
						<span>fluid</span>
				       </a></li>
				    <li class="tabs-cooperative-link"><a ng-click="currenTab='maps'" class="tabs-cooperative-item button">
  						<span class="icon">
  							<i class="fa fa-map-marker"></i>
  						</span>
  						<span>Maps</span>
				       </a></li>
				  </ul>
				</div>
		</div>
	</div>
	<!-- Pagintaion module -->
     	<div class="level is-mobile is-pad-bot-30" ng-hide="currenTab == 'maps'">
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

	<!-- Switch Wrapper -->
	<div ng-switch="currenTab">
		<div ng-switch-when="tabular">
				<!-- Tabular view -->
				<table class="table is-hoverable is-striped">
					<thead>
						<tr class="intercoton-skygreen-b">
							<th>Dénomination</th>
							<th>Sigle</th>
							<th>Localisation</th>
							<th>Zone</th>
							<th>Gerant</th>
							<th>Opérateur</th>
							<th>Date création</th>
							<th>Dernière modification</th>
							<th>Date Suppression</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="cooperative in $root.cooperatives | orderBy:default_cooperative_order | filter:filter_keys" ng-class="set_cooperative_state(cooperative.deleted)" class="">
							<td>{{cooperative.cooperative_denomination}}</td>
							<td>{{cooperative.cooperative_sigle}}</td>
							<td>{{cooperative.cooperative_localisation}}</td>
							<td>{{cooperative.zone.zone_denomination}}</td>
							<td>{{cooperative.cooperative_manager}}</td>
							<td>{{cooperative.cooperative_operator}}</td>
							<td>{{cooperative.created | date:'dd/MM/yyyy HH:mm:ss' }}</td>
							<td>{{cooperative.modified | date:'dd/MM/yyyy HH:mm:ss' }}</td>
							<td>{{cooperative.deleted | date:'dd/MM/yyyy HH:mm:ss' }}</td>
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
													 <a ui-sref="admins.cooperatives.edit({cooperative_id:cooperative.id,page_id:1})" class="dropdown-item">
											            	Modifier la coopérative
													 </a>
											    </div>
											  </div>
											</div>
				  			</td>
						</tr>
					</tbody> 
				</table>
		</div>
		<div ng-switch-when="cards">
			<div class="columns is-multilined" style="overflow-x:auto; overflow-y: hidden;">
				<div class="column is-4" ng-repeat="cooperative in cooperatives| orderBy:default_cooperative_order | filter:filter_keys">
					<div class="card hvr-float-shadow is-pointer">
					  <div class="card-image">
					    <figure class="image is-4by3">
					      <img ng-src="{{cooperative.cooperative_assets}}" alt="Placeholder image">
					    </figure>
					  </div>
					  <div class="card-content">
					    <div class="media">
					      <div class="media-left">
							<span class="icon is-medium">
								<i class="fa fa-bank fa-2x has-text-intercoton-green"></i>
							</span>
					      </div>
					      <div class="media-content">
					        <p class="title is-5 is-mar-top-0">{{cooperative.cooperative_denomination}}</p>
					        <p class="subtitle is-6">{{cooperative.cooperative_sigle}}</p>
					        <p class="subtitle is-6 is-mar-bot-3">
								<span class="icon"><i class="fa fa-globe"></i></span>
					        	<span class="has-text-weight-bold">Zone:</span> 
					        	<span>{{cooperative.zone.zone_denomination}}</span>  
					        </p>
					        <p class="subtitle is-6 is-mar-bot-3">
					        	<span class="icon">
					        	  <i class="fa fa-location-arrow"></i>
					        	</span>
					        	<span class="has-text-weight-bold">Sous-préfecture:</span>
					        	<span>{{cooperative.cooperative_sub_prefecture}}</span> 
					        </p>
							<p class="subtitle is-6 is-mar-bot-3">
								<span class="icon"><i class="fa fa-map-marker"></i></span>
								<span class="has-text-weight-bold">Localisation:</span>  
								<span>{{cooperative.cooperative_localisation}}</span>
							</p>
					        <p class="subtitle is-6 is-mar-bot-3">
					        	<span class="icon"><i class="fa fa-users"></i></span>
					        	<span class="has-text-weight-bold">Estimation personnel:</span>  
					        	<span>{{cooperative.cooperative_nbre_personnel}}</span>
					        </p>
					      </div>
					    </div>
					    <div class="content">
					      <time> <span class="has-text-weight-bold">Création: </span>{{cooperative.created | date:'dd/MM/yyyy HH:mm:ss' }}</time>
					    </div>
					  </div>
					  <footer class="card-footer">
					    <a ui-sref="admins.cooperatives.edit({cooperative_id:cooperative.id})" class="card-footer-item hero is-intercoton-green has-text-white has-text-weight-bold">Modifier</a>
					    <a ng-if="cooperative.deleted==null" ng-click="turn_off_cooperative(cooperative)" class="card-footer-item has-text-weight-bold hero is-warning">Masquer</a>
					    <a ng-if="cooperative.deleted!==null" ng-click="turn_on_cooperative(cooperative)" class="card-footer-item has-text-weight-bold hero is-warning">Rendre visible</a>
					  </footer>
					</div>
				</div>
			</div>

		</div>
		<div ng-switch-when="maps">
			<div ng-include="'/admins/cooperatives/maps'"></div>
		</div>
	</div>
	<!-- Pagintaion module -->
     	<div class="level is-mobile is-pad-bot-30"  ng-hide="currenTab == 'maps'">
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

<script>
	    $('.tabs-cooperative-link').on('click', function(){
	    	$('.tabs-cooperative-link').removeClass('is-active');
	    	$(this).addClass('is-active');
	    });

</script>

</section>
