<section ui-view>
		<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li><a ui-sref="admins.cooperatives">Utilisateurs</a></li>
					    <li class="is-active"><a >Modifier un utilisateur</a></li>
					  </ul>
					</nav>
				</div>
		   </div>




	<div class="edit-form-auditors">
		<form name="editFormAuditors" ng-submit="update(auditor)">
			<h3 class="subtitle">
				Informations personnelles 
			</h3>
			<!-- Photo -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Photo</label>
				</div>
				
				<div class="field-body">
					<!-- Current Auditor_photo -->
					<div class="field" ng-if="!auditorsctrl.is_changing_image">
						<div class="control is-pad-bot-65">
							<figure class="image is-128x128">
								<img ng-src="/img/assets/admins/photo/{{auditor.auditor_photo}}" alt="auditor_photo">
							</figure>
						</div>
	
						<button type="button" class="button is-warning has-text-weight-semibold" ng-click="auditorsctrl.is_changing_image = true">Changer</button>
					</div>
					<!-- Change auditor photo -->
					<div class="field" ng-if="auditorsctrl.is_changing_image">
						<!-- Preview new Photo -->
						<div class="preview is-pad-bot-60">
							<figure class="image is-128x128">
							   <img ngf-thumbnail="auditor.auditor_photo_candidate || '/img/assets/forms/image_upload.png'">	
							</figure>
						</div>
						<!-- Choose photo -->
						<div class="button" ngf-select ng-model="auditor.auditor_photo_candidate" name="auditor_photo_candidate" ngf-pattern="'image/*'" ngf-accept="'image/*'" ngf-max-size="3MB">
							Choisir photo
						</div>
						<!-- Cancel choice -->
						<button class="button is-danger" type="button" ng-click="delete_auditor_photo_candidate()">Annuler la modification</button>
					</div>
				</div>
			
			</div>
			<!-- Nom complet -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Nom Complet</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input required ng-model="auditor.auditor_fullname" ng-pattern='/^[^@&()"!_$*€£`+=\/;?#]+$/' name="auditor_fullname" type="text" class="input is-uppercase">
							<span class="icon is-left is-small">
								<i class="fa fa-vcard"></i>
							</span>
							<span class="icon is-right is-small" ng-if="editFormAuditors.auditor_fullname.$valid">
								<i class="fa fa-check has-text-intercoton-green"></i>
							</span>
							<p class="help" ng-if="editFormAuditors.auditor_fullname.$invalid">
								Le nom complet ne doît pas contenir les caractères suivants: <code>@&amp;()"!_$*€£`+=\/;?#</code>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- Sexe -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="auditor_sexe" class="label">Sexe</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<div class="select">
								<select name="auditor_sexe" ng-model="auditor.auditor_sexe" required id="auditor_sexe">
									<option value="H">Homme</option>
									<option value="F">Femme</option>
								</select>
							</div>
							<p class="help" ng-if="editFormAuditors.auditor_sexe.$invalid">
								Veuillez définir le genre de l'auditeur
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- Contact -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="auditor_contact" class="label">Contact</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input type="text" ng-model="auditor.auditor_contact" class="input" name="auditor_contact">
							<span class="icon is-left is-small">
								<i class="fa fa-mobile-phone"></i>
							</span>
							<span class="icon is-right is-small" ng-if="editFormAuditors.auditor_contact.$valid">
								<i class="fa fa-check has-text-intercoton-green"></i>
							</span>
							<p class="help" ng-if="editFormAuditors.auditor_contact.$invalid">
								Le contact devra représenter un numéro à huit chiffre ex: 08080808
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- Email -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="auditor_email" class="label">Email</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input type="email" ng-model="auditor.auditor_email" class="input" name="auditor_email">
							<span class="icon is-left is-small">
								<i class="fa fa-mobile-phone"></i>
							</span>
							<span class="icon is-right is-small" ng-if="editFormAuditors.auditor_email.$valid">
								<i class="fa fa-check has-text-intercoton-green"></i>
							</span>
							<p class="help" ng-if="editFormAuditors.auditor_email.$invalid">
								veuillez définir un email conforme ex: riehlemm@gmail.com
							</p>
						</div>
					</div>
				</div>
			</div>

			<h3 class="subtitle">
				Compte 
			</h3>
			<!-- Nom Utilisateur -->
			<div class="field is-horizontal">
					<div class="field-label">
						<label for="account_username" class="label">Nom Utilisateur</label>
					</div>
					<div class="field-body">
						<div class="field">
							<div class="control has-icons-left has-icons-right">
								<input required ng-pattern='/^[^@&()"!_$*€£`+=\/;?#]+$/' type="text" ng-model="auditor.auditor_accounts[0].account_username" class="input" name="account_username">
								<span class="icon is-left is-small">
									<i class="fa fa-user"></i>
								</span>
								<span class="icon is-right is-small" ng-if="editFormAuditors.account_username.$valid">
									<i class="fa fa-check has-text-intercoton-green"></i>
								</span>
								<p class="help" ng-if="editFormAuditors.account_username.$invalid">
									veuillez définir un nom d'utilisateur ne comportant pas les caractères suivants : <code>@&amp;()"!_$*€£`+=\/;?#</code>
								</p>
							</div>
						</div>
					</div>
			</div>
			<!-- Rôle -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="role_id" class="label">
						Privilèges
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<div class="select">
								<select name="role_id" required id="role_id" ng-model="auditor.auditor_accounts[0].role_id">
									<option value="1">system</option>	
									<option value="2">auditor</option>	
									<option value="3">observator</option>	
								</select>
							</div>
							<p class="help" ng-if="editFormAuditors.role_id.$invalid">
								Veuillez définir le privilège de l'auditeur
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- old password -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Ancien mot de passe</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input ng-required="auditor.auditor_accounts[0].account_password_old" ng-model="auditor.auditor_accounts[0].account_password_old" ng-pattern='/(?=.*[A-Z]+.*)(?=.*[0-9]+.*)(?=.*[a-z]+.*)(?=.*[!@#$&*]+.*)/' ng-minlength="8" ng-maxlength="20" name="account_password_old" type="password" class="input is-uppercase">
							<span class="icon is-left is-small">
								<i class="fa fa-lock"></i>
							</span>
							<span class="icon is-right is-small" ng-if="editFormAuditors.account_password_old.$valid">
								<i class="fa fa-check has-text-intercoton-green"></i>
							</span>
							<p class="help" ng-if="editFormAuditors.account_password_old.$invalid">
								Le mot de passe doit contenir au moins une lettre minuscule, majuscule, carctère spécial et un nombre, enfin il doit mesurer au minimum 8 caractères.
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- New password -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Nouveau mot de passe</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input ng-required="auditor.auditor_accounts[0].account_password_old" ng-model="auditor.auditor_accounts[0].account_password_new" name="account_password_new"  ng-minlength="8" ng-maxlength="20" type="password" ng-pattern='/(?=.*[A-Z]+.*)(?=.*[0-9]+.*)(?=.*[a-z]+.*)(?=.*[!@#$&*]+.*)/' class="input is-uppercase">
							<span class="icon is-left is-small">
								<i class="fa fa-lock"></i>
							</span>
							<span class="icon is-right is-small" ng-if="editFormAuditors.account_password_new.$valid">
								<i class="fa fa-check has-text-intercoton-green"></i>
							</span>
							<p class="help" ng-if="editFormAuditors.account_password_new.$invalid">
								Le mot de passe doit contenir au moins une lettre minuscule, majuscule, carctère spécial et un nombre, enfin il doit mesurer au minimum 8 caractères.
							</p>
					   </div>
				</div>
			</div>
		</div>
			<!-- Submitting -->
			<div class="field is-horizontal is-mar-top-50">
				<div class="field-label">
					&nbsp;
				</div>
				<div class="field-body">
					<div class="field is-grouped">
						<div class="control">
							<button ng-disabled="editFormAuditors.$invalid || isloading" type="submit" class="button is-intercoton-green">
								Modifier
							</button>
						</div>
						<div class="control">
							<button class="button is-warning" ui-sref="admins.auditors">Annuler</button>
						</div>
					</div>
				</div>

			</div>
		</form>
	</div>
</section>
