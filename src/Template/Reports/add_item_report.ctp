			<div class="additionnal_report_item_container is-mar-bot-30 is-pad-top-30" id="additional_report_item_<?= $token ?>" style="border-top:1.5px dotted green;">
				<div class="field is-horizontal">
					<div class="field-label">
						<label for="" class="label">prises de vue</label>
					</div>
					<div class="field-body">
						<div class="field">
							<div class="control">
								<div class="level">
									<div class="level-left">
										<?php $values=['a','b','c','d','e']; ?>

										<?php foreach ($values as $value) :?>
										   <div class="level-item">
											     <div ng-if="!report.reports.item<?= $token ?>.evidence<?= $token ?><?= $value ?>" ngf-drop ngf-select ngf-max-size="3MB" ng-model="report.reports.item<?= $token ?>.evidence<?= $token ?><?= $value ?>" class="drop-box button is-hgt-130 is-wth-130">
													<img src="/img/assets/forms/image_upload_drag_area.png" alt="">
												</div>
						  						<figure ng-if="report.reports.item<?= $token ?>.evidence<?= $token ?><?= $value ?>" class="image is-hgt-130 is-wth-130"> 
						  							 <img ngf-thumbnail="report.reports.item<?= $token ?>.evidence<?= $token ?><?= $value ?>" >
						  						</figure>
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
								<textarea name="myName" ui-tinymce="tinymceOptions" required ng-model="report.reports.item<?= $token ?>.report_item_problem_<?= $token ?>" class="textarea"></textarea>
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
								<textarea name="myName" ui-tinymce="tinymceOptions" required ng-model="report.reports.item<?= $token ?>.report_item_recommandation_<?= $token ?>" class="textarea"></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="field is-horizontal">
					<div class="field-label">
						<label for="" class="label">&nbsp;</label>
					</div>
					<div class="field-body">
						<div class="field">
							<div class="control">			
				  				<button class="button is-danger" type="button" ng-click="destroy_item_report('#additional_report_item_<?= $token ?>','item<?= $token ?>')">Supprimer</button>
							</div>
						</div>
					</div>
				</div>
			</div>