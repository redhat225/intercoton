	<form name="createReportForm" ng-submit="create()">
		<!-- Set title -->
		<div class="field is-horizontal" id="cooperatives_select">
			<div class="field-label">
				<label for="report_title" class="label">Titre Rapport</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" name="report_title" class="input" ng-model="report.report_title" required ng-minlength="10" ng-maxlength="300">
						<span class="icon is-small is-left">
							<i class="fa fa-sticky-note"></i>
						</span>
						<span class="icon is-small is-right" ng-show="createReportForm.report_title.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
					</div>
				</div>
			</div>
		</div>


		<!-- Coopérative select -->
		<div class="field is-horizontal" id="cooperatives_select">
			<div class="field-label">
				<label for="cooperative_id" class="label">Coopérative</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control has-icons-left">
						<div class="select">
							<select required name="cooperative_id" id="cooperative_id" ng-options="c.id as c.cooperative_denomination for c in cooperatives" ng-model="report.cooperative_id"></select>
						</div>
						<span class="icon is-small is-left">
							<i class="fa fa-bank"></i>
						</span>
					</div>
				</div>
				<div class="field">
					<div class="control is-expanded is-fullwidth">
						<button class="button is-intercoton-green" type="button" ng-click="addItemReport()">
							<span class="icon">
								<i class="fa fa-plus"></i>
							</span>
							<span>Ajouter une section</span>
						</button>
					</div>
				</div>
			</div>
		</div>
			<h3 class="subtitle has-text-weight-semibold hero is-intercoton-skygreen is-mar-bot-1 is-pad-bot-20 is-pad-top-20 has-text-intercoton-green" id="report_title">Contenu du rapport</h3>


		
		<!-- report redaction area -->
			<div class="additionnal_report_item_container is-mar-bot-30 is-mar-top-0" id="main_additional_report_item">

				<div class="field is-horizontal is-pad-top-20" style="border-top:1.5px solid green;">
					<div class="field-label">
						<label for="" class="label">prises de vue</label>
					</div>
					<div class="field-body">
						<div class="field">
							<div class="control">
								<div class="level is-mobile">
									<div class="level-left">
										<?php $values=['a','b','c','d','e']; ?>
										<?php foreach ($values as $value) :?>
										   <div class="level-item">
											     <div ng-if="!report.reports.item00.evidences.evidence00<?= $value ?>" ngf-drop ngf-select ngf-max-size="3MB" ng-model="report.reports.item00.evidences.evidence00<?= $value ?>" class="drop-box button is-hgt-130 is-wth-130">
													<img src="/img/assets/forms/image_upload_drag_area.png" alt="">
												</div>
						  						<figure ng-if="report.reports.item00.evidences.evidence00<?= $value ?>" class="image is-hgt-130 is-wth-130"> 
						  							 <img ngf-thumbnail="report.reports.item00.evidences.evidence00<?= $value ?>" >
						  						</figure>
									           <!-- change photo -->
												<button type="button" class="button is-danger is-mar-bot-95" ng-show="report.reports.item00.evidences.evidence00<?= $value ?>" ng-click="report.reports.item00.evidences.evidence00<?= $value ?> = null"><span class="icon"><i class="fa fa-close"></i></span>
												</button>
						  					</div>
										<?php endforeach; ?>
									</div>

									</div>
								</div>

							</div>
					   </div>
				  </div>
  
				<div class="field is-horizontal">
					<div class="field-label">
						<label for="" class="label">problèmes rencontrés</label>
					</div>

					<div class="field-body">
						<div class="field">
							<div class="control">
								<textarea ui-tinymce="tinymceOptions" required ng-model="report.reports.item00.contents.report_item_problem_00" class="textarea"></textarea>
							</div>
						</div>
					</div>
				</div>


				<div class="field is-horizontal">
					<div class="field-label">
						<label for="" class="label">Recommandations</label>
					</div>

					<div class="field-body">
						<div class="field">
							<div class="control">
								<textarea ui-tinymce="tinymceOptions" required ng-model="report.reports.item00.contents.report_item_recommandation_00" class="textarea"></textarea>
							</div>
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
						<button class="has-text-weight-bold button is-intercoton-green" ng-disabled="createReportForm.$invalid || is_loading">
							Valider							
						</button>
						<button type="reset" ng-click="reinit_reports()" class="button is-warning has-text-weight-bold ">Annuler</button>
					</div>
				</div>
			</div>
		</div>
		
	</form>