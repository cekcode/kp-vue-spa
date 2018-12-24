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
							<h3><i class="icon-material-outline-bookmark-border"></i> PERAN</h3> <router-link :to="'/admin/peran/new/'" data-tippy-placement="left" class="btn btn-primary">Tambah</router-link>
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
											<router-link :to="`/admin/perans/edit/${peran.slug}`" title="Edit" data-tippy-placement="left" class="button gray ripple-effect-dark ico"><i class="icon-feather-edit"></i></router-link>
											<a @click="delperan(peran.id, index,peran.title)" class="button red ripple-effect ico" title="Hapus" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
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
							<h3><i class="icon-material-outline-bookmarks"></i> KATEGORI</h3> <router-link :to="'/admin/kategori/new/'" data-tippy-placement="left" class="btn btn-primary">Tambah</router-link>
						</div>

						<div class="content">

							<template v-if="!kategoris.length">
								<ul class="dashboard-box-list">
									<li colspan="4" class="text-center">Data Kategori Kosong</li>
								</ul>
							</template>

							 <template v-else>
								<paginate name="kategoris" :list="kategoris" ref="paginator" :per="4" class="paginate-list">
								<ul class="dashboard-box-list" v-for="(kategori, key) in paginated('kategoris')" :key="key">
									<li>
										<!-- Job Listing -->
										<div class="job-listing">

											<!-- Job Listing Details -->
											<div class="job-listing-details">

												<!-- Details -->
												<div class="job-listing-description">
													<h3 class="job-listing-title">{{ kategori.title }}</h3>
													<div v-for="peran in kategori.perans" :key="peran.id">dari <b>{{ peran.title }}</b> </div>
												</div>
											</div>
										</div>
										<!-- Buttons -->
										<div class="buttons-to-right">
											<router-link :to="`/admin/kategoris/edit/${kategori.slug}`" title="Edit" data-tippy-placement="left" class="button gray ripple-effect-dark ico"><i class="icon-feather-edit"></i></router-link>
											<!-- <a v-on:click="editkategori(index)" title="Edit" data-tippy-placement="left" class="button gray ripple-effect-dark ico"><i class="icon-feather-edit"></i></a> -->
											<a @click="delkategori(kategori.id, kategori.title)" class="button red ripple-effect ico" title="Hapus" data-tippy-placement="left"><i class="icon-feather-trash-2"></i></a>
										</div>
									</li>
									<hr>
								</ul>
								</paginate>
								<div class="col-md-6">
									<paginate-links :hide-single-page="true" :show-step-links="true" :async="true" for="kategoris" :simple="{
									next: 'Next »',
									prev: '« Back'
									}" :classes="{
									'ul': 'align-items-xl-center',
									'.next > a': ['btn', 'btn-outline-primary'],
									'.prev > a': ['btn', 'btn-outline-primary'] }"></paginate-links>
									<span class="align-text-top" v-if="$refs.paginator"> View {{$refs.paginator.pageItemsCount}} data kategori</span>
								</div>
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

	</div>
	<!-- Dashboard Content / End -->
</template>


<script>

let Addperan = require('./Newperan.vue');
let Addkategori = require('./Newkategori.vue');
    export default {
		name: 'list',
			data(){
				return{
					paginate: ['kategoris'],
					loading:false,
					errors:{}
				}
		},
        mounted() {
			if(this.kategoris.length && this.perans.length > 1) {
				return;
			}
			this.$store.dispatch('getKategoris');
			this.$store.dispatch('getPerans');		
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
			delperan(id,index,title){
				var self = this;
				self.$swal({
					title: "Ingin Hapus Peran "+title+" ?",
					text: "Data akan dihapus permanen!",
					icon: "warning",
					buttons: true,
  					dangerMode: true,
					closeOnConfirm: true
				}).then((isConfirm) => {
					if(isConfirm) {
						self.$store.dispatch("deletePeran", id);
						self.perans.splice(index, 1);
						self.$swal({
							title: "Berhasil!",
							text: "Berhasil Menghapus Peran "+title,
							icon: "success",
						});

						return true;
					}else {
						return false;
					}
				});
			},
			delkategori(id,title){
				var self = this;
				self.$swal({
					title: "Yakin Hapus Kategori "+title+" ?",
					text: "Data akan dihapus permanen!",
					icon: "warning",
					buttons: true,
  					dangerMode: true,
					closeOnConfirm: true
				}).then((isConfirm) => {
					if(isConfirm) {
						self.$store.dispatch("deleteKategori", id);
						// this.kategoris.splice(index, 1);
						window.location.reload(true);
						self.$swal({
							title: "Berhasil!",
							text: "Berhasil Menghapus Kategori "+title,
							icon: "success",
						});
						return true;
					}else {
						return false;
					}
				});
			}
		}
    }
</script>

<style lang="sass">
ul
  list-style-type: none
  padding: 0
li
  display: inline-block
  margin: 0 10px
.paginate-list
  text-align: left
  li
    display: block
    &:before
      font-weight: bold
      color: slategray
    
.paginate-links.items
  user-select: none
  a
    cursor: pointer
  
  li.active a
    font-weight: bold
  
  li.next:before
    content: ' | '
    margin-right: 13px
    color: #ddd
  
  li.disabled a
    color: #ccc
    cursor: no-drop
  
a
  color: #42b983
</style>
