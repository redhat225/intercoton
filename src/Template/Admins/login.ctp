<style>
	.loginForm input:focus{
        border-color: #C1872A;
        box-shadow: 0 0 0 0.125em rgba(193, 135, 42, 0.25);
	}
</style>

<div class="columns is-mar-bot-0" ng-controller="LoginController as logincontroller">
	<div class="column is-three-fifths is-hidden-mobile is-pad-bot-0" style="background:url('/img/assets/login/wallpaper2.jpg')">
		
	</div>
	<div class="column is-two-fifths is-pad-bot-100 is-pad-top-144" style="background:url('/img/assets/logo/back.png') #fbfffc no-repeat 50% 50%;">
		<div class="section is-medium is-pad-top-50">
                
               <div class="has-text-centered">
				<img src="/img/assets/logo/intercoton4.png" width="350px" alt="">
               	
               </div>
						<form ng-submit="logincontroller.login(logincontroller.credentials)" name="loginBlogForm">
							<!-- Identifiant -->
							<div class="field">
							  <label class="label">Identifiant</label>
							  <div class="loginForm control has-icons-right has-icons-left">
							    <input class="input" name='username' required ng-model="logincontroller.credentials.account_username" type="text" ng-minlength="6" ng-maxlength="20" placeholder="Identifiant">
								 	<span class="icon is-small is-left">
								 		<i class="fa fa-user-o" aria-hidden="true"></i>
								 	</span>
								    <span ng-if="loginBlogForm.username.$valid" class="icon is-small is-right">
								      <i class="fa fa-check has-text-success"></i>
								    </span>
							  </div>
							</div>
							<!-- Mot de passe -->
							<div class="field">
							  <label class="label">Mot de Passe</label>
							  <div class="loginForm control has-icons-left has-icons-right">
							    <input class="input" name="password" required ng-minlength="8" ng-maxlength="20" ng-model="logincontroller.credentials.account_password" type="password" placeholder="Mot de passe">
							    <span class="icon is-small is-left">
							    	<i class="fa fa-lock" aria-hidden="true"></i>
							    </span>
							    <span ng-if="loginBlogForm.password.$valid" class="icon is-small is-right">
								      <i class="fa fa-check has-text-success"></i>
								</span>
							  </div>
							</div>
							<!-- Connection button -->
		                    <div class="field">
		                      <div class="control">
		                          <button ng-disabled="loginBlogForm.$invalid || logincontroller.is_authenticating" class="button is-fullwidth is-vne-orange is-outlined {{logincontroller.isSubmitting}}" type="submit">
		                                <span>Connexion</span>
		                          </button>
		                      </div>
		                   </div>
		                   <!-- Forget Password button -->
		                   <div class="field">
		                   		<div class="control">
		                   			<button class="button is-intercoton-green is-fullwidth" ng-click="logincontroller.forgotpassword()"><span class="has-text-white">Mot de passe oublié</span></button>
		                   		</div>
		                   </div>
						</form>
		</div>

	</div>
</div>

