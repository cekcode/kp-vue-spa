<template>
    <!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Post</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><router-link to="/admin">Admin</router-link></li>
                        <li><router-link to="/admin/post">Post</router-link></li>
						<li>{{ post.title }}</li>
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
                                    <img v-bind:src="'../../uploads/'+post.image" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- Blog Post Content / End -->
					</div>
				</div>

                <div class="col-xl-8">
					<!-- Dashboard Box -->
					<div class="dashboard-box main-box-in-row">
						<div class="headline">
							<h3><i class="icon-feather-bar-chart-2"></i> Deskripsi</h3>
						</div>
						<div class="content">
							<!-- Chart -->
							<div class="chart" v-html="post.description"></div>
						</div>
					</div>
					<!-- Dashboard Box / End -->
				</div>
                <div class="col-xl-4">

					<!-- Dashboard Box -->
					<!-- If you want adjust height of two boxes 
						 add to the lower box 'main-box-in-row' 
						 and 'child-box-in-row' to the higher box -->
					<div class="dashboard-box child-box-in-row"> 
						<div class="headline">
							<h3><i class="icon-material-outline-note-add"></i> Catatan</h3>
						</div>	

						<div class="dashboard-box-scrollbar" style="max-height: 400px">
                            <div class="content">
                                <div class="chart">
                                    <ul>
										<li v-for="kategori in post.kategoris" :key="kategori.id"><b>Kategori :</b> {{ kategori.title }}</li>
										<li><b>Status :</b> {{ post.status }}</li>
										<li><b>Dibuat :</b> {{ post.created_at }}</li>
										<li><b>Diupdate :</b> {{ post.updated_at }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
					</div>
					<!-- Dashboard Box / End -->
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
            if (this.posts.length) {
                this.post = this.posts.find((post) => post.slug == this.$route.params.slug);
            } else {
                axios.get(`/api/post/${this.$route.params.slug}`)
                    .then((response) => {
                        this.post = response.data.post;
                    });
			}

		},
        data() {
            return {
				post: '',
				kategori:''
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            posts() {
                return this.$store.getters.posts;
            },
			kategories(){
				return this.$store.getters.kategories;
			},
			perans(){
				return this.$store.getters.perans;
			}
		},
		methods: {

		}
    }
</script>

<style scoped>
a { color: #66676b; transition: 0.3s; }
a, button { outline: none !important; }
a:focus,
a:hover { text-decoration: none; color: #333;}
</style>