<!-- Home interface -->
<nav class="navbar is-pad-top-5 is-pad-bot-5" style="border-bottom:2px solid #e5e5e5;">
	<div class="navbar-brand">
		<a ui-sref="admins.dashboard" class="navbar-item">
			<img src="/img/assets/logo/intercoton3.png" alt="Intercoton" width="280px" style="max-height: 100%;">
		</a>
		<a class="is-hidden-mobile navbar-item side-menu-trigger">
			<span class="icon">
				<i class="fas fa-bars has-text-intercoton-green fa-2x"></i>				
			</span>
		</a>
	    <button class="button navbar-burger">
	      <span></span>
	      <span></span>
	      <span></span>
	    </button>
	</div>
	<div class="navbar-menu">
		<div class="navbar-end">
			<a  class="navbar-item" href="/admins/logout" target="_self">
				<button class="button is-intercoton-green" ui-sref="admins.dashboard">
					<span class="icon">
						<i class="fab fa-dyalog"></i>
					</span>
					<span>
						Dashboard
					</span>
				</button>
			</a>	
			
			<a class="navbar-item" ui-sref="admins.sessions({page_id:1})">
				<span class="icon has-text-intercoton-green">
					<i class="fa fa-sticky-note" aria-hidden="true"></i>
					<b class="is-mar-lft-5">{{$root.brief_stats.reports_count}}</b>
				</span>
			</a>
			<?php if($role_denomination != "auditor"): ?>
					<a class="navbar-item" ui-sref="admins.cooperatives({page_id:1})">
						<span class="icon has-text-intercoton-green">
							<i class="fas fa-home" aria-hidden="true"></i>
							<b class="is-mar-lft-5">{{$root.brief_stats.cooperatives_count}}</b>
						</span>
					</a>
					<a class="navbar-item" ui-sref="admins.zones({page_id:1})">
						<span class="icon has-text-intercoton-green">
							<i class="fa fa-globe" aria-hidden="true"></i>
							<b class="is-mar-lft-5">{{$root.brief_stats.zones_count}}</b>
						</span>
					</a>
					<a class="navbar-item" ui-sref="admins.auditors({page_id:1})">
						<span class="icon has-text-intercoton-green">
							<i class="fa fa-users" aria-hidden="true"></i>
							<b class="is-mar-lft-5">{{$root.brief_stats.auditor_accounts_count}}</b>
						</span>
					</a>
		    <?php endif; ?>
			<div class="navbar-item has-dropdown is-hoverable" class="account-dropdown">
				<a class="navbar-link has-text-intercoton-green" >
					<span class="has-text-weight-semibold has-text-intercoton-green">{{$root.root_profile.account_username}}</span>
						<figure class="image is-32x32">
							  <img src="/img/assets/admins/avatar/{{$root.root_profile.account_avatar}}" alt="" style="max-height:100%; border-radius:50%;">
						</figure>
				</a>

				<div class="navbar-dropdown intercoton-green-b">
					  <a class="navbar-item has-text-intercoton-intercoton-green" ui-sref="admins.profile" ui-sref-active="is-active">
					   <span class="has-text-white">Mon profil</span> 
					  </a>
					   <a class="navbar-item has-text-intercoton-intercoton-green" href="/admins/logout" target="_self">
					   <span class="has-text-white">Déconnexion</span> 
					  </a>
				</div>	
			</div>

			<a  class="navbar-item" href="/admins/logout" target="_self">
				<button class="button is-danger">
					<span class="icon">
						<i class="fa fa-power-off has-text-white"></i>
					</span>
					<span>
						Déconnexion
					</span>
				</button>
			</a>
		</div>
	</div>
</nav>

<script>
	$(document).ready(function(){
		$('.navbar-burger').bind('click', function(e){
			e.preventDefault();
			$(this).toggleClass('is-active');
		});
	});
</script>