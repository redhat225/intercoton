<section ui-view>
	<div class="level">
		<div class="level-left">
			<div class="level-item">
				<span class="icon">
					<i class="fa fa-television fa-2x has-text-intercoton-green"></i>
				</span>
				<span class="has-text-intercoton-green has-text-weight-semibold is-pad-lft-20">Dashboard</span> 	
			</div>
		</div>
		<div class="level-right">
			<span class="icon">
				<i class="fa fa-sort-numeric-asc  has-text-intercoton-green"></i>
			</span>
			<span class="level-item has-text-weight-semibold has-text-intercoton-green">Statistiques Brèves</span>
		</div>
	</div>
	<?php if($role_denomination != "auditor"): ?>
		<!-- Qucik Stats Preview - Observator & system -->
		<div class="tile is-ancestor">
			<div class="tile is-parent">
				<div class="tile is-child box hero is-intercoton-skygreen">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fa fa-sticky-note fa-2x has-text-intercoton-green"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Rapports</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green">{{brief_stats.reports_count}}</p>
						</div>
						<div class="media-right">
							<span class="icon button is-medium is-intercoton-green" ui-sref="admins.sessions({page_id:1})">
								<i class="fa fa-plus"></i>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box  hero is-intercoton-skygreen">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fa fa-bank fa-2x has-text-intercoton-green"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Cooperatives</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green">{{brief_stats.cooperatives_count}}</p>
						</div>
						<div class="media-right">
							<span class="icon button is-medium is-intercoton-green" ui-sref="admins.cooperatives.create({page_id:1})">
								<i class="fa fa-plus"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="tile is-parent">
				<div class="tile is-child box  hero is-intercoton-skygreen">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fa fa-globe fa-2x has-text-intercoton-green"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Zones</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green">{{brief_stats.zones_count}}</p>
						</div>
						<div class="media-right">
							<span class="icon button is-medium is-intercoton-green" ui-sref="admins.zones.create({page_id:1})">
								<i class="fa fa-plus"></i>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box  hero is-intercoton-skygreen">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fa fa-users fa-2x has-text-intercoton-green"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Utilisateurs</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green">{{brief_stats.auditor_accounts_count}}</p>
						</div>
						<div class="media-right">
							<span class="icon button is-medium is-intercoton-green" ui-sref="admins.auditors.create({page_id:1})">
								<i class="fa fa-plus"></i>
							</span>
						</div>
					</div>
				</div>
		</div>
	<?php endif; ?>

	<?php if($role_denomination == "auditor"): ?>
		<div class="tile is-ancestor">
			<div class="tile is-parent">
				<div class="tile is-child box hero is-intercoton-skygreen">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fa fa-sticky-note fa-2x has-text-intercoton-green"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Rapports rédigés</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green">{{brief_stats.reports_count}}</p>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box hero is-intercoton-skygreen">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fa fa-sticky-note fa-2x has-text-intercoton-green"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Créer un rapport</p>
						</div>
						<div class="media-right">
							<span class="icon button is-medium is-intercoton-green" ui-sref="admins.sessions({page_id:1})">
								<i class="fa fa-plus"></i>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box hero is-intercoton-skygreen">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fa fa-bank fa-2x has-text-intercoton-green"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Créer une coopérative</p>
						</div>
						<div class="media-right">
							<span class="icon button is-medium is-intercoton-green" ui-sref="admins.cooperatives.create({page_id:1})">
								<i class="fa fa-plus"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

</div>
	<div class="tile is-ancestor">
		<div class="tile is-parent">
			<div class="tile is-7 is-child box is-pad-full-0">
				<div class="panel">
					<div class="panel-heading intercoton-skygreen-b is-pad-rgt-0 is-pad-rgt-0">
						<div>
							<span class="icon">
								<i class="fa fa-area-chart fa-2x has-text-intercoton-green"></i>
							</span>
							<span class="has-text-intercoton-green has-text-weight-semibold is-pad-lft-20 is-size-6">Statistiques des rapports rédigés/mois</span> 
						</div>
					</div>
					<div class="panel-block">
						<canvas  id="line" class="chart chart-line" chart-data="data"
						chart-labels="labels" chart-colors="colors" chart-series="series" chart-options="options"
						chart-dataset-override="datasetOverride" chart-click="onClick">
						</canvas>
					</div>
				</div>

			</div>
			<div class="tile is-1 is-child">
				&nbsp;
			</div>
			<!-- Doughnout -->
			<div class="tile is-4 is-child box is-pad-full-0">
				<div class="panel">
					<div class="panel-heading intercoton-skygreen-b is-pad-rgt-0">
						<div>
							<span class="icon">
								<i class="fa fa-pie-chart fa-2x has-text-intercoton-green"></i>
							</span>
							<span class="has-text-intercoton-green has-text-weight-semibold is-pad-lft-20 is-size-6">les répartitions régions/coopératives</span> 	
						</div>
					</div>
					<div class="panel-block">
					<canvas width="100%" height="100%" id="doughnut" class="chart chart-doughnut"
					  chart-data="data_doughnout" chart-colors="colors" chart-labels="labels_doughnout">
					</canvas>
					</div>
				</div>

			</div>
		</div>
	</div>



</section>