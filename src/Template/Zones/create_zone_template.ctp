				<div class="field is-horizontal is-pad-top-15 is-pad-bot-20" id="zone_denomination<?= $token ?>">
					<div class="field-label">
						<label for="" class="label">
							&nbsp;
						</label>
					</div>

					<div class="field-body">
						<div class="field">
							<div class="control has-icons-left has-icons-right">
								<input type="text" name="zone_denomination<?= $token ?>" class="input is-uppercase" ng-model="zone.zone_denomination<?= $token ?>" ng-maxlength="100" required>

								<span class="icon is-small is-left">
									<i class="fa fa-globe"></i>
								</span>
								<span class="icon is-small is-right" ng-show="createZoneForm.zone_denomination<?= $token ?>.$valid">
									<i class="fa fa-check has-text-intercoton-green"></i>
								</span>
							</div>
						</div>
						<div class="field">
							<div class="control">
								<button class="button is-danger" ng-click="destroy_item_zone('#zone_denomination<?= $token ?>','zone_denomination<?= $token ?>')">
									<span class="icon is-small">
										<i class="fa fa-close"></i>
									</span>
									<span>Retirer</span> 
								</button>
							</div>
						</div>
					</div>
				</div>