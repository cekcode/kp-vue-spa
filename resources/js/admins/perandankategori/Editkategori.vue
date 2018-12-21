<template>
    <modal name="edit-kategori" draggable=".window-header" height="70%" width="50%" align="left" v-if="!kategori.isComplete">
        <div class="window-header">
            <!-- Row -->
            <div class="row">

                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <div class="dashboard-box margin-top-0">

                        <!-- Headline -->
                        <div class="headline">
                            <h3><i class="icon-feather-folder-plus"></i> Form Edit Kategori</h3>
                        </div>

                        <div class="content with-padding padding-bottom-10">
                            <form @submit.prevent="updatekategori">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Peran</h5>
                                            <select data-size="7" ref="peran_id" name="peran_id" required>
                                                <option :selected="true" v-for="peran in kategori.perans" :key="peran.id" v-bind:value="peran.id">{{ peran.title }}</option>
                                                <option v-for="peran in perans" :key="peran.id" v-bind:value="peran.id">{{ peran.title }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Nama Kategori</h5>
                                            <input type="text" ref="title" v-model="kategori.title" class="with-border form-control" required>
                                            <!-- <small v-if="errors.title" class="has-text-danger">{{ errors.title[0] }}</small> -->
                                        </div>
                                    </div> 


                                    <div class="col-xl-12">
                                        <input type="submit" class="button ripple-effect big margin-top-30" value="Update">
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
    name: 'editkategori',
    data(){
        return{
            selected: "",
            kategori:{},
            errors: {}
        }
    },
    mounted() {
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
        updatekategori(){
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

            var options = { 
                id: this.kategori.id,
                data: formData 
            };
            this.$store.dispatch('updateKategori', options);
            this.$store.dispatch('getKategoris');
            this.hide();
            // this.kategori = "";

        },
        hide () {
            this.$modal.hide('edit-kategori');
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

