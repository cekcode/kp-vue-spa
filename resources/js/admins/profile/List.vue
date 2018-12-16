<template>
    <!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Profile</h3>
				<span class="is-pulled-right" v-if="loading">
					<a href="#" class="button dark ripple-effect"><i class="icon-feather-rotate-ccw"></i></a>
				</span>

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
							<router-link to="/admin/profile/new" class="btn btn-primary">Tambah <i class="icon-material-outline-arrow-right-alt"></i></router-link>
						</div>

						<div class="content">

							<template v-if="!profiles.length">
								<ul class="dashboard-box-list">
									<li colspan="4" class="text-center">Data Profile Kosong</li>
								</ul>
							</template>

							 <template v-else>
								<ul class="dashboard-box-list" v-for="(profile, index) in profiles" :key="profile.id">
									<li>
										<!-- Job Listing -->
										<div class="job-listing">

											<!-- Job Listing Details -->
											<div class="job-listing-details">
												<label hidden>{{ index }}</label>
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
											<router-link :to="`/admin/profile/edit/${profile.slug}`" title="Edit" data-tippy-placement="left" class="button gray ripple-effect-dark ico"><i class="icon-feather-edit"></i></router-link>
											<a @click="del(profile.id, index)" class="button red ripple-effect ico" title="Hapus" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
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
					© 2018 <strong>Hireo</strong>. All Rights Reserved.
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
		<Add hidden></Add>
	</div>
	<!-- Dashboard Content / End -->
</template>


<script>
let Add = require('./New.vue');
    export default {
		components:{Add},
		name: 'list',
			data(){
				return{
					loading:false,
					errors:{}
				}
		},
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
        },
		methods:{
			del(id,index){
				if (confirm("Are you sure ?")) {
				this.$store.dispatch("deleteProfile", id);
				this.profiles.splice(index, 1);
				}
				console.log(`${index} ${id}`)
				// window.location.reload(true)
			}
		}
    }
</script>

