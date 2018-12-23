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
							<h3><i class="icon-material-outline-business"></i> PROFILE </h3> <router-link to="/admin/profile/new" class="btn btn-primary">Tambah <i class="icon-material-outline-arrow-right-alt"></i></router-link>
						</div>
                            <b-col md="6" class="my-1">
                                <b-form-group horizontal label="Cari" class="mb-0">
                                <b-input-group>
                                    <b-form-input v-model="filter" placeholder="Ketikan disini..." />
                                    <b-input-group-append>
                                    <b-btn :disabled="!filter" @click="filter = ''">Clear</b-btn>
                                    </b-input-group-append>
                                </b-input-group>
                                </b-form-group>
                            </b-col>
                            <b-col md="6" class="my-1">
                                <b-form-group horizontal label="Urutkan" class="mb-0">
                                <b-input-group>
                                    <b-form-select v-model="sortBy" :options="sortOptions">
                                    <option slot="first" :value="null">-- kosong --</option>
                                    </b-form-select>
                                    <b-form-select :disabled="!sortBy" v-model="sortDesc" slot="append">
                                    <option :value="false">Asc</option>
                                    <option :value="true">Desc</option>
                                    </b-form-select>
                                </b-input-group>
                                </b-form-group>
                            </b-col>
                            <b-col md="6" class="my-1">
                                <b-form-group horizontal label="Per page" class="mb-0">
                                <b-form-select :options="pageOptions" v-model="perPage" />
                                </b-form-group>
                            </b-col>

                            <!-- Main table element -->
                            <b-table show-empty
                                    stacked="md"
                                    :items="posts"
                                    :fields="fields"
                                    :current-page="currentPage"
                                    :per-page="perPage"
                                    :filter="filter"
                                    :sort-by.sync="sortBy"
                                    :sort-desc.sync="sortDesc"
                                    :sort-direction="sortDirection"
                                    @filtered="onFiltered"
                            >
                            <!-- <template slot="name" slot-scope="row">{{row.value.name}}</template> -->
                            <!-- <template slot="isActive" slot-scope="row">{{row.value?'Yes :)':'No :('}}</template> -->
                            <template slot="actions" slot-scope="row">
                                <router-link :to="`/admin/post/`+row.item.slug" title="Lihat" data-tippy-placement="left" class="btn btn-secondary ico"><i class="icon-feather-eye"></i></router-link> 
                                <router-link :to="`/admin/post/edit/`+row.item.slug" title="Edit" data-tippy-placement="left" class="btn btn-warning ico"><i class="icon-feather-edit"></i></router-link>
                                <router-link :to="`/admin/post/edit/`+row.item.slug" title="Hapus" data-tippy-placement="left" class="btn btn-danger ico"><i class="icon-feather-trash"></i></router-link>
                            </template>
                            </b-table>

                            <b-row>
                            <b-col md="6" class="my-1">
                                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
                            </b-col>
                            </b-row>

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

const posts = ['posts'];
    export default {
		name: 'list',
			data(){
				return{
					// posts: posts,
                    fields: [
                        { key: 'title', label: 'Judul', sortable: true, sortDirection: 'desc' },
                        { key: 'created_at', label: 'Dibuat', sortable: true, 'class': 'text-center' },
                        { key: 'actions', label: 'Actions' }
                    ],
                    currentPage: 1,
                    perPage: 5,
                    totalRows: posts.length,
                    pageOptions: [ 5, 10, 15 ],
                    sortBy: null,
                    sortDesc: false,
                    sortDirection: 'asc',
                    filter: null,
                    modalInfo: { title: '', content: '' }
				}
		},
        mounted() {
            //  if (this.posts.length > 1) {
            //     return;
            // }
			this.$store.dispatch('getPosts');
        },
        computed: {
            posts() {
                return this.$store.getters.posts;
			},
			currentUser() {
                return this.$store.getters.currentUser;
            },
            sortOptions () {
            // Create an options list from our fields
            return this.fields
                .filter(f => f.sortable)
                .map(f => { return { text: f.label, value: f.key } })
            }
        },
		methods:{
			info (item, index, button) {
            this.modalInfo.title = `Row index: ${index}`
            this.modalInfo.content = JSON.stringify(item, null, 2)
            this.$root.$emit('bv::show::modal', 'modalInfo', button)
            },
            resetModal () {
            this.modalInfo.title = ''
            this.modalInfo.content = ''
            },
            onFiltered (filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
            }
		}
    }
</script>

