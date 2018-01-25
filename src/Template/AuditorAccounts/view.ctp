<div class="profile-wrapper">
	<h3 class="subtitle has-text-weight-semibold">Informations personnelles</h3>
	<form ng-submit="update()" name="editProfileForm">
		<div class="personal-informations is-mar-bot-35">
			<!-- Photo -->
			<div class="field is-horizontal ">
				<div class="field-label">
					<label class="label">Photo</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control is-mar-bot-80">
							<figure class="image is-128x128 ">
							   <img ng-src="/img/assets/admins/photo/{{profile.auditor.auditor_photo}}" class="" alt="">
							</figure>
						</div>
					</div>
				</div>
			</div>

			<!-- Fullname -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Nom complet</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<div class="input" readonly ng-bind="profile.auditor.auditor_fullname"></div>
						</div>
					</div>
				</div>
			</div>

			<!-- Contacts -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Contacts</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<div class="input" readonly ng-bind="profile.auditor.auditor_contact"></div>
						</div>
					</div>
					<div class="field">
						<div class="control">
							<div class="input" readonly ng-bind="profile.auditor.auditor_email"></div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<h3 class="subtitle has-text-weight-semibold">Compte Utilisateur</h3>
		<div class="account-information is-mar-bot-35">

				<!-- Photo -->
				<div class="field is-horizontal">
					<div class="field-label">
						<label for="" class="label">Avatar</label>
					</div>
					
					<div class="field-body">
						<!-- Current Auditor_photo -->
						<div class="field" ng-if="!profilesctrl.is_changing_image">
							<div class="control is-pad-bot-30">
								<figure class="image is-128x128">
									<img ng-src="/img/assets/admins/avatar/{{profile.account_avatar}}" style="border-radius:50%;" alt="Avatar">
								</figure>
							</div>
		
							<button type="button" class="button is-warning has-text-weight-semibold" ng-click="profilesctrl.is_changing_image = true">Changer mon avatar</button>
						</div>
						<!-- Change auditor photo -->
						<div class="field" ng-if="profilesctrl.is_changing_image">
							<!-- Preview new Photo -->
							<div class="preview is-pad-bot-60">
								<figure class="image is-128x128">
								   <img ngf-thumbnail="profile.account_avatar_candidate || '/img/assets/forms/image_upload.png'">	
								</figure>
							</div>
							<!-- Choose photo -->
							<div class="button" ngf-select ng-model="profile.account_avatar_candidate" name="auditor_photo_candidate" ngf-pattern="'image/*'" ngf-accept="'image/*'" ngf-max-size="3MB">
								Choisir photo
							</div>
							<!-- Cancel choice -->
							<button class="button is-danger" type="button" ng-click="delete_auditor_photo_candidate()">Annuler la modification</button>
						</div>
					</div>
				
				</div>
			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Nom Utilisateur &amp; Privilèges</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<div class="input" readonly ng-bind="profile.account_username"></div>
						</div>
					</div>
					<div class="field">
						<div class="control">
							<div class="input" readonly ng-bind="profile.role.role_denomination"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Ancien mot de passe</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="password" ng-model="profile.old_password" ng-required="profile.old_password" ng-pattern='/(?=.*[A-Z]+.*)(?=.*[0-9]+.*)(?=.*[a-z]+.*)(?=.*[!@#$&*]+.*)/' class="input"/>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Nouveau mot de passe</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="password" ng-model="profile.new_password" ng-required="profile.old_password"  ng-pattern='/(?=.*[A-Z]+.*)(?=.*[0-9]+.*)(?=.*[a-z]+.*)(?=.*[!@#$&*]+.*)/' class="input"/>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div class="field-label">&nbsp;</div>
				<div class="field-body">
					<div class="field is-grouped">
						<div class="control">
							<button class="button is-intercoton-green" type="submit" ng-disabled="editProfileForm.$invalid || is_loading">
								Enregistrer les changements
							</button>
						</div>
						<div class="control">
							<button class="button is-warning has-text-weight-semibold" ui-sref="admins.dashboard" type="reset">Annuler</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</form>



</div>