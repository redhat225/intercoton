<!-- Navbar -->
<?= $this->element('navbar') ?>

<div class="columns is-mar-bot-0">
	<div class="column is-2 is-pad-rgt-0 is-pad-bot-150" style="position:relative;">
		<?= $this->element('side-menu') ?>
		<?= $this->element('about-me') ?>

	</div>
	<div class="column is-10 hero is-pad-top-50 is-pad-lft-50" style="background:url('/img/assets/logo/back.png') #f6fff9 no-repeat 50% 50%;border-left:2px solid #e5e5e5;">
		
		<!-- Main Section -->
		<section ui-view ng-hide="preloader"></section>
		<!-- Main Preloader -->
		<div ng-show="preloader" class="has-text-centered section is-medium">
               <img src="/img/assets/logo/intercoton.png" width="250px" alt="">
				<p class="has-text-centered">
               <img src="/img/assets/preloaders/11.gif" alt="">
					
				</p>

        </div>

	</div>
</div>
<!-- Footer -->
<?= $this->element('footer') ?>