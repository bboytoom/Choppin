<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="usereditLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <validation-observer v-slot="{ invalid }">
            <form method="POST" class="modal-content" v-on:submit.prevent="userForm(user)" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title" id="usereditLabel">Actualizar usuario</h5>
                </div>
                <div class="modal-body">
                    <div v-for="error in errorsusers"  class="alert alert-danger" role="alert">
                        @{{ error }}
                    </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_name">Nombre</label>
                                <validation-provider name="Nombre" rules="min:3|max:40|required" v-slot="v, classes">
                                    <div class="control" :class="classes">
                                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Ingresa tu nombre" v-model="user.name" maxlength="41">
                                        <span>
                                            @{{ v.errors[0] }}
                                        </span>
                                    </div>
                                </validation-provider>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_father_surname">Apellido paterno</label>
                                <validation-provider name="Apellido paterno" rules="min:4|max:30|required" v-slot="v">
                                    <input type="text" class="form-control" id="user_father_surname" name="user_father_surname" placeholder="Ingresa tu apellido" v-model="user.father_surname" maxlength="31">
                                    <span>
                                        @{{ v.errors[0] }}
                                    </span>
                                </validation-provider>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_mother_surname">Apellido materno</label>
                                <validation-provider name="Apellido materno" rules="min:4|max:30" v-slot="v">
                                    <input type="text" class="form-control" id="user_mother_surname" name="user_mother_surname" placeholder="Ingresa tu apellido" v-model="user.mother_surname" maxlength="31">
                                    <span>
                                        @{{ v.errors[0] }}
                                    </span>
                                </validation-provider>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="user_email">Correo electronico</label>
                                <validation-provider name="Correo electronico" rules="min:8|max:80|required|email" v-slot="v">
                                    <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Ingresa tu correo electronico" v-model="user.email" maxlength="81">
                                    <span>
                                        @{{ v.errors[0] }}
                                    </span>
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
                    <button type="button" class="btn btn-secondary btn-icon-split" data-dismiss="modal">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        <span class="text">
                            Cancelar
                        </span>
                    </button>
                    <button type="submit" class="btn btn-primary btn-icon-split" :disabled="invalid">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-circle"></i>
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
