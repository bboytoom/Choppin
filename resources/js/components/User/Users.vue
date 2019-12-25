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
                            <th class="text-center" width="100">Estado</th>
                            <th class="text-center" width="140">Contraseña</th>
                            <th class="text-center" width="110">Configuracion</th>
                            <th class="text-center" width="110">Editar</th>
                            <th class="text-center" width="110">Eliminar</th>
                        </tr>
                    </thead>
                    <tableUser  v-on:dataEdit="dataEdit"
                                v-on:passwordEdit="passwordEdit" 
                                v-bind:index="index" 
                                v-bind:users="users" 
                                v-bind:page_state="page_state"></tableUser>
                </table>
                <paginate
                    :page-count="number_page"
                    :page-range="3"
                    :prev-text="'Anterior'"
                    :next-text="'Siguiente'"
                    :container-class="'pagination'"
                    :page-class="'page-item'" 
                    :page-link-class="'page-link'"
                    :next-class="'page-item'" 
                    :next-link-class="'page-link'"
                    :prev-class="'page-item'" 
                    :prev-link-class="'page-link'"
                    :clickHandler="index">
                </paginate>
            </div>
        </div>

        <storeUser v-bind:user="user" v-bind:index="index" v-bind:page_state="page_state"></storeUser>
        <updateUser v-bind:user="user" v-bind:index="index" v-bind:page_state="page_state"></updateUser>
        <passwordUser v-bind:user="user"></passwordUser>
    </div>
</template>

<script>

    import tableUser from './UsersTable.vue'
    import storeUser from './UserStore.vue'
    import updateUser from './UserUpdate.vue'
    import passwordUser from './UserPassword.vue'
    
    export default {
        data: function() {
            return {
                users: [],
                number_page: 0,
                page_state: 1,
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
            this.index(1);
        },
        components: {
            'tableUser': tableUser,
            'storeUser': storeUser,
            'updateUser': updateUser,
            'passwordUser': passwordUser
        },
        methods: {
            index: function(page) {
                axios.get('/api/v1/users?page='+page)
                .then((response) => {
                    this.page_state = page;
                    this.number_page = parseInt(response.data.meta.last_page);
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
            },
            passwordEdit: function(value) {
                this.user.id = value.id;
                this.user.name = value.name;
                this.user.mother_surname = value.mother_surname;
                this.user.father_surname = value.father_surname;

                $("#passwordUser").modal('show');   
            }
        }
    }
</script>
