<template>
    <modal name="kategori" draggable=".window-header" height="70%" width="50%" align="left">
        <div class="window-header">
            <!-- Row -->
            <div class="row">

                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <div class="dashboard-box margin-top-0">

                        <!-- Headline -->
                        <div class="headline">
                            <h3><i class="icon-feather-folder-plus"></i> Form Tambah Kategori Baru</h3>
                        </div>

                        <div class="content with-padding padding-bottom-10">
                            <form @submit.prevent="save">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Peran</h5>
                                            <select data-size="7" ref="peran_id" v-model="peran_id" name="peran_id" required>
                                                <option v-for="peran in perans" :key="peran.id" v-bind:value="peran.id" >{{ peran.title }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Nama</h5>
                                            <input type="text" name="title" v-model="kategori.title" ref="title" class="with-border form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-xl-12">
                                        <input type="submit" class="button ripple-effect big margin-top-30" value="Save">
                                        <!-- <button @click="hide" class="button dark ripple-effect big margin-top-30">Close</button> -->
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
        </div>
    </modal>
</template>


<script>
import validate from 'validate.js';
export default {
    data(){
        return{
            kategori: {
                title: ''
            },
            peran_id:'',
            errors: {}
        }
    },
     mounted() {
        if(this.perans.length > 1) {
            return;
        }
        this.$store.dispatch('getPerans');
        
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
        save(){
            this.errors = null;
            const constraints = this.getConstraints();
            const errors = validate(this.$data.kategori, constraints);
            if(errors) {
                this.errors = errors;
                return;
            }
            let formData = new FormData();
            formData.append("title", this.$refs.title.value);
            formData.append("peran_id", this.$refs.peran_id.value);

            this.$store.dispatch("addKategori", formData);
            this.$store.dispatch('getKategoris');
            this.hide();
            this.kategori.title = ""
        },
        hide () {
            this.$modal.hide('kategori');
        },
        getConstraints() {
            return {
                title: {
                    presence: true,
                    length: {
                        minimum: 3,
                        maximum:20,
                        message: 'Minimal 3, maksimal 20 Karakter'
                    }
                }
            };
        }
    }
}
</script>

