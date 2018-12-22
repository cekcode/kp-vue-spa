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
                        <li><router-link to="/admin/profile">Profile</router-link></li>
						<li>{{ profile.title }}</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Blog Post -->
                        <div class="blog-post single-post">

                                <!-- Blog Post Thumbnail -->
                                <div class="blog-post-thumbnail">
                                    <div class="blog-post-thumbnail-inner">
                                        <span class="blog-item-tag">Gambar Utama</span>
                                        <img v-bind:src="'../../uploads/'+profile.image" alt="">
                                    </div>
                                </div>

                                <!-- Blog Post Content -->
                                    <div class="blog-post-content">
                                        <h3 class="margin-bottom-10">{{ profile.title }}</h3>

                                        <!-- <div class="blog-post-info-list margin-bottom-20">
                                            <a href="#" class="blog-post-info">22 July 2018</a>
                                            <a href="#"  class="blog-post-info">5 Comments</a>
                                        </div> -->
                                        <div v-html="profile.description"></div>
                                        
                                    </div>

                                </div>
                                <!-- Blog Post Content / End -->
                        
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
	</div>
	<!-- Dashboard Content / End -->
</template>

<script>
    export default {
        created() {
            if (this.profiles.length) {
                this.profile = this.profiles.find((profile) => profile.slug == this.$route.params.slug);
            } else {
                axios.get(`/api/profiles/${this.$route.params.slug}`)
                    .then((response) => {
                        this.profile = response.data.profile
                    });
            }
        },
        data() {
            return {
                profile: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
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