<style>
	.menu-item-wrapper .menu-item .menu-icon, .menu-item-wrapper .menu-item .menu-text{
			color: #808080 !important;
	}

	.menu-item-wrapper.is-active .menu-item .menu-icon, .menu-item-wrapper.is-active .menu-item .menu-text{
			color: green !important;
	}

	.menu-item-wrapper.is-active{
		background: #caebd5;
	}
</style>

<section class="is-small is-pad-bot-200 is-pad-top-0" >
	<div class="menu-wrapper">
		<div ui-sref="admins.dashboard" ui-sref-active="is-active" class="menu-item-wrapper has-text-left is-pad-top-10 is-pad-bot-10">
			<a  class="menu-item is-pad-lft-25">
				<span class="icon is-ft-sz-17">
					<i class="fa fa-television menu-icon"></i>
				</span>
				<span class="has-weight-semibold is-pad-lft-15 menu-text">Dashboard</span>	
			</a>
		</div>
		<div class="menu-item-wrapper has-text-left is-pad-top-10 is-pad-bot-10" ui-sref-active="is-active" ui-sref="admins.sessions({page_id:1})">
			<a class="menu-item is-pad-lft-25">
				<span class="icon is-ft-sz-17">
					<i class="fa fa-binoculars menu-icon"></i>
				</span>
				<span class="has-weight-semibold is-pad-lft-15 menu-text">Sessions</span>	
			</a>
		</div>

		<div class="menu-item-wrapper has-text-left is-pad-top-10 is-pad-bot-10" ui-sref-active="is-active">
			<div class="dropdown is-hoverable">
				<a class="dropdown-trigger menu-item is-pad-lft-25">
					<span class="icon is-ft-sz-17">
						<i class="fa fa-bank menu-icon"></i>
					</span>
					<span class="has-weight-semibold is-pad-lft-15 menu-text">Cooperatives</span>	
					<span class="icon is-ft-sz-17 is-pad-lft-15">
						<i class="fa fa-chevron-down menu-icon"></i>
					</span>
				</a>

				 <div class="dropdown-menu" id="dropdown-menu" role="menu">
				    <div class="dropdown-content">
				      <a ui-sref="admins.cooperatives({page_id:1})" class="dropdown-item">
				        Vue d'ensemble
				      </a>
				      <a ui-sref="admins.cooperatives.create"  class="dropdown-item">
				        créer une coopérative
				      </a>
				    </div>
				  </div>
			</div>
		</div>
		<div class="menu-item-wrapper has-text-left is-pad-top-10 is-pad-bot-10" ui-sref-active="is-active">
			<div class="dropdown is-hoverable">
				<a class="dropdown-trigger menu-item is-pad-lft-25">
					<span class="icon is-ft-sz-17">
						<i class="fa fa-globe menu-icon"></i>
					</span>
					<span class="has-weight-semibold is-pad-lft-15 menu-text">Zones</span>	
					<span class="icon is-ft-sz-17 is-pad-lft-15">
						<i class="fa fa-chevron-down menu-icon"></i>
					</span>
				</a>

				 <div class="dropdown-menu" id="dropdown-menu" role="menu">
				    <div class="dropdown-content">
				      <a ui-sref="admins.zones({page_id:1})" class="dropdown-item">
				        Vue d'ensemble
				      </a>
				      <a ui-sref="admins.zones.create"  class="dropdown-item">
				        créer une zone
				      </a>
				    </div>
				  </div>
			</div>

		</div>

		<div class="menu-item-wrapper has-text-left is-pad-top-10 is-pad-bot-10" ui-sref="admins.profile" ui-sref-active="is-active">
			<a class="menu-item is-pad-lft-25">
				<span class="icon is-ft-sz-17">
					<i class="fa fa-sun-o menu-icon"></i>
				</span>
				<span class="has-weight-semibold is-pad-lft-15 menu-text" >Paramètres</span>	
			</a>
		</div>
		<div class="menu-item-wrapper has-text-left is-pad-top-10 is-pad-bot-10" ui-sref-active="is-active">
			<div class="dropdown is-hoverable">
				<a class="dropdown-trigger menu-item is-pad-lft-25">
					<span class="icon is-ft-sz-17">
						<i class="fa fa-users menu-icon"></i>
					</span>
					<span class="has-weight-semibold is-pad-lft-15 menu-text">Utilisateurs</span>	
					<span class="icon is-ft-sz-17 is-pad-lft-15">
						<i class="fa fa-chevron-down menu-icon"></i>
					</span>
				</a>

				 <div class="dropdown-menu" id="dropdown-menu" role="menu">
				    <div class="dropdown-content">
				      <a ui-sref="admins.auditors({page_id:1})" class="dropdown-item">
				        Vue ensemble
				      </a>
				      <a ui-sref="admins.auditors.create({page_id:1})"  class="dropdown-item">
				        créer un utilisateur
				      </a>
				    </div>
				  </div>
			</div>
		</div>
<!-- 		<div class="menu-item-wrapper has-text-left is-pad-top-10 is-pad-bot-10"  ui-sref-active="is-active">
			<a class="menu-item is-pad-lft-25" ui-sref="admins.archives">
				<span class="icon is-ft-sz-20">
					<i class="fa fa-archive menu-icon"></i>
				</span>
				<span class="has-weight-semibold is-pad-lft-15 menu-text">Archives</span>	
			</a>
		</div> -->
		<div class="menu-item-wrapper has-text-left is-pad-top-10 is-pad-bot-10" ui-sref-active="is-active">
			<a class="menu-item is-pad-lft-25" href="/admins/logout" target="_self">
				<span class="icon is-ft-sz-20">
					<i class="fa fa-power-off menu-icon"></i>
				</span>
				<span class="has-weight-semibold is-pad-lft-15 menu-text">Déconnexion</span>	
			</a>
		</div>
	</div>
</section>


