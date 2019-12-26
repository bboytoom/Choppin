<template>
    <div class="modal fade" id="createAdmin" tabindex="-1" role="dialog" aria-labelledby="admineditLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <validation-observer ref="formadmincreate" v-slot="{ invalid }">
                <form method="POST" class="modal-content" v-on:submit.prevent="createAdminSubmit(admin)" autocomplete="off">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title title-form__elem" id="admineditLabel">Crear administrador</h5>
                    </div>

                    <div v-if="errorCreate.length">
                        <div v-for="createerror in errorCreate" v-bind:key="createerror" class="alert alert-danger text-center rounded-0" role="alert">
                            {{ createerror }}
                        </div>
                    </div>

                    <modalAdminForm v-bind:admin="admin"></modalAdminForm>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" v-on:click.prevent="createAdminrReset()">
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
                errorCreate: [],
            }
        },
        components: {
            'modalAdminForm': modalAdminForm
        },
        methods: {
            createAdminSubmit: function(admin) {
                var data = {
                    'name': admin.name.toLowerCase(),
                    'mother_surname': admin.mother_surname.toLowerCase(),
                    'father_surname': admin.father_surname.toLowerCase(),
                    'email': admin.email.toLowerCase(),
                    'status': 1
                };

                this.$refs.formadmincreate.validate().then(success => {
                    if (!success) {
                        return;
                    }

                    axios.post('/api/v1/admins/', data)
                    .then((response) => {
                        if (response.status === 201) {
                            $("#createAdmin").modal('hide');

                            this.index(this.page_state);
                            this.createAdminrReset();

                            ToadAlert.toad('El administrador se agrego correctamente');
                        }
                    }).catch(error => {
                        this.errorCreate = error.response.data.errors.email;
                    });
                });
            },
            createAdminrReset: function() {
                this.admin.id = 0;
                this.admin.name = '';
                this.admin.mother_surname = '';
                this.admin.father_surname = '';
                this.admin.email = '';
                this.errorCreate = [];
                this.$refs.formadmincreate.reset();
            }
        }
    }
</script>
