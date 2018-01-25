			<div class="additionnal_photo_container is-mar-bot-30" id="additional_photo_<?= $token ?>">
				<div>
						<div required ng-if="!opa.photos_add.additional_photo_<?= $token ?>" ngf-drop ngf-select ngf-max-size="5MB" ng-model="opa.photos_add.additional_photo_<?= $token ?>" class="drop-box button is-hgt-130 is-wth-130">
							<img src="/img/assets/forms/image_upload_drag_area.png" alt="">
						</div>
  						<figure ng-if="opa.photos_add.additional_photo_<?= $token ?>" class="image is-hgt-130 is-wth-130"> 
  							 <img ngf-thumbnail="opa.photos_add.additional_photo_<?= $token ?>" >
  						</figure>
				</div>

  						<button class="button is-danger" type="button" ng-click="destroy_item_opa_image_item('#additional_photo_<?= $token ?>','additional_photo_<?= $token ?>')">Supprimer</button>
			</div>

<!-- 
				<div class="field">
					<div class="control">
						<button type="button" id="additional_images" class="button is-warning is-mar-bot-30" ng-click="addItemImageOpa()">
							<span class="icon"><i class="fa fa-plus"></i></span>
							<span>Ajouter des visuels (3 maximum)</span>
						</button>
						
					</div>
				</div> -->