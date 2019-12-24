<template>
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="usereditLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <validation-observer ref="form" v-slot="{ invalid }">
                <form method="POST" class="modal-content" v-on:submit.prevent="submitForm(user)" autocomplete="off">
                    <div class="modal-header bg-success text-white">
                        <h5 v-if="user.id == 0" class="modal-title title-form__elem" id="usereditLabel">Crear usuario</h5>
                        <h5 v-else class="modal-title" id="usereditLabel">Actualizar usuario</h5>
                    </div>

                    <div class="modal-body">
                        <div v-if="errorForm.length">
                            <div v-for="erroremail in errorForm" v-bind:key="erroremail" class="alert alert-danger text-center" role="alert">
                                {{ erroremail }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user_name">Nombre</label>
                                    <validation-provider name="Nombre" rules="min:3|max:40|required" v-slot="{ errors, classes }">
                                        <div class="control" :class="classes">
                                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Ingresa tu nombre" v-model="user.name" maxlength="41">
                                            <span>
                                                {{ errors[0] }}
                                            </span>
                                        </div>
                                    </validation-provider>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user_father_surname">Apellido paterno</label>
                                    <validation-provider name="Apellido paterno" rules="min:4|max:30|required" v-slot="{ errors, classes }">
                                        <div class="control" :class="classes">
                                            <input type="text" class="form-control" id="user_father_surname" name="user_father_surname" placeholder="Ingresa tu apellido" v-model="user.father_surname" maxlength="31">
                                            <span>
                                                {{ errors[0] }}
                                            </span>
                                        </div>
                                    </validation-provider>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user_mother_surname">Apellido materno</label>
                                    <validation-provider name="Apellido materno" rules="min:4|max:30" v-slot="{ errors, classes }">
                                        <div class="control" :class="classes">
                                            <input type="text" class="form-control" id="user_mother_surname" name="user_mother_surname" placeholder="Ingresa tu apellido" v-model="user.mother_surname" maxlength="31">
                                            <span>
                                                {{ errors[0] }}
                                            </span>
                                        </div>
                                    </validation-provider>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="user_email">Correo electronico</label>
                                    <validation-provider name="Correo electronico" rules="min:8|max:80|required|email" v-slot="{ errors, classes }">
                                        <div class="control" :class="classes">
                                            <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Ingresa tu correo electronico" v-model="user.email" maxlength="81">
                                            <span>
                                                {{ errors[0] }}
                                            </span>
                                        </div>
                                    </validation-provider>
                                </div>
                            </div>

                            <div class="col-md-4 text-right">
                                <div class="custom-control custom-switch mt-4">
                                    <input type="checkbox" class="custom-control-input" id="user_status" v-model="user.status">
                                    <label class="custom-control-label" for="user_status">Estatus</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" v-on:click.prevent="reset()">
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
    import { ToadAlert } from '../helpers';

    export default {
        props: {
            user: { type: Object },
            index: { type: Function }
        },
        data: function() {
            return {
                errorForm: [],
            }
        },
        methods: {
            submitForm: function(user) {
                var data = {
                    'name': user.name.toLowerCase(),
                    'mother_surname': user.mother_surname.toLowerCase(),
                    'father_surname': user.father_surname.toLowerCase(),
                    'email': user.email.toLowerCase(),
                    'status': user.status
                };

                this.$refs.form.validate().then(success => {
                    if (!success) {
                        return;
                    }

                    if(user.id == 0) {
                        axios.post('/api/v1/users/', data)
                        .then((response) => {
                            if(response.status === 201) {
                                $("#userModal").modal('hide');
            
                                this.index();
                                this.reset();

                                ToadAlert.toad('El usuario se agrego correctamente');
                            }
                        }).catch(error => {
                            this.errorForm = error.response.data.errors.email;
                        });
                    } else {
                        axios.put('/api/v1/users/'+user.id, data)
                        .then((response) => {
                            if(response.status === 200) {
                                $("#userModal").modal('hide');

                                this.index();
                                this.reset();
                                
                                ToadAlert.toad('El usuario se actualizo correctamente');
                            }
                        });
                    }
                });
            },
            reset: function() {
                this.user.id = 0;
                this.user.name = '';
                this.user.mother_surname = '';
                this.user.father_surname = '';
                this.user.email = '';
                this.user.status = true;
                this.$refs.form.reset();
            }
        }
    }
</script>
