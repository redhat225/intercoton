<section ui-view>
		<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li><a ui-sref="admins.cooperatives({page_id:1})">Coopératives</a></li>
					    <li class="is-active"><a >Modifier une coopérative</a></li>
					  </ul>
					</nav>
				</div>
		   </div>


	<h3 class="subtitle">Formulaire Modification Coopérative</h3>
	<form name="editOpaForm" ng-submit="edit()">

		<!-- Photo -->
		<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Photo</label>
				</div>
				<div class="field-body">
					<!-- Current Auditor_photo -->
					<div class="field is-pad-bot-20" ng-if="!opa_edit.is_changing_image">
						<div class="control is-pad-bot-10">
							<figure class="image is-128x128">
								<img ng-src="{{opa_edit.cooperative_assets}}" alt="cooperative_assets">
							</figure>
						</div>
						<button type="button" class="button is-warning has-text-weight-semibold" ng-click="opa_edit.is_changing_image = true">Changer</button>
					</div>
					<!-- Change auditor photo -->
					<div class="field" ng-if="opa_edit.is_changing_image">
						<!-- Preview new Photo -->
						<div class="preview is-pad-bot-60">
							<figure class="image is-128x128">
							   <img ngf-thumbnail="opa_edit.main_photo_candidate || '/img/assets/forms/image_upload.png'">	
							</figure>
						</div>
						<!-- Choose photo -->
						<div class="button" ngf-select ng-model="opa_edit.main_photo_candidate" name="main_photo_candidate" ngf-pattern="'image/*'" ngf-accept="'image/*'" ngf-max-size="5MB">
							Choisir photo
						</div>
						<!-- Cancel choice -->
						<button class="button is-danger" type="button" ng-click="delete_photo_cooperative_change()">Annuler la modification</button>
					</div>
				</div>
		</div>


		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">Dénomination &amp; Sigle</label>
			</div>
			<div class="field-body">
				<!-- Denomination -->
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" name="opa_edit_denomination" placeholder="dénomination" class="input is-uppercase" required ng-model="opa_edit.cooperative_denomination" ng-maxlength="300">
						<span class="icon is-small is-right" ng-show="editOpaForm.opa_edit_denomination.$valid">
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
						<input type="text" name="cooperative_sigle" placeholder="sigle" required class="input is-uppercase" ng-model="opa_edit.cooperative_sigle" ng-maxlength="50">
						<span class="icon is-small is-right" ng-show="editOpaForm.cooperative_sigle.$valid">
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
						<input type="text" name="cooperative_localisation" class="input is-uppercase" required ng-model="opa_edit.cooperative_localisation" ng-maxlength="300" placeholder="Localisation">
						<span class="icon is-small is-right" ng-show="editOpaForm.cooperative_localisation.$valid">
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
						<input type="text" name="opa_edit_cooperative_sub_prefecture" class="input is-uppercase" ng-model="opa_edit.cooperative_sub_prefecture" ng-maxlength="300" placeholder="Sous-préfecture(optionnel)" ng-required="opa_edit.cooperative_sub_prefecture">
						<span class="icon is-small is-right" ng-show="editOpaForm.opa_edit_cooperative_sub_prefecture.$valid">
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
						<input type="text" placeholder="latitude" name="cooperative_latitude" class="input" ng-model="opa_edit.cooperative_latitude"
						 required>
						<span class="icon is-small is-right" ng-show="editOpaForm.cooperative_latitude.$valid">
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
						<input type="text" placeholder="longitude" name="cooperative_longitude" class="input" ng-model="opa_edit.cooperative_longitude" required>
						<span class="icon is-small is-right" ng-show="editOpaForm.cooperative_longitude.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-map-marker"></i>
						</span>
					</div>
				</div>
			</div>
		</div>

		<!-- Nbre personnel -->
		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">Nbre Personnel &amp; Zone</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="number" name="cooperative_nbre_personnel" class="input" ng-model="opa_edit.cooperative_nbre_personnel" required>
						<span class="icon is-small is-right" ng-show="editOpaForm.cooperative_nbre_personnel.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-users"></i>
						</span>
					</div>
				</div>
				<div class="field">
					<div class="control has-icons-left">
							<div class="select">
								<select ng-require="!opa_edit.zone_unavailable" ng-model="opa_edit.zone_id" name="opa_edit.zone_id" id="zone_id" ng-options="z.id as z.zone_denomination for z in zones"></select>
							</div>
							<span class="icon is-small is-left">
								<i class="fa fa-globe"></i>
							</span>
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
						<button class="has-text-weight-bold button is-intercoton-green" ng-disabled="editOpaForm.$invalid || is_loading">
							Valider							
						</button>
						<button type="reset" ui-sref="admins.cooperatives" class="button is-warning has-text-weight-bold ">Annuler</button>
					</div>
				</div>
			</div>
		</div>
		
	</form>
</section>