<template>
    <div class="modal fade" id="passwordUser" tabindex="-1" role="dialog" aria-labelledby="usereditLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <validation-observer ref="formuserpassword" v-slot="{ invalid }">
                <form method="POST" class="modal-content" v-on:submit.prevent="passwordUserSubmit(user, password, password_confimed)" autocomplete="off">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title title-form__elem" id="usereditLabel">Cambio de contraseña</h5>
                    </div>
                    
                    <div class="alert alert-warning text-center rounded-0" role="alert">
                        Cambio de contraseña al usuario 
                        <strong>
                            {{ user.name + ' ' + user.father_surname + ' ' + (user.mother_surname === null ? '': user.mother_surname) }}
                        </strong>
                    </div>

                    <div v-if="errorPassword.length">
                        <div v-for="updatepasserror in errorPassword" v-bind:key="updatepasserror" class="alert alert-danger text-center rounded-0" role="alert">
                            {{ updatepasserror }}
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_user">Contraseña</label>
                                    <validation-provider name="Password" rules="min:7|max:20|required|password:@confirm" v-slot="{ errors, classes }">
                                        <div class="control" :class="classes">
                                            <input type="password" id="password_user" class="form-control" placeholder="Ingresa la contraseña" v-model="password" maxlength="21">
                                            <span>
                                                {{ errors[0] }}
                                            </span>
                                        </div>
                                    </validation-provider>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_repeat_user">Repite la contraseña</label>
                                    <validation-provider name="confirm" rules="min:7|max:20|required" v-slot="{ errors, classes }">
                                        <div class="control" :class="classes">
                                            <input type="password" id="password_repeat_user" class="form-control" placeholder="Repite la contraseña" v-model="password_confimed" maxlength="21">
                                            <span>
                                                {{ errors[0] }}
                                            </span>
                                        </div>
                                    </validation-provider>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary btn-icon-split" data-dismiss="modal" v-on:click.prevent="passwordUserReset()">
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
            user: { type: Object }
        },
        data: function() {
            return {
                password: '',
                password_confimed: '',
                errorPassword: [],
            }
        },
        methods: {
            passwordUserSubmit: function(user, password, confirmation) {
                var data = {
                    'password': password,
                    'password_confirmation': confirmation
                };
                
                this.$refs.formuserpassword.validate().then(success => {
                    if (!success) {
                        return;
                    }

                    axios.put('/api/v1/userpassword/'+user.id, data)
                    .then((response) => {
                        if (response.status === 200) {
                            $("#passwordUser").modal('hide');
                           
                            this.passwordUserReset();
                            ToadAlert.toad('La contraseña se actualizo correctamente');
                        }
                    }).catch(error => {
                        this.errorPassword = error.response.data.errors.password;
                    });
                });
            },
            passwordUserReset: function() {
                this.user.id = 0;
                this.user.name = '';
                this.user.mother_surname = '';
                this.user.father_surname = '';
                this.password = '';
                this.password_confimed = '';
                this.errorPassword = [];
                this.$refs.formuserpassword.reset();
            }
        }
    }
</script>
