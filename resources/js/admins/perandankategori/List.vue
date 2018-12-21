<template>
    <!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Peran & Kategori</h3>
				<span class="is-pulled-right" v-if="loading">
					<a href="#" class="button dark ripple-effect"><i class="icon-feather-rotate-ccw"></i></a>
				</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><router-link to="/admin">Admin</router-link></li>
						<li>Peran & Kategori</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-6">
					<div class="dashboard-box margin-top-0">
						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-bookmark-border"></i> PERAN</h3> <button v-on:click="showperan" class="btn btn-primary">Tambah <i class="icon-material-outline-arrow-right-alt"></i></button>
						</div>

						<div class="content">

							<template v-if="!perans.length">
								<ul class="dashboard-box-list">
									<li colspan="4" class="text-center">Data Peran Kosong</li>
								</ul>
							</template>

							 <template v-else>
								<ul class="dashboard-box-list" v-for="(peran, index) in perans" :key="peran.id">
									<li>
										<!-- Job Listing -->
										<div class="job-listing">

											<!-- Job Listing Details -->
											<div class="job-listing-details">
												<label hidden>{{ index }}</label>

												<!-- Details -->
												<div class="job-listing-description">
													<h3 class="job-listing-title"><router-link :to="`/admin/peran/${peran.slug}`" title="Lihat" data-tippy-placement="left">{{ peran.title }}</router-link></h3>
												</div>
											</div>
										</div>
										<!-- Buttons -->
										<div class="buttons-to-right">
											<a @click="editperan(index)" title="Edit" data-tippy-placement="left" class="button gray ripple-effect-dark ico"><i class="icon-feather-edit"></i></a>
											<a @click="delperan(peran.id, index)" class="button red ripple-effect ico" title="Hapus" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
										</div>
									</li>
									<hr>
								</ul>
							 </template>

						</div>
					</div>
				</div>


				<!-- Dashboard Box -->
				<div class="col-xl-6">
					<div class="dashboard-box margin-top-0">
						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-bookmarks"></i> KATEGORI</h3> <button v-on:click="showkategori" class="btn btn-primary">Tambah <i class="icon-material-outline-arrow-right-alt"></i></button>
						</div>

						<div class="content">

							<template v-if="!kategoris.length">
								<ul class="dashboard-box-list">
									<li colspan="4" class="text-center">Data Kategori Kosong</li>
								</ul>
							</template>

							 <template v-else>
								<ul class="dashboard-box-list" v-for="(kategori, index) in kategoris" :key="kategori.id">
									<li>
										<!-- Job Listing -->
										<div class="job-listing">

											<!-- Job Listing Details -->
											<div class="job-listing-details">
												<label hidden>{{ index }}</label>

												<!-- Details -->
												<div class="job-listing-description">
													<h3 class="job-listing-title">{{ kategori.title }}</h3>
													<div v-for="peran in kategori.perans" :key="peran.id">by <b>{{ peran.title }}</b> </div>
												</div>
											</div>
										</div>
										<!-- Buttons -->
										<div class="buttons-to-right">
											<a @click="editkategori(index)" title="Edit" data-tippy-placement="left" class="button gray ripple-effect-dark ico"><i class="icon-feather-edit"></i></a>
											<a @click="delkategori(kategori.id, index)" class="button red ripple-effect ico" title="Hapus" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
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
		<Addperan></Addperan>
		<Editperan></Editperan>
        <Addkategori></Addkategori>
	</div>
	<!-- Dashboard Content / End -->
</template>


<script>

let Addperan = require('./Newperan.vue');
let Editperan = require('./Editperan.vue');
let Addkategori = require('./Newkategori.vue');
    export default {
		components:{Addperan,Addkategori,Editperan},
		name: 'list',
			data(){
				return{
					loading:false,
					errors:{}
				}
		},
        mounted() {
            if(this.perans.length > 1) {
				return;
			}
			this.$store.dispatch('getPerans');

			if(this.kategoris.length > 1) {
				return;
			}
			this.$store.dispatch('getKategoris');
			
        },
        computed: {
            perans() {
                return this.$store.getters.perans;
			},
			kategoris() {
                return this.$store.getters.kategoris;
            },
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
		methods:{
            showperan () {
                this.$modal.show('peran');
            },
            showkategori () {
                this.$modal.show('kategori');
			},
			editperan(index) {
				this.$children[2].peran = this.perans[index];
                this.$modal.show('edit-peran');
            },
			delperan(id,index){
				if (confirm("Are you sure ?")) {
				this.$store.dispatch("deletePeran", id);
				this.perans.splice(index, 1);
				}
				console.log(`${index} ${id}`)
				// window.location.reload(true)
			},
			editkategori(index) {
				
            },
			delkategori(id,index){
				if (confirm("Are you sure ?")) {
				this.$store.dispatch("deleteKategori", id);
				this.kategoris.splice(index, 1);
				}
				console.log(`${index} ${id}`)
			}
		}
    }
</script>

