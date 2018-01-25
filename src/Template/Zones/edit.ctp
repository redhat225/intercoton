<section ui-view>
		<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li><a ui-sref="admins.zones">Zones</a></li>
					    <li class="is-active"><a >Modifier une zone</a></li>
					  </ul>
					</nav>
				</div>
		   </div>


	<h3 class="subtitle">Formulaire Modification de zone</h3>

	<form name="createZoneForm" ng-submit="zonescontroller.edit(zonescontroller.zone)">
		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">
					Dénomination
				</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" name="zone_denomination" class="input is-uppercase" ng-model="zonescontroller.zone.zone_denomination" ng-maxlength="100" required>

						<span class="icon is-small is-left">
							<i class="fa fa-globe"></i>
						</span>
						<span class="icon is-small is-right" ng-show="createZoneForm.zone_denomination.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">
					&nbsp;
				</label>
			</div>
			<div class="field-body">
				<div class="field is-grouped">
					<div class="control has-icons-left has-icons-right">
						<button class="button is-intercoton-green has-text-weight-bold" ng-disabled="createZoneForm.$invalid || zonescontroller.is_loading" type="submit">Valider</button>
					</div>
					<div class="control">
						<button class="button is-warning has-text-weight-bold" type="reset" ui-sref="admins.zones">Annuler</button>
					</div>
				</div>
			</div>
		</div>

	</form>
</section>