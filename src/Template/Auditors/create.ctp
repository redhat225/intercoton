<section ui-view>
			<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li ui-sref="admins.auditors"><a >Utilisateurs</a></li>
					    <li class="is-active"><a >Créer un utilisateur</a></li>
					  </ul>
					</nav>
				</div>
			</div>


<div class="box is-radiusless is-shadowless intercoton-skygreen-b">
	<div class="section is-small is-pad-top-0">
		<div class="level">
			<div class="level-left">
				<h3 class="level-item is-size-4 has-text-weight-semibold">
					Formulaire de création auditeur
				</h3>
			</div>
		</div>
		<form name="createAuditorForm" ng-submit="upload(auditor)">
			<h3 class="subtitle has-text-weight-semibold">
				Informations personnelles
			</h3>
			<!-- Nom complet -->
			<div class="field is-horizontal">
				<div class="field-label is-normal">
						<label class="label">Nom Complet*</label>
				</div>
				<div class="field-body">
					<div class="field">
						<p class="control is-expanded has-icons-left has-icons-right">
							<input type="text" ng-minlength="5" required ng-maxlength="300" ng-model="auditor.auditor_fullname" ng-pattern='/^[^@&()"!_$*€£`+=\/;?#]+$/' name="auditor_fullname" ng-class="analyze(createAuditorForm.auditor_fullname.$valid,createAuditorForm.auditor_fullname.$pristine)" class="input is-uppercase" placeholder="ex: RIEHL Emmanuel">
							<span class="icon is-small is-left">
								<i class="fa fa-vcard" aria-hidden="true"></i>
							</span>

							<span class="icon is-right is-small" ng-if="createAuditorForm.auditor_fullname.$valid">
								<i class="fa fa-check has-text-intercoton-green" aria-hidden="true"></i>
							</span>

						</p>
						<p class="help is-error" ng-if="createAuditorForm.auditor_title.$invalid">
							<span>
								le nom est obligatoire et comprend entre 10 et 300 caractères
							</span> <br>
							<span>
								les caractères suivants ne sont pas autorisés <code>@&amp;()"!_$*€£`+=\/;?#</code>
							</span>
						</p>
					</div>
				</div>
			</div>
			<!-- Sexe -->
			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Sexe*</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left">
							<div class="select" ng-init="auditor.auditor_sexe = 'H'">
								<select name="auditor_sexe" ng-model="auditor.auditor_sexe" required>
									<option value="H">Homme</option>
									<option value="F">Femme</option>
								</select>
							</div>
							<div class="icon is-small is-left">
								<i class="fa fa-transgender"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Contact -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Contact*</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right is-expanded">
							<input name="auditor_contact" type="text" ng-model="auditor.auditor_contact" required type="number" ng-pattern="/^[0-9]{8}$/" class="input" placeholder="ex: 08080808">
							<span class="icon is-small is-left">
								<i class="fa fa-mobile-phone"></i>
							</span>
							<span class="icon is-small is-right" ng-if="createAuditorForm.auditor_contact.$valid">
								<i class="fa fa-check has-text-intercoton-green"></i>
							</span>
						</div>
					</div>

				</div>
			</div>
			<!-- email -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Email</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right is-expanded">
							<input name="auditor_email" ng-model="auditor.auditor_email" type="email" class="input" required placeholder="ex: riehlemm@gmail.com">
							<span class="icon is-small is-left">
								<i class="fa fa-envelope-o"></i>
							</span>
							<span class="icon is-small is-right" ng-if="createAuditorForm.auditor_email.$valid">
								<i class="fa fa-check has-text-intercoton-green"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Photo -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Photo</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div required ng-if="!auditor.auditor_photo_candidate" class="button is-mar-bot-30" ngf-select ng-model="auditor.auditor_photo_candidate" name="cover" ngf-pattern="'image/*'" ngf-accept="'image/*'" ngf-max-size="3MB" ng-min-height="200" ngf-min-width="200">Sélectionner</div>

						<div class="image-preview">
							<figure class="image" style="max-width: 200px;">
								<img ngf-thumbnail="auditor.auditor_photo_candidate || '/img/assets/forms/image_upload.png'">
							</figure>

						</div>
					
						<div ng-if="auditor.auditor_photo_candidate" class="button is-vne-orange is-outlined is-mar-top-30" ng-click="auditor.auditor_photo_candidate=''">
							Effacer
						</div>

						<p class="help" ng-if="createAuditorForm.cover.$invalid">
							la photo est obligatoire, représente une image (jpeg, jpg, bitmap, png) et la taille ne doit pas être supérieure à 3MB 
						</p>
					</div>
				</div> 
			
			</div>

			<h3 class="subtitle has-text-weight-semibold">Informations de compte</h3>
			<!-- Username -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Nom Utilisateur</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input name="account_username" class="input" type="text" ng-model="auditor.account.account_username" required ng-pattern='/^[^@&()"!_$*€£`+=\/;?#]+$/' placeholder="ex: Remmanuel225">
							<span class="icon is-small is-left">
								<i class="fa fa-user"></i>
							</span>
							<span class="icon is-small is-right" ng-if="createAuditorForm.account_username.$valid">
								<i class="fa fa-check has-text-intercoton-green"></i>
							</span>
						</div>

					</div>
				</div>
			</div>
			<!-- Roles -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Privilèges</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left">
							<div class="select">
								<select name="account_role" required ng-model="auditor.account.role_id">
									<?php foreach($roles_all as $role): ?>
										<?php if($role['id']==2): ?>
									      <option value="<?= $role['id'] ?>"><?= $role['role_denomination'] ?></option>
									   <?php else: ?>
									      <option value="<?= $role['id'] ?>"><?= $role['role_denomination'] ?></option>
									   <?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="icon is-small is-left">
								<i class="fa fa-superpowers"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Avatar -->
				<div class="field is-horizontal">
					<div class="field-label">
						<label for="" class="label">Avatar</label>
					</div>
					<div class="field-body">
							<div class="field">
								<div ng-if="!auditor.account.account_avatar_candidate" class="button is-mar-bot-30" ngf-select ng-model="auditor.account.account_avatar_candidate" name="account_avatar_candidate" ngf-pattern="'image/*'" ngf-accept="'image/*'" ngf-max-size="3MB" ng-min-height="200" ngf-min-width="200">Sélectionner</div>

								<div class="image-preview">
									<figure class="image" style="max-width: 200px;">
										<img ngf-thumbnail="auditor.account.account_avatar_candidate || '/img/assets/forms/image_upload.png'">
									</figure>

								</div>
							
								<div ng-if="auditor.account.account_avatar_candidate" class="button is-vne-orange is-outlined is-mar-top-30" ng-click="auditor.account.account_avatar_candidate=''">
									Effacer
								</div>
								<p class="help" ng-if="createAuditorFormaccount.account_avatar_candidate.$invalid">
									l'image d'avatar n'est pas obligatoire, représente une image (jpeg, jpg, bitmap, png) et la taille ne doit pas être supérieure à 3MB 
								</p>
							</div>
					  </div> 
				</div>
	
			<!-- Password -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Mot de Passe</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input ng-maxlength="20" class="input" name="account_password" type="password" ng-model="auditor.account.account_password" required ng-pattern='/(?=.*[A-Z]+.*)(?=.*[0-9]+.*)(?=.*[a-z]+.*)(?=.*[!@#$&*]+.*)/'>
							<span class="icon is-small is-left">
								<i class="fa fa-lock"></i>
							</span>
							<span class="icon is-small is-right" ng-if="createAuditorForm.account_password.$valid">
								<i class="fa fa-check"></i>
							</span>
							<p class="help" ng-if="createAuditorForm.account_password.$invalid">
								Il est impératif de définir un mot de passe contenant au moins une lettre majuscule, un/plusieurs nombres,un caractère spécial, ainsi qu'une/plusieurs lettres minuscules.
							</p>
							<p class="help" ng-if="createAuditorForm.account_password.$error.maxlength">
								Le mot de passe ne doit pas dépasser 20 caractères
							</p>
						</div>

					</div>
				</div>
			</div>

			<!-- Buttons controls -->
			<div class="field is-grouped is-pad-top-10">
				<div class="field-label">
					<label for="" class="label"></label>
				</div>
				<div class="field-body">
				  <p class="control is-mar-rgt-30">
				    <button type="submit" ng-disabled="createAuditorForm.$invalid || is_loading=='is-loading'" class="button is-vne-orange" ng-class="{{is_loading}}">
				      Valider
				    </button>
				  </p>
				  <p class="control">
				    <button type="reset" class="button is-danger is-outlined" ng-click="reset_form()">
				      Annuler
				    </button>
				  </p>
				</div>
			</div>
		</form>
	</div>
</div>
</section>

