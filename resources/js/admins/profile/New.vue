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
						<li>New</li>
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
							<h3><i class="icon-feather-folder-plus"></i> Form Tambah Profile Baru</h3>
						</div>

						<div class="content with-padding padding-bottom-10">
                            <form @submit.prevent="add" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Judul</h5>
                                            <input type="text" ref="title" class="with-border form-control" v-model="profile.title" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Image</h5>
                                            <div id="preview">
                                                <img v-if="url" v-bind:src="url" height="200px" width="300px"/>                                            
                                            </div>
                                            <div class="uploadButton margin-top-30">
                                                <input class="uploadButton-input" type="file" accept="image/*" id="image" name="image" v-on:change="onImageChange" required/>
                                                <label class="uploadButton-button ripple-effect" for="image">Upload Files</label>
                                                <span class="uploadButton-file-name">Hanya dapat upload file image jpeg,jpg,png,gif</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Description</h5>
                                            <!-- <wysiwyg v-model="profile.description" /> -->
                                            <vue-editor  ref="description" v-model="profile.description"></vue-editor>
                                            <!-- <textarea cols="30" rows="5" class="with-border" v-model="profile.description"></textarea> -->
                                            
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <input type="submit" class="button ripple-effect big margin-top-30" value="Save">
                                    </div>
                                
                                </div>

                                <div class="errors" v-if="errors">
                                    <ul>
                                        <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                                            <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                                        </li>
                                    </ul>
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
    import { VueEditor } from 'vue2-editor';

    export default {
        name: 'new',
        data() {
            return {
                url:null,
                selectedFile:null,
                profile: {
                    title: '',
                    image: '',
                    description: ''
                },
                errors: null
            };
        },
        components: {
            VueEditor
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            onImageChange(event) {
                this.selectedFile = event.target.files[0];
                this.url = URL.createObjectURL(this.selectedFile);
            },
            add() {
                this.errors = null;
                const constraints = this.getConstraints();
                const errors = validate(this.$data.profile, constraints);
                if(errors) {
                    this.errors = errors;
                    return;
                }

                let formData = new FormData();

                formData.append("image", this.selectedFile, this.selectedFile.name);
                formData.append("title", this.$refs.title.value);
                formData.append("description", this.$refs.description.value);
                
                this.$store.dispatch("addProfile", formData);
                // this.$router.push('/admin/profile');
                // axios.post('/api/profiles/new', formData)
                //     .then((response) => {
                //         this.$router.push('/admin/profile');
                //         location.reload();
                //     }).catch(e => {
                //         console.log(e);
                //     });
            },
            getConstraints() {
                return {
                    title: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Minimal 3 Karakter'
                        }
                    },
                    description: {
                        presence: true
                    }
                };
            }
        }
    }
</script>


<style>
#preview{
    display: flex;
    justify-content: center;
    align-items: center;
}
.errors {
    background: lightcoral;
    border-radius:5px;
    padding: 21px 0 2px 0;
}
</style>
