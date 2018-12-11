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
													<img v-bind:src="'../uploads/'+profile.image">
												</a>

												<!-- Details -->
												<div class="job-listing-description">
													<h3 class="job-listing-title"><router-link :to="`/admin/profile/${profile.slug}`" title="Lihat" data-tippy-placement="left">{{ profile.title }}</router-link></h3>
												</div>
											</div>
										</div>
										<!-- Buttons -->
										<div class="buttons-to-right">
											<a href="#" class="button gray ripple-effect-dark ico" title="Edit" data-tippy-placement="left"><i class="icon-feather-edit"></i></a>
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