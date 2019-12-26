<template>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="user_name">Nombre</label>
                    <validation-provider name="Nombre" rules="min:3|max:40|required" v-slot="{ errors, classes }">
                        <div class="control" :class="classes">
                            <input type="text" class="form-control lower--mdf" placeholder="Ingresa tu nombre" v-model="admin.name" maxlength="41">
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
                            <input type="text" class="form-control lower--mdf" placeholder="Ingresa tu apellido" v-model="admin.father_surname" maxlength="31">
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
                            <input type="text" class="form-control lower--mdf" placeholder="Ingresa tu apellido" v-model="admin.mother_surname" maxlength="31">
                            <span>
                                {{ errors[0] }}
                            </span>
                        </div>
                    </validation-provider>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="user_email">Correo electronico</label>
                    <validation-provider name="Correo electronico" rules="min:8|max:80|required|email" v-slot="{ errors, classes }">
                        <div class="control" :class="classes">
                            <input type="email" class="form-control lower--mdf" placeholder="Ingresa tu correo electronico" v-model="admin.email" maxlength="81">
                            <span>
                                {{ errors[0] }}
                            </span>
                        </div>
                    </validation-provider>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['admin']
    }
</script>