<template>
    <!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Profile</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><router-link to="/admin">Admin</router-link></li>
						<li>Profile</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">
						<!-- Headline -->
						<div class="headline">
							<h3><router-link to="/admin/profile/new" class="button gray ripple-effect-dark">Tambah Baru <i class="icon-feather-file-plus"></i></router-link></h3>
						</div>

						<div class="content">

							<template v-if="!profiles.length">
								<ul class="dashboard-box-list">
									<li colspan="4" class="text-center">Data Profile Kosong</li>
								</ul>
							</template>

							 <template v-else>
								<ul class="dashboard-box-list" v-for="profile in profiles" :key="profile.id">
									<li>
										<!-- Job Listing -->
										<div class="job-listing">

											<!-- Job Listing Details -->
											<div class="job-listing-details">

												<!-- Logo -->
												<a href="#" class="job-listing-company-logo">
													<img src="data:image/jpeg;base64,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" alt="">
												</a>

												<!-- Details -->
												<div class="job-listing-description">
													<h3 class="job-listing-title"><a href="#">{{ profile.title }}</a></h3>
												</div>
											</div>
										</div>
										<!-- Buttons -->
										<div class="buttons-to-right">
											<router-link :to="`/admin/profile/${profile.id}`" class="button gray ripple-effect-dark ico" title="Lihat" data-tippy-placement="left"><i class="icon-material-outline-visibility"></i></router-link>
											<a href="#" class="button dark ripple-effect ico" title="Edit" data-tippy-placement="left"><i class="icon-feather-edit"></i></a>
											<a href="#" class="button red ripple-effect ico" title="Hapus" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
										</div>
									</li>
									<hr>
								</ul>
							 </template>

						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->

			<!-- Footer -->
			<div class="dashboard-footer-spacer"></div>
			<div class="small-footer margin-top-15">
				<div class="small-footer-copyrights">
					Â© 2018 <strong>Hireo</strong>. All Rights Reserved.
				</div>
				<ul class="footer-social-links">
					<li>
						<a href="#" title="Facebook" data-tippy-placement="top">
							<i class="icon-brand-facebook-f"></i>
						</a>
					</li>
					<li>
						<a href="#" title="Twitter" data-tippy-placement="top">
							<i class="icon-brand-twitter"></i>
						</a>
					</li>
					<li>
						<a href="#" title="Google Plus" data-tippy-placement="top">
							<i class="icon-brand-google-plus-g"></i>
						</a>
					</li>
					<li>
						<a href="#" title="LinkedIn" data-tippy-placement="top">
							<i class="icon-brand-linkedin-in"></i>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<!-- Footer / End -->

		</div>
	</div>
	<!-- Dashboard Content / End -->
</template>


<script>
    export default {
        name: 'list',
        mounted() {
            if (this.profiles.length > 1) {
                return;
            }
			this.$store.dispatch('getProfiles');
        },
        computed: {
            profiles() {
                return this.$store.getters.profiles;
            }
        }
    }
</script>

<style scoped>
a { color: #66676b; transition: 0.3s; }
a, button { outline: none !important; }
a:focus,
a:hover { text-decoration: none; color: #333;}
</style>