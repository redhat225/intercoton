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
			    <li><a ui-sref="admins.sessions({page_id:1})">Sessions</a></li>
			    <li class="is-active"><a >Rapports</a></li>
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
				<button class="button is-intercoton-green" ui-sref="admins.reports.create({session_id})">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span>Créer un nouveau rapport</span>
				</button>
		</div>
	</div>

	<!-- Switch Wrapper -->
	<div ng-switch="currenTab">
		<div ng-switch-when="tabular">
				<!-- Tabular view -->
				<table class=" table is-fullwidth is-hoverable is-striped">
					<thead>
						<tr class="intercoton-skygreen-b">
							<th>Coopérative</th>
							<th>Titre</th>
							<th>Date création</th>
							<th>Dernière modification</th>
							<th>Rédacteur</th>
							<th>Session</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="report in reports | orderBy:created | filter:filter_keys">
							<td>{{report.cooperative.cooperative_denomination}}</td>
							<td>{{report.report_title}}</td>
							<td>{{report.created | date: 'dd/MM/yyyy HH:mm:ss'}}</td>
							<td>{{report.modified | date: 'dd/MM/yyyy HH:mm:ss'}}</td>
							<td>{{report.auditor_account.auditor.auditor_fullname}}</td>
							<td>{{report.session.session_denomination}}</td>
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
													 <a ui-sref="admins.reports.view({report_id:report.id})" class="dropdown-item">
											            	Voir le rapport
													 </a>

											         <a ui-sref="admins.reports.edit({report_id:report.id})" class="dropdown-item">
															Modifier le rapport
												    </a>
											        <a ng-click="delete_report(report.id)" class="dropdown-item">
											        	Supprimer le rapport
													</a>
											    </div>
											  </div>
											</div>
				  			</td>
						</tr>
					</tbody> 
				</table>
		</div>
		<div ng-switch-when="authors">

		</div>
		<div ng-switch-when="cooperatives">

		</div>
	</div>

<script>
	    $('.tabs-cooperative-link').on('click', function(){
	    	$('.tabs-cooperative-link').removeClass('is-active');
	    	$(this).addClass('is-active');
	    });

</script>

</section>
