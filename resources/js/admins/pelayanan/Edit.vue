<template>
    <!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Pelayanan Medik</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><router-link to="/admin">Admin</router-link></li>
                        <li><router-link to="/admin/pelayanan-medik">Pelayanan Medik</router-link></li>
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
							<h3><i class="icon-feather-folder-plus"></i> Form Edit Pelayanan Medik</h3>
						</div>

						<div class="content with-padding padding-bottom-10">
                            <form @submit.prevent="update" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Judul</h5>
                                            <input type="text" ref="title" class="with-border form-control" v-model="pelayanan.title">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Description</h5>
                                            <vue-editor id="editor" :editorOptions="editorSettings" useCustomImageHandler @imageAdded="handleImageAdded" ref="description" v-model="pelayanan.description"></vue-editor>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <input type="submit" class="button ripple-effect big margin-top-30" value="Update">
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
import { VueEditor } from 'vue2-editor';
import validate from 'validate.js';
import Quill from 'quill'; 
import { ImageDrop } from 'quill-image-drop-module';
import ImageResize from 'quill-image-resize-module'; 

Quill.register('modules/imageDrop', ImageDrop)
Quill.register('modules/imageResize', ImageResize);

    export default {
        name: 'edit',
        data: function() {
            return {
                editorSettings: {
                    modules: {
                        imageDrop: true,
                        imageResize: {}
                    }
                },
                pelayanan: {
                    title: '',
                    description: ''
                },
                errors:{}
            }
        },
        components: {
            VueEditor
        },
        created() {
            if (this.pelayanans.length) {
                this.pelayanan = this.pelayanans.find((pelayanan) => pelayanan.slug == this.$route.params.slug);
            } else {
                axios.get(`/api/pelayanans/${this.$route.params.slug}`)
                    .then((response) => {
                        this.pelayanan = response.data.pelayanan
                    });
            }
        },
        computed: {
            pelayanans() {
                return this.$store.getters.pelayanans;
            },
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
                var formData = new FormData();
                formData.append('image', file)
                axios({url: 'http://localhost:8000/api/images',method: 'POST', data: formData})
                .then(result => {
                console.log(result);
                let localhost = 'http://localhost:8000/uploads/';
                let url = localhost+result.data.url;

                Editor.insertEmbed(cursorLocation, 'image', url);
                resetUploader();
                })
                .catch((err) => {
                console.log(err);
                })
            },
            update(){
                this.errors = null;
                const constraints = this.getConstraints();
                const errors = validate(this.$data.pelayanan, constraints);
                if(errors) {
                    this.errors = errors;
                    return;
                }

                let formData = new FormData();
                formData.append("id", this.pelayanan.id);
                formData.append("title", this.$refs.title.value);
                formData.append("description", this.$refs.description.value);
                
                var options = { 
                    id: this.pelayanan.id,
                    data: formData 
                };
                
                this.$store.dispatch('updatePelayanan', options);
                this.$router.push('/admin/pelayanan-medik');
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

<style scoped>
#preview{
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>