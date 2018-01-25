<section ui-view>
			<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li ui-sref="admins.sessions"><a >Sessions</a></li>
					    <li class="is-active"><a >Créer une session</a></li>
					  </ul>
					</nav>
				</div>
			</div>


	<h3 class="subtitle">Formulaire Création Session</h3>
	<form name="createSessionForm" ng-submit="create(session)">
		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">Dénomination</label>
			</div>
			<div class="field-body">
				<!-- Denomination -->
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" name="session_denomination" placeholder="Nom de la session" class="input is-uppercase" required ng-model="session.session_denomination" ng-maxlength="300">
						<span class="icon is-small is-right" ng-show="createSessionForm.session_denomination.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-bank"></i>
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">Date début-fin session</label>
			</div>
			<div class="field-body">
				<!-- Session begin date -->
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="date" name="session_begin_date" class="input is-uppercase" ng-model="session.session_begin_date" placeholder="Fin" required>
						<span class="icon is-small is-right" ng-show="createSessionForm.session_begin_date.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-clock-o"></i>
						</span>
					</div>
				</div>
				<!-- Session end date -->
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="date" name="session_end_date" class="input is-uppercase" ng-model="session.session_end_date" placeholder="Fin" required>
						<span class="icon is-small is-right" ng-show="createSessionForm.session_end_date.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
						<span class="icon is-small is-left">
							<i class="fa fa-clock"></i>
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="field is-horizontal">
			<div class="field-label">
				<label for="" class="label">
					&nbsp;
				</label>
			</div>
			<div class="field-body">
				<div class="field is-grouped">
					<div class="control">
						<button class="button is-intercoton-green has-text-weight-semibold" type="submit" ng-disabled="createSessionForm.$invalid || is_loading">Créer</button>
					</div>
					<div class="control">
						<button class="button is-warning has-text-weight-semibold" type="reset" ui-sref="admins.sessions">Annuler</button>
					</div>
				</div>
			</div>
		</div>

	</form>
</section>