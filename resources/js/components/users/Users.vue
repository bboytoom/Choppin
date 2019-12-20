<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-right">
            <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fa fa-plus-circle"></i>
                </span>
                <span class="text">Agregar</span>
            </a>
        </div>

        <div class="card-body" >
            <h4 class="text-center" v-if="users.length == 0">
                No cuentas con usuarios
            </h4>

            <div class="table-responsive" v-else>
                <table id="users" class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th class="text-center">Estatus</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <user-table-component   v-on:edituser="editUser" 
                                                v-for="item in users" 
                                                v-bind:item="item"
                                                v-bind:key="item.id"></user-table-component>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
        data: function () {
            return {
                users:[]
            }
        },
        created() {
            axios.get('/api/v1/users')
            .then((response) => {
                this.users = response.data.data;
            });
        },
        methods: {
            editUser(user) {
                console.log(user);
                $('#Modal').modal('show');
            }
        }
    }
</script>