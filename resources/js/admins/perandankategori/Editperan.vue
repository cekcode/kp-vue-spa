<template>
    <!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Peran</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><router-link to="/admin">Admin</router-link></li>
                        <li><router-link to="/admin/peran-dan-kategori">Peran & Kategori</router-link></li>
						<li>Edit Peran</li>
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
							<h3><i class="icon-feather-folder-plus"></i> Form Edit Peran</h3>
						</div>

						<div class="content with-padding padding-bottom-10">
                            <form @submit.prevent="updateperan">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Nama Peran</h5>
                                            <input type="text" ref="title" v-model="peran.title" class="with-border form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <input type="submit" class="button ripple-effect big margin-top-30" value="Update">
                                    </div>
                                
                                </div>

                            </form>
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
import validate from 'validate.js';
export default {
    name: 'editperan',
    data(){
        return{
            peran: {
                id:'',
                title: ''
            },
            errors: {}
        }
    },
    created() {
        if (this.perans.length) {
            this.peran = this.perans.find((peran) => peran.slug == this.$route.params.slug);
        } else {
            axios.get(`/api/perans/${this.$route.params.slug}`)
                .then((response) => {
                    this.peran = response.data.peran
                });
        }
    },
    computed: {
        perans() {
            return this.$store.getters.perans;
        },
        currentUser() {
            return this.$store.getters.currentUser;
        }
    },
    methods:{
        updateperan(){
            this.errors = null;
            const constraints = this.getConstraints();
            const errors = validate(this.$data.peran, constraints);
            if(errors) {
                this.errors = errors;
                return;
            }

            let formData = new FormData();
            formData.append("title", this.$refs.title.value);
            var options = { 
                id: this.peran.id,
                data: formData 
            };
            this.$store.dispatch('updatePeran', options);
            this.$router.push('/admin/peran-dan-kategori');
            this.$store.dispatch('getPerans');
            
        },
        getConstraints() {
            return {
                title: {
                    presence: true,
                    length: {
                        minimum: 3,
                        maximum: 30,
                        message: 'Minimal 3,maximal 30 Karakter'
                    }
                }
            };
        }
    }
}
</script>
