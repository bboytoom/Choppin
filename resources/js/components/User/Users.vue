<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-right">
            <button type="button" class="btn btn-primary btn-icon-split btn-sm" v-on:click.prevent="create()">
                <span class="icon text-white-50">
                    <i class="fa fa-plus-circle"></i>
                </span>
                <span class="text">Agregar</span>
            </button>
        </div>
        <div class="card-body">
            <h4 class="text-center" v-if="users.length == 0">
                No cuentas con usuarios
            </h4>

            <div class="table-responsive" v-else>
                <table id="users" class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tableUser v-on:dataEdit="dataEdit" v-bind:index="index" v-bind:users="users"></tableUser>
                </table>
            </div>
        </div>

        <storeUser v-bind:user="user" v-bind:index="index"></storeUser>
        <updateUser v-bind:user="user" v-bind:index="index"></updateUser>
    </div>
</template>

<script>

    import tableUser from './UsersTable.vue'
    import storeUser from './UserStore.vue'
    import updateUser from './UserUpdate.vue'

    export default {
        data: function() {
            return {
                users: [],
                user: {
                    'id': 0, 
                    'name': '',
                    'mother_surname': '',
                    'father_surname': '',
                    'email': ''
                }
            }
        },
        created: function() {
            this.index();
        },
        components: {
            'tableUser': tableUser,
            'storeUser': storeUser,
            'updateUser': updateUser
        },
        methods: {
            index: function() {
                axios.get('/api/v1/users')
                .then((response) => {
                    this.users = response.data.data;
                });
            },
            create: function() {
                $("#createUser").modal('show');
            },
            dataEdit: function(value) {
                this.user.id = value.id;
                this.user.name = value.name;
                this.user.mother_surname = value.mother_surname;
                this.user.father_surname = value.father_surname;
                this.user.email = value.email;

                $("#updateUser").modal('show');
            }
        }
    }
</script>
