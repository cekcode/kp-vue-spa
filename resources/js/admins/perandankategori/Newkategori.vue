<template>
    <modal name="kategori" draggable=".window-header" height="50%" width="50%" align="left">
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
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Nama</h5>
                                            <input type="text" ref="title" class="with-border form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-xl-12">
                                        <button v-on:click="save" class="button ripple-effect big margin-top-30">Save</button>
                                        <button @click="hide" class="button dark ripple-effect big margin-top-30">Close</button>
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
export default {
    data(){
        return{
            errors: null
        }
    },
    methods:{
        save(){

        },
        hide () {
            this.$modal.hide('kategori');
        }
    }
}
</script>

