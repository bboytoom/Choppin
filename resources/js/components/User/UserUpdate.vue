<template>
    <div class="modal fade" id="updateUser" tabindex="-1" role="dialog" aria-labelledby="usereditLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <validation-observer ref="formupdate" v-slot="{ invalid }">
                <form method="POST" class="modal-content" v-on:submit.prevent="updateUserSubmit(user)" autocomplete="off">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title title-form__elem" id="usereditLabel">Editar usuario</h5>
                    </div>
                    
                    <div v-if="errorUpdate.length">
                        <div v-for="updateerror in errorUpdate" v-bind:key="updateerror" class="alert alert-danger text-center rounded-0" role="alert">
                            {{ updateerror }}
                        </div>
                    </div>

                    <modalForm v-bind:user="user"></modalForm>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" v-on:click.prevent="updateUserReset()">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Cancelar
                            </span>
                        </button>
                        <button type="submit" class="btn btn-success btn-icon-split" :disabled="invalid">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">
                                Guardar
                            </span>
                        </button>
                    </div>
                </form>
            </validation-observer>
        </div>
    </div>
</template>

<script>
    import modalForm from './UsersForm.vue';
    import { ToadAlert } from '../helpers';

    export default {
        props: {
            user: { type: Object },
            index: { type: Function },
            page_state: { type: Number },
        },
        data: function() {
            return {
                errorUpdate: [],
            }
        },
        components: {
            'modalForm': modalForm
        },
        methods: {
            updateUserSubmit: function(user) {
                var data = {
                    'name': user.name.toLowerCase(),
                    'mother_surname': user.mother_surname.toLowerCase(),
                    'father_surname': user.father_surname.toLowerCase(),
                    'email': user.email.toLowerCase(),
                    'status': 1
                };

                this.$refs.formupdate.validate().then(success => {
                    if (!success) {
                        return;
                    }

                    axios.put('/api/v1/users/'+user.id, data)
                    .then((response) => {
                        if(response.status === 200) {
                            $("#updateUser").modal('hide');

                            this.index(this.page_state);
                            this.updateUserReset();
                                
                            ToadAlert.toad('El usuario se actualizo correctamente');
                        }
                    }).catch(error => {
                        this.errorUpdate = error.response.data.errors.email;
                    }); 
                });
            },
            updateUserReset: function() {
                this.user.id = 0;
                this.user.name = '';
                this.user.mother_surname = '';
                this.user.father_surname = '';
                this.user.email = '';
                this.errorUpdate = [];
                this.$refs.formupdate.reset();
            }
        }
    }
</script>