<section ui-view>
			<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li ui-sref="admins.cooperatives({page_id:1})"><a >Coopératives</a></li>
					    <li class="is-active"><a >Créer une coopérative</a></li>
					  </ul>
					</nav>
				</div>
			</div>


	<h3 class="subtitle">Formulaire Création Coopérative</h3>
	<form name="createOpaForm" ng-submit="create()">

		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">Dénomination &amp; Sigle</label>
			</div>
			<div class="field-body">
				<!-- Denomination -->
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" name="opa_denomination" placeholder="dénomination" class="input" required ng-model="opa.cooperative_denomination" ng-maxlength="300">
						<span class="icon is-small is-right" ng-show="createOpaForm.opa_denomination.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-bank"></i>
						</span>
					</div>
				</div>
				<!-- Sigle -->
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" name="cooperative_sigle" placeholder="sigle" required class="input is-uppercase" ng-model="opa.cooperative_sigle" ng-maxlength="50">
						<span class="icon is-small is-right" ng-show="createOpaForm.cooperative_sigle.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-cc"></i>
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">Localisation &amp; S/P</label>
			</div>
			<div class="field-body">
				<!-- localisation -->
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" name="cooperative_localisation" class="input is-uppercase" required ng-model="opa.cooperative_localisation" ng-maxlength="300" placeholder="Localisation">
						<span class="icon is-small is-right" ng-show="createOpaForm.cooperative_localisation.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-map"></i>
						</span>
					</div>
				</div>
				<!-- S/P -->
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" name="opa_cooperative_sub_prefecture" class="input is-uppercase" ng-model="opa.cooperative_sub_prefecture" ng-maxlength="300" placeholder="Sous-préfecture(optionnel)" ng-required="opa.cooperative_sub_prefecture">
						<span class="icon is-small is-right" ng-show="createOpaForm.opa_cooperative_sub_prefecture.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-map-o"></i>
						</span>
					</div>

				</div>
			</div>
		</div>

		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">Coordonnées GPS</label>
			</div>
			<div class="field-body">
				<!-- Latitude -->
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" placeholder="latitude" name="cooperative_latitude" class="input" ng-model="opa.cooperative_latitude"
						 required>
						<span class="icon is-small is-right" ng-show="createOpaForm.cooperative_latitude.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-map-marker"></i>
						</span>
					</div>
				</div>
				<!-- Longitude -->
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" placeholder="longitude" name="cooperative_longitude" class="input" ng-model="opa.cooperative_longitude" required>
						<span class="icon is-small is-right" ng-show="createOpaForm.cooperative_longitude.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-map-marker"></i>
						</span>
					</div>
				</div>
			</div>
		</div>


		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">Nbre Personnel</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="number" name="cooperative_nbre_personnel" class="input" ng-model="opa.cooperative_nbre_personnel" required>
						<span class="icon is-small is-right" ng-show="createOpaForm.cooperative_nbre_personnel.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-users"></i>
						</span>
					</div>

				</div>
			</div>
		</div>

		<div class="field is-horizontal" ng-if="!opa.zone_unavailable">
			<div class="field-label">
				<label for="zone_id" class="label">Zone</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control has-icons-left">
							<div class="select">
								<select ng-require="!opa.zone_unavailable" ng-model="opa.zone_id" name="opa.zone_id" id="zone_id" ng-options="z.id as z.zone_denomination for z in zones"></select>
							</div>
							<span class="icon is-small is-left">
								<i class="fa fa-globe"></i>
							</span>
					</div>
				</div>
			</div>
		</div>	
		<!-- Zone not Found -->
		<div class="field is-horizontal">
			<div class="field-label">
				<label for="">&nbsp;</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control">
						<label for="zone_unavailable" class="checkbox label">
							<input id="zone_unavailable" type="checkbox" ng-model="opa.zone_unavailable">
							je ne retrouve pas la zone souhaitée
						</label>
					</div>
				</div>
			</div>
		</div>
		<!-- Create Zone when not found -->
		<div class="field is-horizontal" ng-if="opa.zone_unavailable">
			<div class="field-label">
				<label for="zone_denomination" class="label">Créer et associer une nouvelle zone</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input id="zone_denomination" type="text" name="zone_denomination" ng-model="opa.zone_denomination" ng-maxlength="300" class="is-uppercase input" ng-required="opa.zone_unavailable">
						<span class="icon is-small is-left">
							<i class="fa fa-globe"></i>
						</span>
						<span class="icon is-small is-right" ng-show="createOpaForm.zone_denomination.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
					</div>
				</div>
			</div>
		</div>



	    <div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">Photo Site</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control">
  						<div ng-if="!opa.main_photo_candidate" class="button is-intercoton-green is-outlined is-mar-bot-30" ngf-select ng-model="opa.main_photo_candidate" name="opa.main_photo_candidate" required ngf-pattern="'image/*'" ngf-accept="'image/*'" ngf-max-size="5MB"> <span class="icon"><i class="fa fa-image"></i></span> <span>Selectionner un visuel</span></div>
  						<!-- change photo -->
						<button type="button" class="button is-danger is-mar-bot-30" ng-show="opa.main_photo_candidate" ng-click="opa.main_photo_candidate=null"><span class="icon"><i class="fa fa-close"></i></span><span>Effacer</span></button>
  						<figure class="image is-hgt-130 is-wth-130"> 
  							 <img ngf-thumbnail="opa.main_photo_candidate || '/img/assets/forms/image_upload.png'">
  						</figure>
					</div>
				</div>

			</div>
		</div>

	    <div class="field is-horizontal is-mar-top-30">
			<div class="field-label">
				<label for="" class="label">&nbsp;</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control is-grouped">
						<button class="has-text-weight-bold button is-intercoton-green" ng-disabled="createOpaForm.$invalid || is_loading">
							Valider							
						</button>
						<button type="reset" ui-sref="admins.cooperatives({page_id:1})" class="button is-warning has-text-weight-bold ">Annuler</button>
					</div>
				</div>
			</div>
		</div>
		
	</form>
</section>