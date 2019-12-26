<template>
    <div class="modal fade" id="updateAdmin" tabindex="-1" role="dialog" aria-labelledby="admineditLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <validation-observer ref="formadminupdate" v-slot="{ invalid }">
                <form method="POST" class="modal-content" v-on:submit.prevent="updateAdminSubmit(admin)" autocomplete="off">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title title-form__elem" id="admineditLabel">Editar usuario</h5>
                    </div>

                    <div v-if="errorUpdate.length">
                        <div v-for="updateerror in errorUpdate" v-bind:key="updateerror" class="alert alert-danger text-center rounded-0" role="alert">
                            {{ updateerror }}
                        </div>
                    </div>

                    <modalAdminForm v-bind:admin="admin"></modalAdminForm>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" v-on:click.prevent="updateAdminReset()">
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
    import modalAdminForm from './AdminsForm.vue';
    import { ToadAlert } from '../helpers';

    export default {
        props: {
            admin: { type: Object },
            index: { type: Function },
            page_state: { type: Number },
        },
        data: function() {
            return {
                errorUpdate: [],
            }
        },
        components: {
            'modalAdminForm': modalAdminForm
        },
        methods: {
            updateAdminSubmit: function(admin) {
                var data = {
                    'name': admin.name.toLowerCase(),
                    'mother_surname': admin.mother_surname.toLowerCase(),
                    'father_surname': admin.father_surname.toLowerCase(),
                    'email': admin.email.toLowerCase(),
                    'status': 1
                };

                this.$refs.formadminupdate.validate().then(success => {
                    if (!success) {
                        return;
                    }

                    axios.put('/api/v1/admins/'+admin.id, data)
                    .then((response) => {
                        if(response.status === 200) {
                            $("#updateAdmin").modal('hide');

                            this.index(this.page_state);
                            this.updateAdminReset();
                                
                            ToadAlert.toad('El administrador se actualizo correctamente');
                        }
                    }).catch(error => {
                        this.errorUpdate = error.response.data.errors.email;
                    }); 
                });
            },
            updateAdminReset: function() {
                this.admin.id = 0;
                this.admin.name = '';
                this.admin.mother_surname = '';
                this.admin.father_surname = '';
                this.admin.email = '';
                this.errorUpdate = [];
                this.$refs.formadminupdate.reset();
            }
        }
    }
</script>
