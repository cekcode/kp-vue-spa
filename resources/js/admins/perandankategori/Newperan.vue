<template>
    <modal name="peran" draggable=".window-header1" height="50%" width="50%" align="left">
        <div class="window-header1">
            <!-- Row -->
            <div class="row">

                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <div class="dashboard-box margin-top-0">

                        <!-- Headline -->
                        <div class="headline">
                            <h3><i class="icon-feather-folder-plus"></i> Form Tambah Peran Baru</h3>
                        </div>

                        <div class="content with-padding padding-bottom-10">
                            <form @submit.prevent="save">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Nama Peran</h5>
                                            <input type="text" ref="title" class="with-border form-control" v-model="peran.title" required>
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
    name: 'newperan',
    data() {
        return {
            peran: {
                title: ''
            },
            errors: {}
        };
    },
    computed: {
        currentUser() {
            return this.$store.getters.currentUser;
        }
    },
    methods:{
        save(){
            this.errors = null;
            const constraints = this.getConstraints();
            const errors = validate(this.$data.peran, constraints);
            if(errors) {
                this.errors = errors;
                return;
            }
            let formData = new FormData();
            formData.append("title", this.$refs.title.value);
            this.$store.dispatch("addPeran", formData);
            this.$store.dispatch('getPerans');
            this.hide();
            this.peran.title = ""
              
        },
        hide () {
            this.$modal.hide('peran');
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
    },
}
</script>

