<section ui-view>
	<div class="level">
		<div class="level-left">
			<div class="level-item">
				<nav class="breadcrumb" aria-label="breadcrumbs">
				  <ul>
				    <li><a href="#">Dashboard</a></li>
				    <li><a ui-sref="admins.sessions({page_id:1})">Sessions</a></li>
				    <li><a ng-click="go_to_reports()">Rapports</a></li>
				    <li class="is-active"><a href="#" aria-current="page">Vue Rapport</a></li>
				  </ul>
				</nav>
			</div>
		</div>
		<div class="level-right">
			<div class="level-item">
				<div class="notification is-intercoton-darkblue">
				  <h1 class="subtitle is-mar-bot-30">Fiche d'intervention</h1>
				  <span class="icon is-small is-pulled-right">
				  	<i class="fa fa-info"></i>
				  </span>
				  <p>
				  	 <span class="icon">
				  	 	<i class="fa fa-sticky-note is medium"></i>
				  	 </span>
				  	 <span class="has-text-weight-semibold">{{report.report_title}}</span>
				  </p>
				  <p>
				  	 <span class="icon">
				  	 	<i class="fa fa-user is medium"></i>
				  	 </span>
				  	 <span class="has-text-weight-semibold">{{report.auditor_account.auditor.auditor_fullname}} (rédacteur)</span>
				  </p>
				  <p>
				  	 <span class="icon">
				  	 	<i class="fas fa-user"></i>
				  	 </span>
				  	 <span class="has-text-weight-semibold">{{report.cooperative.cooperative_operator}} (Gérant)</span>
				  </p>
				  <p>
				  	 <span class="icon">
				  	 	<i class="fas fa-user"></i>
				  	 </span>
				  	 <span class="has-text-weight-semibold">{{report.cooperative.cooperative_operator}} (opérateur(trice) de saisie)</span>
				  </p>
				  <p>
				  	 <span class="icon">
				  	 	<i class="fas fa-calendar-alt"></i>
				  	 </span>
				  	 <span class="has-text-weight-semibold">{{report.created | date:'dd/MM/yyyy HH:mm:ss'}} (date edition)</span>
				  </p>
				  <p>
				  	 <span class="icon">
				  	 	<i class="fas fa-home"></i>
				  	 </span>
				  	 <span class="has-text-weight-semibold">{{report.cooperative.cooperative_denomination}}</span>
				  </p>
				  <p>
				  	 <span class="icon">
				  	 	<i class="fas fa-globe"></i>
				  	 </span>
				  	 <span class="has-text-weight-semibold">{{report.cooperative.zone.zone_denomination}}</span>
				  </p>

				</div>
			</div>
		</div>
	</div>

	<div class="report_item">

	<form name="createReportForm" ng-submit="no_submit()">
	    <h3 class="is-pad-lft-10 subtitle has-text-weight-semibold hero is-intercoton-skygreen is-mar-bot-1 is-pad-bot-20 is-pad-top-20 has-text-intercoton-green" id="report_title">Fiche Technique Intervention</h3>
		<div class="tabs is-toggle is-fullwidth">
		  <ul>
		    <li class="item_bar_report is-active">
		      <a ng-click="reporTab = 'first'">
		        <span class="icon is-small"><i class="fas fa-image"></i></span>
		        <span>Env.Travail</span>
		      </a>
		    </li>
		    <li class="item_bar_report">
		      <a ng-click="reporTab = 'second'">
		        <span class="icon is-small"><i class="fas fa-calculator"></i></span>
		        <span>Inventaire</span>
		      </a>
		    </li>
		    <li class="item_bar_report">
		      <a ng-click="reporTab = 'third'">
		        <span class="icon is-small"><i class="far fa-hdd"></i></span>
		        <span>Materiel informatique</span>
		      </a>
		    </li>
		    <li class="item_bar_report">
		      <a ng-click="reporTab = 'fourth'">
		        <span class="icon is-small"><i class="fab fa-accusoft"></i></span>
		        <span>Application</span>
		      </a>
		    </li>
		    <li class="item_bar_report">
		      <a ng-click="reporTab = 'fifth'">
		        <span class="icon is-small"><i class="far fa-calendar"></i></span>
		        <span>Formation</span>
		      </a>
		    </li>
		    <li class="item_bar_report">
		      <a ng-click="reporTab = 'sixth'">
		        <span class="icon is-small"><i class="fas fa-book"></i></span>
		        <span>Competence</span>
		      </a>
		    </li>
		    <li class="item_bar_report">
		      <a ng-click="reporTab ='seventh'">
		        <span class="icon is-small"><i class="fas fa-th-list"></i></span>
		        <span>Rapportage</span>
		      </a>
		    </li>
		    <li class="item_bar_report">
		      <a ng-click="reporTab = 'eight'">
		        <span class="icon is-small"><i class="far fa-images"></i></span>
		        <span>prises de vue</span>
		      </a>
		    </li>
		  </ul>
		</div>
	   <div ng-switch="reporTab">
	   	   <div ng-switch-when="first">
				<ng-form name="env">
					    <!-- locaux freezed  -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Les locaux sont-ils climatisés?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_freezed" value="true" ng-model="report_content.env.is_freezed.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_freezed" value="false" ng-model="report_content.env.is_freezed.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_freezed_details" ng-model="report_content.env.is_freezed.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_freezed_obs" ng-minlength="10" ng-model="report_content.env.is_freezed.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- locaux ventilate -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Les locaux sont-ils ventilés?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_ventilated" value="true" ng-model="report_content.env.is_ventilated.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_ventilated" value="false" ng-model="report_content.env.is_ventilated.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_ventilated_details" ng-model="report_content.env.is_ventilated.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_ventilated_obs" ng-minlength="10" ng-model="report_content.env.is_ventilated.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- locaux securisées clefs -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									L’accès aux locaux est-il sécurisé par des clés ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_key_secured" value="true" ng-model="report_content.env.is_key_secured.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_key_secured" value="false" ng-model="report_content.env.is_key_secured.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_key_secured_details" ng-model="report_content.env.is_key_secured.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_key_secured_obs" ng-minlength="10" ng-model="report_content.env.is_key_secured.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- locaux communication entre les agents e -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Est-il une communication (franche) entre les agents et le responsable de la coopérative ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_communication_between_members" value="true" ng-model="report_content.env.is_communication_between_members.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_communication_between_members" value="false" ng-model="report_content.env.is_communication_between_members.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_communication_between_members_details" ng-model="report_content.env.is_communication_between_members.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_communication_between_members_obs" ng-minlength="10" ng-model="report_content.env.is_communication_between_members.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Problèmes liés à l'env de travail -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Est-il une communication (franche) entre les agents et le responsable de la coopérative ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_problems_workenv" value="true" ng-model="report_content.env.is_problems_workenv.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_problems_workenv" value="false" ng-model="report_content.env.is_problems_workenv.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_problems_workenv_details" ng-model="report_content.env.is_problems_workenv.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_problems_workenv_obs" ng-minlength="10" ng-model="report_content.env.is_problems_workenv.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
				</ng-form>	
	   	   </div>
	   	   <div ng-switch-when="second">
	   	   		<ng-form name="inventory">
	   	   			   <!-- Immatriculation -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Numéro immatriculation
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="immatriculation" ng-model="report_content.inventory.immatriculation" cols="30" rows="1" placeholder="immatriculation" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

	   	   			   <!-- Caractéristiques -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Caracteriqtiques PC
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="specifications_brand" required ng-model="report_content.inventory.specifications.brand" cols="30" rows="1" placeholder="Marque" class="textarea"></textarea>
										</div>
									</div>
								</div>

								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="specifications_power" required ng-model="report_content.inventory.specifications.power" cols="30" rows="1" placeholder="Vitesse Processeur" class="textarea"></textarea>
										</div>
									</div>
								</div>

								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="specifications_hdd" required ng-model="report_content.inventory.specifications.hdd" cols="30" rows="1" placeholder="HDD" class="textarea"></textarea>
										</div>
									</div>
								</div>

								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="specifications_ram" required ng-model="report_content.inventory.specifications.ram" cols="30" rows="1" placeholder="Ram" class="textarea"></textarea>
										</div>
									</div>
								</div>

								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="specifications_screen" required ng-model="report_content.inventory.specifications.screen" cols="30" rows="1" placeholder="Ecran" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

	   	   		</ng-form>
	   	   </div>
	   	   <div ng-switch-when="third">
				<ng-form name="hardware">
					    <!-- La Machine est elle fonctionnelle  -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									La machine est-elle fonctionnelle
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_hardware_work" value="true" ng-model="report_content.hardware.is_hardware_work.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_hardware_work" value="false" ng-model="report_content.hardware.is_hardware_work.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_hardware_work_details" ng-model="report_content.hardware.is_hardware_work.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_hardware_work_obs" ng-minlength="10" ng-model="report_content.hardware.is_hardware_work.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

					    <!-- bon de livraison des équipements   -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Avez-vous reçu un bon de livraison des équipements?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_delivery_equipment" value="true" ng-model="report_content.hardware.is_delivery_equipment.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_delivery_equipment" value="false" ng-model="report_content.hardware.is_delivery_equipment.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_delivery_equipment_details" ng-model="report_content.hardware.is_delivery_equipment.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_delivery_equipment_obs" ng-minlength="10" ng-model="report_content.hardware.is_delivery_equipment.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

					    <!-- Le système d’exploitation est-il authentique ? -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
										Le système d’exploitation est-il authentique ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_os_authentic" value="true" ng-model="report_content.hardware.is_os_authentic.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_os_authentic" value="false" ng-model="report_content.hardware.is_os_authentic.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_os_authentic_details" ng-model="report_content.hardware.is_os_authentic.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_os_authentic_obs" ng-minlength="10" ng-model="report_content.hardware.is_os_authentic.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

					    <!-- La suite office est-elle authentique ? -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
										La suite office est-elle authentique ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_office_suite_authentic" value="true" ng-model="report_content.hardware.is_office_suite_authentic.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_office_suite_authentic" value="false" ng-model="report_content.hardware.is_office_suite_authentic.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_office_suite_details" ng-model="report_content.hardware.is_office_suite_authentic.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_office_suite_authentic_obs" ng-minlength="10" ng-model="report_content.hardware.is_office_suite_authentic.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Existe –il un antivirus ? -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
										Existe –il un antivirus ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_antivirus_exist" value="true" ng-model="report_content.hardware.is_antivirus_exist.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_antivirus_exist" value="false" ng-model="report_content.hardware.is_antivirus_exist.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_antivirus_exist_details" ng-model="report_content.hardware.is_antivirus_exist.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_antivirus_exist_obs" ng-minlength="10" ng-model="report_content.hardware.is_antivirus_exist.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- L’antivirus est-il authentique ? -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
										L’antivirus est-il authentique ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_antivirus_authentic" value="true" ng-model="report_content.hardware.is_antivirus_authentic.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_antivirus_authentic" value="false" ng-model="report_content.hardware.is_antivirus_authentic.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_antivirus_authentic_details" ng-model="report_content.hardware.is_antivirus_authentic.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_antivirus_authentic_obs" ng-minlength="10" ng-model="report_content.hardware.is_antivirus_authentic.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Le matériel existant est-il conforme au bon de livraison. ? Vérification à faire -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Le matériel existant est-il conforme au bon de livraison. ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_hardware_shippment_genuine" value="true" ng-model="report_content.hardware.is_hardware_shippment_genuine.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_hardware_shippment_genuine" value="false" ng-model="report_content.hardware.is_hardware_shippment_genuine.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_hardware_shippment_genuine_details" ng-model="report_content.hardware.is_hardware_shippment_genuine.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_hardware_shippment_genuine_obs" ng-minlength="10" ng-model="report_content.hardware.is_hardware_shippment_genuine.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Existe-t-il une maintenance du matériel ? Qui s’en occupe ? -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Existe-t-il une maintenance du matériel ? Qui s’en occupe ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_hardware_maintenance_exist" value="true" ng-model="report_content.hardware.is_hardware_maintenance_exist.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_hardware_maintenance_exist" value="false" ng-model="report_content.hardware.is_hardware_maintenance_exist.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_hardware_maintenance_exist_details" ng-model="report_content.hardware.is_hardware_maintenance_exist.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_hardware_maintenance_exist_obs" ng-minlength="10" ng-model="report_content.hardware.is_hardware_maintenance_exist.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
		
						<!-- Existe-t-il des supports de sauvegarde ? (type et capacité) -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Existe-t-il des supports de sauvegarde ? (type et capacité)
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_backup_media_exist" value="true" ng-model="report_content.hardware.is_backup_media_exist.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_backup_media_exist" value="false" ng-model="report_content.hardware.is_backup_media_exist.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_backup_media_exist_details" ng-model="report_content.hardware.is_backup_media_exist.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_backup_media_exist_obs" ng-minlength="10" ng-model="report_content.hardware.is_backup_media_exist.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>			

						<!-- L’ordinateur est-il utilisé pour des travaux personnels ? -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									L’ordinateur est-il utilisé pour des travaux personnels ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_computer_personal_used" value="true" ng-model="report_content.hardware.is_computer_personal_used.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_computer_personal_used" value="false" ng-model="report_content.hardware.is_computer_personal_used.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_computer_personal_used_details" ng-model="report_content.hardware.is_computer_personal_used.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_computer_personal_used_obs" ng-minlength="10" ng-model="report_content.hardware.is_computer_personal_used.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- L’ordinateur est-il utilisé par des personnes autres que l’opérateur pour les travaux de la coopérative ? ? -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									L’ordinateur est-il utilisé par des personnes autres que l’opérateur pour les travaux de la coopérative ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_computer_personal_used_others" value="true" ng-model="report_content.hardware.is_computer_personal_used_others.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_computer_personal_used_others" value="false" ng-model="report_content.hardware.is_computer_personal_used_others.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_computer_personal_used_others_details" ng-model="report_content.hardware.is_computer_personal_used_others.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_computer_personal_used_others_obs" ng-minlength="10" ng-model="report_content.hardware.is_computer_personal_used_others.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Existe t-il une authentification pour l’accès à la l’ordinateur ?-->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Existe t-il une authentification pour l’accès à la l’ordinateur ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_computer_auth_exist" value="true" ng-model="report_content.hardware.is_computer_auth_exist.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_computer_auth_exist" value="false" ng-model="report_content.hardware.is_computer_auth_exist.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_computer_auth_exist_details" ng-model="report_content.hardware.is_computer_auth_exist.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_computer_auth_exist_obs" ng-minlength="10" ng-model="report_content.hardware.is_computer_auth_exist.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- L’ordinateur est-il performant ? Donnez la valeur de l’indice -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									L’ordinateur est-il performant ? Donnez la valeur de l’indice
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="is_computer_performing" value="true" ng-model="report_content.hardware.is_computer_performing.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="is_computer_performing" value="false" ng-model="report_content.hardware.is_computer_performing.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="is_computer_performing_details" ng-model="report_content.hardware.is_computer_performing.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="is_computer_performing_obs" ng-minlength="10" ng-model="report_content.hardware.is_computer_performing.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

				</ng-form>	
	   	   </div>
	   	   <div ng-switch-when="fourth">
	   	   	<ng-form name="applications">
	   	   		<!-- GESCOOP -->
	   	   		  <h1 class="subtitle">GESCOOP</h1>
					    <!-- Existe-il un cahier de charges ? A vérifier  -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Existe-il un cahier de charges ? A vérifier
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_specifications" value="true" ng-model="report_content.applications.gescoop.specifications.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_specifications" value="false" ng-model="report_content.applications.gescoop.specifications.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="gescoop_specifications_details" ng-model="report_content.applications.gescoop.specifications.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="gescoop_specifications_obs" ng-minlength="10" ng-model="report_content.applications.gescoop.specifications.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Existe-t-il des supports numériques et  physiques ? A vérifier -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Existe-t-il des supports numériques et physiques ? A vérifier
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_specifications_assets" value="true" ng-model="report_content.applications.gescoop.media_assets.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_specifications_assets" value="false" ng-model="report_content.applications.gescoop.media_assets.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="gescoop_specifications_assets_details" ng-model="report_content.applications.gescoop.media_assets.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="gescoop_specifications_assets_obs" ng-minlength="10" ng-model="report_content.applications.gescoop.media_assets.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Existe-t-il des supports logiciels ? A vérifier -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Existe-t-il des supports logiciels ? A vérifier
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_specifications_applications" value="true" ng-model="report_content.applications.gescoop.media_applications.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_specifications_applications" value="false" ng-model="report_content.applications.gescoop.media_applications.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="gescoop_specifications_applications_details" ng-model="report_content.applications.gescoop.media_applications.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="gescoop_specifications_applications_obs" ng-minlength="10" ng-model="report_content.applications.gescoop.media_applications.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Le cahier de charges est-il conforme au logiciel conçu ? -->
				        <div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 Le cahier de charges est-il conforme au logiciel conçu?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_conformity" value="true" ng-model="report_content.applications.gescoop.conformity.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_conformity" value="false" ng-model="report_content.applications.gescoop.conformity.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="gescoop_conformity_details" ng-model="report_content.applications.gescoop.conformity.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="gescoop_conformity_obs" ng-minlength="10" ng-model="report_content.applications.gescoop.conformity.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- La Base de Données est-elle (facilement) accessible ? -->
				        <div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 La Base de Données est-elle (facilement) accessible ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_bd_accessibility" value="true" ng-model="report_content.applications.gescoop.bd_accessibility.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_bd_accessibility" value="false" ng-model="report_content.applications.gescoop.bd_accessibility.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="gescoop_bd_accessibility_details" ng-model="report_content.applications.gescoop.bd_accessibility.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="gescoop_bd_accessibility_obs" ng-minlength="10" ng-model="report_content.applications.gescoop.bd_accessibility.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- L’application est-elle facilement exécutable ? (lourde, légère)-->
  						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 L’application est-elle facilement exécutable ?			
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_app_easy_executable" value="true" ng-model="report_content.applications.gescoop.app_easy_executable.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_app_easy_executable" value="false" ng-model="report_content.applications.gescoop.app_easy_executable.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="gescoop_app_easy_executable_details" ng-model="report_content.applications.gescoop.app_easy_executable.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="gescoop_app_easy_executable_obs" ng-minlength="10" ng-model="report_content.applications.gescoop.app_easy_executable.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--  Existe-t-il une authentification d’accès au logiciel ? -->
  						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 Existe-t-il une authentification d’accès au logiciel ?		
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_auth_exist" value="true" ng-model="report_content.applications.gescoop.auth_exist.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_auth_exist" value="false" ng-model="report_content.applications.gescoop.auth_exist.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="gescoop_auth_exist_details" ng-model="report_content.applications.gescoop.auth_exist.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="gescoop_auth_exist_obs" ng-minlength="10" ng-model="report_content.applications.gescoop.auth_exist.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>		

						<!-- La modification des données est-elle possible ?-->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 La modification des données est-elle possible?	
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_bd_is_alterable" value="true" ng-model="report_content.applications.gescoop.bd_is_alterable.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_bd_is_alterable" value="false" ng-model="report_content.applications.gescoop.bd_is_alterable.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="gescoop_bd_is_alterable_details" ng-model="report_content.applications.gescoop.bd_is_alterable.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="gescoop_bd_is_alterable_obs" ng-minlength="10" ng-model="report_content.applications.gescoop.bd_is_alterable.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Existe t-il une sauvegarde des données ? -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 La modification des données est-elle possible?	
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_bd_is_saved" value="true" ng-model="report_content.applications.gescoop.bd_is_saved.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="gescoop_bd_is_saved" value="false" ng-model="report_content.applications.gescoop.bd_is_saved.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="gescoop_bd_is_saved_details" ng-model="report_content.applications.gescoop.bd_is_saved.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="gescoop_bd_is_saved_obs" ng-minlength="10" ng-model="report_content.applications.gescoop.bd_is_saved.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
	   	   		  <!-- easycompta -->
	   	   		  <h1 class="subtitle">EasyCompta</h1>
					    <!-- Existe-il un cahier de charges ? A vérifier  -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Existe-il un cahier de charges ? A vérifier
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_specifications" value="true" ng-model="report_content.applications.easycompta.specifications.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_specifications" value="false" ng-model="report_content.applications.easycompta.specifications.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="easycompta_specifications_details" ng-model="report_content.applications.easycompta.specifications.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="easycompta_specifications_obs" ng-minlength="10" ng-model="report_content.applications.easycompta.specifications.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Existe-t-il des supports numériques et  physiques ? A vérifier -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Existe-t-il des supports numériques et physiques ? A vérifier
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_specifications_assets" value="true" ng-model="report_content.applications.easycompta.media_assets.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_specifications_assets" value="false" ng-model="report_content.applications.easycompta.media_assets.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="easycompta_specifications_assets_details" ng-model="report_content.applications.easycompta.media_assets.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="easycompta_specifications_assets_obs" ng-minlength="10" ng-model="report_content.applications.easycompta.media_assets.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Existe-t-il des supports logiciels ? A vérifier -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Existe-t-il des supports numériques et physiques ? A vérifier
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_specifications_applications" value="true" ng-model="report_content.applications.easycompta.media_applications.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_specifications_applications" value="false" ng-model="report_content.applications.easycompta.media_applications.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="easycompta_specifications_applications_details" ng-model="report_content.applications.easycompta.media_applications.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="easycompta_specifications_applications_obs" ng-minlength="10" ng-model="report_content.applications.easycompta.media_applications.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Le cahier de charges est-il conforme au logiciel conçu ? -->
				        <div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 Le cahier de charges est-il conforme au logiciel conçu?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_conformity" value="true" ng-model="report_content.applications.easycompta.conformity.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_specifications_applications" value="false" ng-model="report_content.applications.easycompta.conformity.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="easycompta_conformity_details" ng-model="report_content.applications.easycompta.conformity.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name=easycompta_conformity_obs" ng-minlength="10" ng-model="report_content.applications.easycompta.conformity.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- La Base de Données est-elle (facilement) accessible ? -->
				        <div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 La Base de Données est-elle (facilement) accessible ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_bd_accessibility" value="true" ng-model="report_content.applications.easycompta.bd_accessibility.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_bd_accessibility" value="false" ng-model="report_content.applications.easycompta.bd_accessibility.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="easycompta_bd_accessibility_details" ng-model="report_content.applications.easycompta.bd_accessibility.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name=easycompta_bd_accessibility_obs" ng-minlength="10" ng-model="report_content.applications.easycompta.bd_accessibility.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- L’application est-elle facilement exécutable ? (lourde, légère)-->
  						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 L’application est-elle facilement exécutable ?			
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_app_easy_executable" value="true" ng-model="report_content.applications.easycompta.app_easy_executable.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_app_easy_executable" value="false" ng-model="report_content.applications.easycompta.app_easy_executable.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="easycompta_app_easy_executable_details" ng-model="report_content.applications.easycompta.app_easy_executable.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="easycompta_app_easy_executable_obs" ng-minlength="10" ng-model="report_content.applications.easycompta.app_easy_executable.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--  Existe-t-il une authentification d’accès au logiciel ? -->
  						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 Existe-t-il une authentification d’accès au logiciel ?		
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_auth_exist" value="true" ng-model="report_content.applications.easycompta.auth_exist.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_auth_exist" value="false" ng-model="report_content.applications.easycompta.auth_exist.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="easycompta_auth_exist_details" ng-model="report_content.applications.easycompta.auth_exist.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="easycompta_auth_exist_obs" ng-minlength="10" ng-model="report_content.applications.easycompta.auth_exist.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>		

						<!-- La modification des données est-elle possible ?-->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 La modification des données est-elle possible?	
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_bd_is_alterable" value="true" ng-model="report_content.applications.easycompta.bd_is_alterable.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_bd_is_alterable" value="false" ng-model="report_content.applications.easycompta.bd_is_alterable.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="easycompta_bd_is_alterable_details" ng-model="report_content.applications.easycompta.bd_is_alterable.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="easycompta_bd_is_alterable_obs" ng-minlength="10" ng-model="report_content.applications.easycompta.bd_is_alterable.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Existe t-il une sauvegarde des données ? -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									 La modification des données est-elle possible?	
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_bd_is_saved" value="true" ng-model="report_content.applications.easycompta.bd_is_saved.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_bd_is_saved" value="false" ng-model="report_content.applications.easycompta.bd_is_saved.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="easycompta_bd_is_saved_details" ng-model="report_content.applications.easycompta.bd_is_saved.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="easycompta_bd_is_saved_obs" ng-minlength="10" ng-model="report_content.applications.easycompta.bd_is_saved.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
	   	   	</ng-form>
	   	   </div>
	        <div ng-switch-when="fifth">
	        	<ng-form name="formations">
			          <!-- GESCOOP -->
			          <h1 class="subtitle">GESCOOP</h1>
						<!-- Avez-vous été formé ?  -->
								<div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Avez-vous été formé ?
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached" value="true" ng-model="report_content.formations.gescoop.teached.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached" value="false" ng-model="report_content.formations.gescoop.teached.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="gescoop_teached_details" ng-model="report_content.formations.gescoop.teached.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="gescoop_teached_obs" ng-minlength="10" ng-model="report_content.formations.gescoop.teached.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

						<!-- Etait-ce suffisant ? Durée de la formation-->
						<div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Etait-ce suffisant ? Durée de la formation à préciser
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached_time" value="true" ng-model="report_content.formations.gescoop.teached_time.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached_time" value="false" ng-model="report_content.formations.gescoop.teached_time.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="gescoop_teached_time_details" ng-model="report_content.formations.gescoop.teached_time.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="gescoop_teached_time_obs" ng-minlength="10" ng-model="report_content.formations.gescoop.teached_time.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
						<!-- Vous rappelez vous du nom de votre formateur ? Donnez-->
						<div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Vous rappelez vous du nom de votre formateur ? Donnez
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached_man" value="true" ng-model="report_content.formations.gescoop.teached_man.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached_man" value="false" ng-model="report_content.formations.gescoop.teached_man.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="gescoop_teached_man_details" ng-model="report_content.formations.gescoop.teached_man.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="gescoop_teached_man_obs" ng-minlength="10" ng-model="report_content.formations.gescoop.teached_man.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

						<!-- Avez-vous le sentiment d’avoir été bien formé ? -->
						<div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Avez-vous le sentiment d’avoir été bien formé ?
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached_is_good" value="true" ng-model="report_content.formations.gescoop.teached_is_good.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached_is_good" value="false" ng-model="report_content.formations.gescoop.teached_is_good.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="gescoop_teached_is_good_details" ng-model="report_content.formations.gescoop.teached_is_good.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="gescoop_tteached_is_good_obs" ng-minlength="10" ng-model="report_content.formations.gescoop.teached_is_good.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

						<!-- La formation vous a-t-elle aidé à (bien) faire votre travail ?	-->
						<div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											La formation vous a-t-elle aidé à (bien) faire votre travail ?
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached_is_useful" value="true" ng-model="report_content.formations.gescoop.teached_is_useful.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached_is_useful" value="false" ng-model="report_content.formations.gescoop.teached_is_useful.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="gescoop_teached_is_useful_details" ng-model="report_content.formations.gescoop.teached_is_useful.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="gescoop_tteached_is_useful_obs" ng-minlength="10" ng-model="report_content.formations.gescoop.teached_is_useful.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
						<!-- Avez-vous rencontré des difficultés au cours de la formation ?-->
					   <div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Avez-vous rencontré des difficultés au cours de la formation ?
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached_facing_difficulties" value="true" ng-model="report_content.formations.gescoop.teached_facing_difficulties.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teached_facing_difficulties" value="false" ng-model="report_content.formations.gescoop.teached_facing_difficulties.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="gescoop_teached_facing_difficulties_details" ng-model="report_content.formations.gescoop.teached_facing_difficulties.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="gescoop_teached_facing_difficulties_obs" ng-minlength="10" ng-model="report_content.formations.gescoop.teached_facing_difficulties.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

						<!-- Le formateur maitrisait-il son sujet ?	 -->
				       <div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Le formateur maitrisait-il son sujet ?
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teacher_knew_subject" value="true" ng-model="report_content.formations.gescoop.teacher_knew_subject.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="gescoop_teacher_knew_subject" value="false" ng-model="report_content.formations.gescoop.teacher_knew_subject.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="gescoop_teacher_knew_subject_details" ng-model="report_content.formations.gescoop.teacher_knew_subject.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="gescoop_teacher_knew_subject_obs" ng-minlength="10" ng-model="report_content.formations.gescoop.teacher_knew_subject.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>	

			           <!-- Le formateur utilisait t-il un langage accessible à tous ?	 -->
					   <div class="field is-horizontal">
										<div class="field-label">
											<label for="" class="label">
												 Le formateur utilisait t-il un langage accessible à tous ?
											</label>
										</div>
										<div class="field-body">
											<div class="field">
												<div class="control">
													<label class="radio">
													   <input required type="radio" disabled name="gescoop_teacher_used_easy_language" value="true" ng-model="report_content.formations.gescoop.teacher_used_easy_language.answer">
													   Oui
													</label>
													<label class="radio">
													   <input required type="radio" disabled name="gescoop_teacher_used_easy_language" value="false" ng-model="report_content.formations.gescoop.teacher_used_easy_language.answer">
													   Non
													</label>
												</div>
											</div>
											<div class="field">
												<div class="control">
													<div class="control">
														<textarea readonly ng-minlength="10" name="gescoop_teacher_used_easy_language" ng-model="report_content.formations.gescoop.teacher_used_easy_language.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
													</div>
												</div>
											</div>
											<div class="field">
												<div class="control">
													<div class="control">
														<textarea readonly name="gescoop_teacher_used_easy_language" ng-minlength="10" ng-model="report_content.formations.gescoop.teacher_used_easy_language.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>	


				       <!-- Le formateur était-il ouvert et disponible à répondre à vos sollicitations ? -->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													 Le formateur était-il ouvert et disponible à répondre à vos sollicitations ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="gescoop_teacher_was_opened" value="true" ng-model="report_content.formations.gescoop.teacher_was_opened.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="gescoop_teacher_was_opened" value="false" ng-model="report_content.formations.gescoop.teacher_was_opened.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="gescoop_teacher_was_opened" ng-model="report_content.formations.gescoop.teacher_was_opened.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="gescoop_teacher_was_opened" ng-minlength="10" ng-model="report_content.formations.gescoop.teacher_was_opened.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>	

				        <!-- Dites-nous en quelques mots ce que vous avez appris -->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													  Dites-nous en quelques mots ce que vous avez appris
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="gescoop_what_you_learned" ng-model="report_content.formations.gescoop.what_you_learned.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="gescoop_what_you_learned" ng-minlength="10" ng-model="report_content.formations.gescoop.what_you_learned.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>

				        <!-- Est-ce que vous savez le faire -->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													 Est-ce que vous savez le faire ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="gescoop_you_know_how" value="true" ng-model="report_content.formations.gescoop.you_know_how.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="gescoop_you_know_how" value="false" ng-model="report_content.formations.gescoop.you_know_how.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="gescoop_you_know_how" ng-model="report_content.formations.gescoop.you_know_how.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="gescoop_you_know_how" ng-minlength="10" ng-model="report_content.formations.gescoop.you_know_how.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>


				        <!-- Le logiciel répond t-il à vos besoins ?-->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													 Le logiciel répond t-il à vos besoins ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="gescoop_software_is_useful" value="true" ng-model="report_content.formations.gescoop.software_is_useful.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="gescoop_software_is_useful" value="false" ng-model="report_content.formations.gescoop.software_is_useful.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="gescoop_software_is_useful" ng-model="report_content.formations.gescoop.software_is_useful.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="gescoop_software_is_useful" ng-minlength="10" ng-model="report_content.formations.gescoop.software_is_useful.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
	   	   	          <!-- easycompta -->
	   	   	           <h1 class="subtitle">easycompta</h1>
				       <!-- Avez-vous été formé ?  -->
						<div class="field is-horizontal">
							<div class="field-label">
								<label for="" class="label">
									Avez-vous été formé ?
								</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_teached" value="true" ng-model="report_content.formations.easycompta.teached.answer">
										   Oui
										</label>
										<label class="radio">
										   <input required type="radio" disabled name="easycompta_teached" value="false" ng-model="report_content.formations.easycompta.teached.answer">
										   Non
										</label>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly ng-minlength="10" name="easycompta_teached_details" ng-model="report_content.formations.easycompta.teached.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="control">
											<textarea readonly name="easycompta_teached_obs" ng-minlength="10" ng-model="report_content.formations.easycompta.teached.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Etait-ce suffisant ? Durée de la formation-->
						<div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Etait-ce suffisant ? Durée de la formation à préciser
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teached_time" value="true" ng-model="report_content.formations.easycompta.teached_time.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teached_time" value="false" ng-model="report_content.formations.easycompta.teached_time.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="easycompta_teached_time_details" ng-model="report_content.formations.easycompta.teached_time.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="easycompta_teached_time_obs" ng-minlength="10" ng-model="report_content.formations.easycompta.teached_time.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
						<!-- Vous rappelez vous du nom de votre formateur ? Donnez-->
						<div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Vous rappelez vous du nom de votre formateur ? Donnez
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teached_man" value="true" ng-model="report_content.formations.easycompta.teached_man.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teached_man" value="false" ng-model="report_content.formations.easycompta.teached_man.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="easycompta_teached_man_details" ng-model="report_content.formations.easycompta.teached_man.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="easycompta_teached_man_obs" ng-minlength="10" ng-model="report_content.formations.easycompta.teached_man.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

						<!-- Avez-vous le sentiment d’avoir été bien formé ? -->
						<div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Avez-vous le sentiment d’avoir été bien formé ?
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teached_is_good" value="true" ng-model="report_content.formations.easycompta.teached_is_good.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teached_is_good" value="false" ng-model="report_content.formations.easycompta.teached_is_good.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="easycompta_teached_is_good_details" ng-model="report_content.formations.easycompta.teached_is_good.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="easycompta_tteached_is_good_obs" ng-minlength="10" ng-model="report_content.formations.easycompta.teached_is_good.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

						<!-- La formation vous a-t-elle aidé à (bien) faire votre travail ?	-->
						<div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											La formation vous a-t-elle aidé à (bien) faire votre travail ?
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teached_is_useful" value="true" ng-model="report_content.formations.easycompta.teached_is_useful.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teached_is_useful" value="false" ng-model="report_content.formations.easycompta.teached_is_useful.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="easycompta_teached_is_useful_details" ng-model="report_content.formations.easycompta.teached_is_useful.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="easycompta_tteached_is_useful_obs" ng-minlength="10" ng-model="report_content.formations.easycompta.teached_is_useful.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
						<!-- Avez-vous rencontré des difficultés au cours de la formation ?-->
					   <div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Avez-vous rencontré des difficultés au cours de la formation ?
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teached_facing_difficulties" value="true" ng-model="report_content.formations.easycompta.teached_facing_difficulties.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teached_facing_difficulties" value="false" ng-model="report_content.formations.easycompta.teached_facing_difficulties.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="easycompta_teached_facing_difficulties_details" ng-model="report_content.formations.easycompta.teached_facing_difficulties.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="easycompta_teached_facing_difficulties_obs" ng-minlength="10" ng-model="report_content.formations.easycompta.teached_facing_difficulties.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

						<!-- Le formateur maitrisait-il son sujet ?	 -->
				       <div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Le formateur maitrisait-il son sujet ?
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teacher_knew_subject" value="true" ng-model="report_content.formations.easycompta.teacher_knew_subject.answer">
												   Oui
												</label>
												<label class="radio">
												   <input required type="radio" disabled name="easycompta_teacher_knew_subject" value="false" ng-model="report_content.formations.easycompta.teacher_knew_subject.answer">
												   Non
												</label>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" name="easycompta_teacher_knew_subject_details" ng-model="report_content.formations.easycompta.teacher_knew_subject.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly name="easycompta_teacher_knew_subject_obs" ng-minlength="10" ng-model="report_content.formations.easycompta.teacher_knew_subject.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>	

			           <!-- Le formateur utilisait t-il un langage accessible à tous ?	 -->
					   <div class="field is-horizontal">
										<div class="field-label">
											<label for="" class="label">
												 Le formateur utilisait t-il un langage accessible à tous ?
											</label>
										</div>
										<div class="field-body">
											<div class="field">
												<div class="control">
													<label class="radio">
													   <input required type="radio" disabled name="easycompta_teacher_used_easy_language" value="true" ng-model="report_content.formations.easycompta.teacher_used_easy_language.answer">
													   Oui
													</label>
													<label class="radio">
													   <input required type="radio" disabled name="easycompta_teacher_used_easy_language" value="false" ng-model="report_content.formations.easycompta.teacher_used_easy_language.answer">
													   Non
													</label>
												</div>
											</div>
											<div class="field">
												<div class="control">
													<div class="control">
														<textarea readonly ng-minlength="10" name="easycompta_teacher_used_easy_language" ng-model="report_content.formations.easycompta.teacher_used_easy_language.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
													</div>
												</div>
											</div>
											<div class="field">
												<div class="control">
													<div class="control">
														<textarea readonly name="easycompta_teacher_used_easy_language" ng-minlength="10" ng-model="report_content.formations.easycompta.teacher_used_easy_language.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>	


				       <!-- Le formateur était-il ouvert et disponible à répondre à vos sollicitations ? -->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													 Le formateur était-il ouvert et disponible à répondre à vos sollicitations ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="easycompta_teacher_was_opened" value="true" ng-model="report_content.formations.easycompta.teacher_was_opened.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="easycompta_teacher_was_opened" value="false" ng-model="report_content.formations.easycompta.teacher_was_opened.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="easycompta_teacher_was_opened" ng-model="report_content.formations.easycompta.teacher_was_opened.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="easycompta_teacher_was_opened" ng-minlength="10" ng-model="report_content.formations.easycompta.teacher_was_opened.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>	

				        <!-- Dites-nous en quelques mots ce que vous avez appris -->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													  Dites-nous en quelques mots ce que vous avez appris
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="easycompta_what_you_learned" ng-model="report_content.formations.easycompta.what_you_learned.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="easycompta_what_you_learned" ng-minlength="10" ng-model="report_content.formations.easycompta.what_you_learned.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>

				        <!-- Est-ce que vous savez le faire -->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													 Est-ce que vous savez le faire ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="easycompta_you_know_how" value="true" ng-model="report_content.formations.easycompta.you_know_how.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="easycompta_you_know_how" value="false" ng-model="report_content.formations.easycompta.you_know_how.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="easycompta_you_know_how" ng-model="report_content.formations.easycompta.you_know_how.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="easycompta_you_know_how" ng-minlength="10" ng-model="report_content.formations.easycompta.you_know_how.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>


				        <!-- Le logiciel répond t-il à vos besoins ?-->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													 Le logiciel répond t-il à vos besoins ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="easycompta_software_is_useful" value="true" ng-model="report_content.formations.easycompta.software_is_useful.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="easycompta_software_is_useful" value="false" ng-model="report_content.formations.easycompta.software_is_useful.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="easycompta_software_is_useful" ng-model="report_content.formations.easycompta.software_is_useful.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="easycompta_software_is_useful" ng-minlength="10" ng-model="report_content.formations.easycompta.software_is_useful.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>



	        	</ng-form>	



						

	   	   </div>
	   	   <div ng-switch-when="sixth">
	   	   	<ng-form name="level_operator">
	   	   		<!-- Votre formation académique /Niveau d’étude		 -->
	   	   				   <div class="field is-horizontal">
									<div class="field-label">
										<label for="" class="label">
											Votre formation académique/Niveau d’étude
										</label>
									</div>
									<div class="field-body">
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" required name="level_academic_details" ng-model="report_content.level_operator.level_academic.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
												</div>
											</div>
										</div>
										<div class="field">
											<div class="control">
												<div class="control">
													<textarea readonly ng-minlength="10" ng-model="report_content.level_operator.level_academic.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

						<!-- Avez –vous une formation informatique : Word, Excel ou autres. Préciser-->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													Avez –vous une formation informatique : Word, Excel ou autres ? Préciser
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="is_computed_trained" value="true" ng-model="report_content.level_operator.is_computed_trained.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="is_computed_trained" value="false" ng-model="report_content.level_operator.is_computed_trained.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="is_computed_trained_details" ng-model="report_content.level_operator.is_computed_trained.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="is_computed_trained_obs" ng-minlength="10" ng-model="report_content.level_operator.is_computed_trained.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>

						<!-- Avez-vous eu des problèmes techniques liés à l’utilisation de l’ordinateur ? -->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													Avez-vous eu des problèmes techniques liés à l’utilisation de l’ordinateur ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="is_computed_used_problems" value="true" ng-model="report_content.level_operator.is_computed_used_problems.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="is_computed_used_problems" value="false" ng-model="report_content.level_operator.is_computed_used_problems.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="is_computed_used_problems_details" ng-model="report_content.level_operator.is_computed_used_problems.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="is_computed_used_problems_obs" ng-minlength="10" ng-model="report_content.level_operator.is_computed_used_problems.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>

						<!-- Avez –vous pu les résoudre par vous-même ? comment ? -->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													Avez-vous eu des problèmes techniques liés à l’utilisation de l’ordinateur ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="is_computed_used_problems_selfsolved" value="true" ng-model="report_content.level_operator.is_computed_used_problems_selfsolved.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="is_computed_used_problems_selfsolved" value="false" ng-model="report_content.level_operator.is_computed_used_problems_selfsolved.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="is_computed_used_problems_selfsolved_details" ng-model="report_content.level_operator.is_computed_used_problems_selfsolved.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="is_computed_used_problems_selfsolved_obs" ng-minlength="10" ng-model="report_content.level_operator.is_computed_used_problems_selfsolved.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>

						<!-- Avez-vous eu des problèmes techniques liés à l’utilisation des logiciels  GESSCOOP ET EASYCOMMPTA?-->
		   				<div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													Avez-vous eu des problèmes techniques liés à l’utilisation des logiciels  GESSCOOP ET EASYCOMMPTA ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="is_problem_applications_encountered" value="true" ng-model="report_content.level_operator.is_problem_applications_encountered.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="is_problem_applications_encountered" value="false" ng-model="report_content.level_operator.is_problem_applications_encountered.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="is_problem_applications_encountered_details" ng-model="report_content.level_operator.is_problem_applications_encountered.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="is_problem_applications_encountered_obs" ng-minlength="10" ng-model="report_content.level_operator.is_problem_applications_encountered.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>

						<!-- Avez –vous pu les résoudre par vous-même ? comment ? -->
						<div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													Avez –vous pu les résoudre par vous-même ? comment ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="is_problem_applications_encountered_selfsolved" value="true" ng-model="report_content.level_operator.is_problem_applications_encountered_selfsolved.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="is_problem_applications_encountered_selfsolved" value="false" ng-model="report_content.level_operator.is_problem_applications_encountered_selfsolved.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="is_problem_applications_encountered_selfsolved_details" ng-model="report_content.level_operator.is_problem_applications_encountered_selfsolved.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="is_problem_applications_encountered_selfsolved_obs" ng-minlength="10" ng-model="report_content.level_operator.is_problem_applications_encountered_selfsolved.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>

						<!-- Existe-t-il encore des problèmes techniques liés à l’utilisation de l’ordinateur ? Lesquels -->
						<div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													Avez –vous pu les résoudre par vous-même ? comment ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="is_still_computer_used_problems" value="true" ng-model="report_content.level_operator.is_still_computer_used_problems.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="is_still_computer_used_problems" value="false" ng-model="report_content.level_operator.is_still_computer_used_problems.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="is_still_computer_used_problems_details" ng-model="report_content.level_operator.is_still_computer_used_problems.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="is_still_computer_used_problems_obs" ng-minlength="10" ng-model="report_content.level_operator.is_still_computer_used_problems.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
						<!-- Existe-t-il encore des problèmes techniques liés à l’utilisation de des logiciels GESCOOP et EASYCOMPTA? Lesquels -->
							<div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													Avez-vous eu des problèmes techniques liés à l’utilisation des logiciels  GESSCOOP ET EASYCOMMPTA ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="is_still_problem_applications_encountered" value="true" ng-model="report_content.level_operator.is_still_problem_applications_encountered.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="is_still_problem_applications_encountered" value="false" ng-model="report_content.level_operator.is_still_problem_applications_encountered.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="is_still_problem_applications_encountered_details" ng-model="report_content.level_operator.is_still_problem_applications_encountered.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="is_still_problem_applications_encountered_obs" ng-minlength="10" ng-model="report_content.level_operator.is_still_problem_applications_encountered.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
	   	   	</ng-form>



	   	   </div>
	   	   <div ng-switch-when="seventh">
	   	   	  <ng-form name="rapportage">
	   	   	  	   <!-- Avez-vous été  assisté par l’entreprise CIGA ? -->
					   <div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													 Avez-vous été  assisté par l’entreprise CIGA ?
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="get_ciga_assisted" value="true" ng-model="report_content.rapportage.get_ciga_assisted.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="get_ciga_assisted" value="false" ng-model="report_content.rapportage.get_ciga_assisted.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="get_ciga_assisted_details" ng-model="report_content.rapportage.get_ciga_assisted.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="get_ciga_assisted_obs" ng-minlength="10" ng-model="report_content.rapportage.get_ciga_assisted.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>



							<!-- Combien de fois ?-->
  							<div class="field is-horizontal">
											<div class="field-label">
												<label for="" class="label">
													 Combien de fois ?	
												</label>
											</div>
											<div class="field-body">
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="get_ciga_assisted_times_details" ng-model="report_content.rapportage.get_ciga_assisted_times.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="get_ciga_assisted_times_obs" ng-minlength="10" ng-model="report_content.rapportage.get_ciga_assisted_times.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>

					        <!-- L’entreprise CIGA répond-t-elle promptement à vos sollicitions ?-->
  							<div class="field is-horizontal">
  											<div class="field-label">
												<label for="" class="label">
													 L’entreprise CIGA répond-t-elle promptement à vos sollicitions ?	
												</label>
											</div>


											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="is_ciga_answered_problems" value="true" ng-model="report_content.rapportage.is_ciga_answered_problems.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="is_ciga_answered_problems" value="false" ng-model="report_content.rapportage.is_ciga_answered_problems.answer">
														   Non
														</label>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="is_ciga_answered_problems_details" ng-model="report_content.rapportage.is_ciga_answered_problems.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="is_ciga_answered_problems_obs" ng-minlength="10" ng-model="report_content.rapportage.is_ciga_answered_problems.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
								
							<!-- L’assistance a-t-elle résolu le problème ?				 -->
  							<div class="field is-horizontal">

											<div class="field-label">
												<label for="" class="label">
													 L’assistance a-t-elle résolu le problème ?	
												</label>
											</div>

											<div class="field-body">
												<div class="field">
													<div class="control">
														<label class="radio">
														   <input required type="radio" disabled name="is_assistance_solved_problems" value="true" ng-model="report_content.rapportage.is_assistance_solved_problems.answer">
														   Oui
														</label>
														<label class="radio">
														   <input required type="radio" disabled name="is_assistance_solved_problems" value="false" ng-model="report_content.rapportage.is_assistance_solved_problems.answer">
														   Non
														</label>
													</div>
												 </div>

												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly ng-minlength="10" name="is_assistance_solved_problems_details" ng-model="report_content.rapportage.is_assistance_solved_problems.details" cols="30" rows="4" placeholder="Détails" class="textarea"></textarea>
														</div>
													</div>
												</div>
												<div class="field">
													<div class="control">
														<div class="control">
															<textarea readonly name="is_assistance_solved_problems_obs" ng-minlength="10" ng-model="report_content.rapportage.is_assistance_solved_problems.obs" cols="30" rows="4" placeholder="Observations" class="textarea"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
								
	   	   	  </ng-form>		
	   	   </div>

	   	   <div ng-switch-when="eight">
	   	   	    <ng-form name="evidence">
						<div class="field">
							<div class="control">
								<div class="level is-mobile">
										<div class="level-left">
											<div class="level-item" ng-repeat="(key,value) in evidences">
												<img ng-src="{{value}}" class="img-group-{{$parent.$index}} hover" alt="" colorboxable="{height:'75%', width:'75%', opacity:0.7, rel:'img-group-{{$parent.$index}}',slideshow:false, open:false}" width="180px">  
											</div>

										</div>
									</div>
								</div>

							</div>
	   	   	    </ng-form>	


	   	   </div>

	   </div>
		
	</form>
	</div>

<script>
		$(document).ready(function(){
		$('.item_bar_report').on('click', function(){
			$('.item_bar_report').removeClass('is-active');
			$(this).addClass('is-active');
		});
	});
</script>
</section>