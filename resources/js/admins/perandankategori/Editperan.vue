<template>
    <modal name="edit-peran" draggable=".window-header" height="50%" width="50%" align="left">
        <div class="window-header">
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
                            <form>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Nama Peran</h5>
                                            <input type="text" ref="title" v-model="peran.title" class="with-border form-control" required>
                                            <small v-if="errors.title" class="has-text-danger">{{ errors.title[0] }}</small>
                                        </div>
                                    </div> 


                                    <div class="col-xl-12">
                                        <button class="button ripple-effect big margin-top-30" @click="update">Update</button>
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
    name: 'editperan',
    data(){
        return{
            peran:{},
            errors: {}
        }
    },
    computed: {
        currentUser() {
            return this.$store.getters.currentUser;
        }
    },
    methods:{
        update(){
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
            this.hide();
        },
        hide () {
            this.$modal.hide('edit-peran');
        },
        getConstraints() {
            return {
                title: {
                    presence: true,
                    length: {
                        minimum: 3,
                        maximum: 20,
                        message: 'Minimal 3,maximal 20 Karakter'
                    }
                }
            };
        }
    }
}
</script>

