<template>
    <div class="card shadow mb-4">
        <btnCreate></btnCreate>
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
                    <tbody>
                        <tr v-for="item in users" v-bind:key="item.id">
                            <td>
                                {{ item.attributes.name + ' ' + item.attributes.father_surname + ' ' + (item.attributes.mother_surname === null ? '': item.attributes.mother_surname) }}
                            </td>
                            <td>
                                {{ item.attributes.email }}
                            </td>
                            
                            <td class="text-center">
                                <h6 class="text-success" v-if="item.attributes.status == 1">Activo</h6>
                                <h6 class="text-danger" v-else>Inactivo</h6>
                            </td>
                            
                            <btnEdit v-on:dataEdit="dataEdit" v-bind:id="item.id" />
                            <btnDelete v-bind:id="item.id" v-bind:index="index" />                          
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <modalForm v-bind:user="user" v-bind:index="index"></modalForm>
    </div>
</template>

<script>
    import modalForm from './UsersForm.vue'
    import btnCreate from './UsersCreateBtn.vue'
    import btnEdit from './UsersEditBtn.vue'
    import btnDelete from './UsersDeleteBtn.vue'

    export default {
        data: function() {
            return {
                users: [],
                user: {
                    'id': 0, 
                    'name': '',
                    'mother_surname': '',
                    'father_surname': '',
                    'email': '',
                    'status': true
                }
            }
        },
        created: function() {
            this.index();
        },
        components: {
            'modalForm': modalForm,
            'btnCreate': btnCreate,
            'btnEdit': btnEdit,
            'btnDelete': btnDelete
        },
        methods: {
            index: function() {
                axios.get('/api/v1/users')
                .then((response) => {
                    this.users = response.data.data;
                });
            },
            dataEdit: function(value) {
                this.user.id = value.id;
                this.user.name = value.name;
                this.user.mother_surname = value.mother_surname;
                this.user.father_surname = value.father_surname;
                this.user.email = value.email;
                this.user.status = value.status;

                $("#userModal").modal('show');
            }
        }
    }
</script>
