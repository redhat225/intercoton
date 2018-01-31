<section ui-view>
	<div class="level">
		<div class="level-left">
			<div class="level-item">
				<nav class="breadcrumb" aria-label="breadcrumbs">
				  <ul>
				    <li><a href="#">Dashboard</a></li>
				    <li><a ui-sref="admins.sessions({page_id:1})">Sessions</a></li>
				    <li><a ng-click="go_to_reports()">Rapports</a></li>
				    <li class="is-active"><a href="#" aria-current="page">Edition Rapport</a></li>
				  </ul>
				</nav>
			</div>
		</div>
		<div class="level-right">
			<div class="level-item">
				<div class="notification is-intercoton-darkblue">
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
				  	 <span class="has-text-weight-semibold">{{report.auditor_account.auditor.auditor_fullname}}</span>
				  </p>
				  <p>
				  	 <span class="icon">
				  	 	<i class="fa fa-pencil is medium"></i>
				  	 </span>
				  	 <span class="has-text-weight-semibold">{{report.created | date:'dd/MM/yyyy HH:mm:ss'}}</span>
				  </p>
				  <p>
				  	 <span class="icon">
				  	 	<i class="fa fa-bank is medium"></i>
				  	 </span>
				  	 <span class="has-text-weight-semibold">{{report.cooperative.cooperative_denomination}}</span>
				  </p>

				</div>
			</div>
		</div>
	</div>

	<div class="level">
		<div class="level-left">
			
		</div>
		<div class="level-right">
			<div class="level-item">
				<button type="button" class="button is-intercoton-green" ng-click="addItemReport()">
					<span class="icon"><i class="fa fa-plus"></i></span>
					<span>Ajouter une section</span>
				</button>
			</div>
		</div>
	</div>

	<form novalidate ng-submit="update_report()" name="editReportForm">

		<!-- Modify title and cooperative-->
		<div class="main_information report">
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Titre du rapport</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input type="text" required class="input" ng-model="report.report_title" name="report_title">
							<span class="icon is-small is-right">
								<i class="fa fa-check has-intercoton-green"></i>
							</span>
							<span class="icon is-small is-left" ng-show="editReportForm.report_title.$valid">
								<i class="fa fa-sticky-note has-text-intercoton-green"></i>
							</span>	
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="main_information report is-pad-bot-20 is-pad-top-20">
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Coopérative associée</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<div class="select">
								<select ng-model="report.cooperative_id" name="cooperative_id" id="cooperative_id" ng-options="c.id as c.cooperative_denomination for c in cooperatives"></select>
							</div>
							<span class="icon is-small is-left">
								<i class="fa fa-bank has-text-intercoton-green"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	   <div class="report_item is-pad-bot-20" ng-repeat="item in report.report_content">
				<!-- Show images -->
				<h1 class="title has-text-weight-bold item_report is-4 is-pad-top-10" style="border-top:1px dotted green;">Section Raport</h1>
				<h3 class="subtitle has-text-weight-semibold">Prises de vue</h3>
				<div class="level">
					<div class="level-left">
						<div class="level-item hero" ng-repeat="(key,value) in item.evidences">
							<button class="delete delete-image-trigger" id="delete-image-trigger-{{key}}" ng-click="delete_image(key,value)" type="button"></button>
							<img ng-src="{{value}}" class="img-group-{{$parent.$index}} hover" alt="" colorboxable="{height:'75%', width:'75%', opacity:0.7, rel:'img-group-{{$parent.$index}}',slideshow:false, open:false}" width="180px">

						</div>
					</div>
				</div>
				<div ng-repeat='(key,value) in item.contents'>
							<h3 class="subtitle"></h3>
							<div class="field is-horizontal">
								<div class="field-label">
									<label for="" class="label" ng-bind="check_element(key)"></label>
								</div>

								<div class="field-body">
									<div class="field">
										<div class="control">
											<textarea ui-tinymce="tinymceOptions" required ng-model="item.contents[key]" class="textarea"></textarea>
										</div>
									</div>
								</div>
							</div>
			 	</div> 
	  </div>
	 

	  <div class="validate is-pad-top-50" id="validate_area">
	  	<div class="field is-horizontal">
	  		<div class="field-label">
	  			<label for="" class="label">&nbsp;</label>
	  		</div>
	  		<div class="field-body">
	  			<div class="field">
		  			<div class="control is-grouped">
		  				<button class="button is-warning has-text-weight-semibold" type="submit" ng-disabled="editReportForm.$invalid || is_loading">
		  					Modifier le rapport
		  				</button>
		  				<button class="button is-danger has-text-weight-semibold" type="reset" ng-click="go_to_reports()">
		  					Annuler la modification
		  				</button>
		  			</div>
	  			</div>
	  		</div>
	  	</div>
	  </div>
	</form>

</section>