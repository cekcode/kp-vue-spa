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
						<li>Edit</li>
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
							<h3><i class="icon-feather-folder-plus"></i> Form Edit Profile</h3>
						</div>

						<div class="content with-padding padding-bottom-10">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Judul</h5>
                                            <input type="text" class="with-border form-control" v-model="profile.title">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Image</h5>
                                            <div id="preview">
                                                <img v-if="url" v-bind:src="url" height="200px" width="300px"/>
                                                <img v-else :src="'../../../uploads/'+profile.image" height="200px" width="300px"/>
                                            </div>
                                            <!-- <img :src="'../../../uploads/'+profile.image" height="200px" width="300px"> -->
                                            <div class="uploadButton margin-top-30">
                                                <input class="uploadButton-input" type="file" accept="image/*" id="upload" @change="onFileChange"/>
                                                <label class="uploadButton-button ripple-effect" for="upload">Upload Files</label>
                                                <span class="uploadButton-file-name">Jangan Masukan gambar apabila tidak ingin merubah gambar profile</span>
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
                                        <input type="submit" class="button ripple-effect big margin-top-30" @click='update'>
                                    </div>
                                
                                </div>

                                <!-- <div class="errors" v-if="errors">
                                    <ul>
                                        <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                                            <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                                        </li>
                                    </ul>
                                </div> -->
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
                <!-- Footer
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
                -->
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
        name: 'edit',
        data: function() {
            return {
                url:null,
                profile: {},
                errors:{}
            }
        },
        components: {
            VueEditor
        },
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
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            profiles() {
                return this.$store.getters.profiles;
            }
        },
        methods: {
            onFileChange(e) {
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
            },
            update(){
            axios.patch(`/api/profiles/update/${this.profile.id}`,this.$data.profile)
            .then((response)=> {
                this.$router.push('/admin/profile');
                location.reload();
            }).catch(e => {
                console.log(e);
                });
			}
        }
    }
</script>

<style scoped>
#preview{
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>