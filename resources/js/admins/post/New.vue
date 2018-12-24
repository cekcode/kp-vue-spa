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
						<li>Tambah Post</li>
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
							<h3><i class="icon-feather-folder-plus"></i> Form Tambah Post Baru</h3>
						</div>

						<div class="content with-padding padding-bottom-10">
                            <form @submit.prevent="save" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Peran</h5>
                                            <select data-size="7" ref="peran_id" @change="onChange" v-model="peran_id" name="peran_id" required>
                                                <option value="">--Pilih Peran--</option>
                                                <option v-for="peran in perans" :key="peran.id" v-bind:value="peran.id" >{{ peran.title }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <div v-if="kategoris">
                                                <h5>Kategori</h5>
                                                <select ref="kategori_id" @change="changekategori" v-for="kategori in kategoris" :key="kategori.id" v-model="Kategori_id" id="kategori_id" required>
                                                    <option value="">--Pilih Kategori--</option>
                                                    <option v-for="value in kategori.kategoris" :value="value.id" :key="value.id">{{ value.title }}</option>
                                                </select>
                                            </div>
                                            <div v-else></div>
                                        </div>
                                    </div>


                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Judul</h5>
                                            <input type="text" ref="title" class="with-border form-control" v-model="post.title" required>
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
                                            <vue-editor id="editor" :editorOptions="editorSettings" useCustomImageHandler @imageAdded="handleImageAdded" ref="description" v-model="post.description"></vue-editor>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Status</h5>
                                            <select ref="status" required>
                                                <option value="aktif">Aktif</option>
                                                <option value="aktif">Tidak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <input type="submit" class="button ripple-effect big margin-top-30" value="Save">
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
import { VueEditor } from 'vue2-editor';
import Quill from 'quill'; 
import { ImageDrop } from 'quill-image-drop-module';
import ImageResize from 'quill-image-resize-module'; 

Quill.register('modules/imageDrop', ImageDrop)
Quill.register('modules/imageResize', ImageResize);

    export default {
        name: 'new',
        data() {
            return {
                editorSettings: {
                    modules: {
                        imageDrop: true,
                        imageResize: {}
                    }
                },
                url:null,
                selectedFile:null,
                Kategori_id:'',
                kategori: {
                    title: '',
                    id:''
                },
                post: {
                    title: '',
                    image: '',
                    description: ''
                },
                peran_id:'',
                kategoris:null,
                errors: null
            };
        },
        components: {
            VueEditor
        },
        mounted() {
            this.$store.dispatch('getPerans');   
        }
        ,
        computed: {
            perans() {
                return this.$store.getters.perans;
            },
            currentUser() {
                return this.$store.getters.currentUser;
            } 
        },
        methods: {
            changekategori:function(event){
                this.$refs.kategori_id.value = event.target.value;
            },
            onChange:function(event){
                axios.get('/api/post/get-kategori/'+event.target.value)
                .then(response => 
                this.kategoris = response.data.kategoris,
                )
                .catch(error => console.log(error))
               
            //    this.$store.dispatch('getKategoribyidperan', event.target.value);
               console.log(event.target.value);
            },
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
            onImageChange(event) {
                this.selectedFile = event.target.files[0];
                this.url = URL.createObjectURL(this.selectedFile);
            },
            save() {
                this.errors = null;
                const constraints = this.getConstraints();
                const errors = validate(this.$data.post, constraints);
                if(errors) {
                    this.errors = errors;
                    return;
                }

                let formData = new FormData();

                formData.append("image", this.selectedFile, this.selectedFile.name);
                formData.append("title", this.$refs.title.value);
                formData.append("description", this.$refs.description.value);
                formData.append("kategori_id", this.$refs.kategori_id.value);
                formData.append("status", this.$refs.status.value);
                
                this.$store.dispatch("addPost", formData);
                this.$router.push('/admin/post');
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
