<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-right">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="search_admin" placeholder="Busca al administrador" v-model="searchAdmin">
                    </div>
                </div>

                <div class="col-md-6">
                    <button type="button" class="btn btn-primary btn-icon-split btn-sm" v-on:click.prevent="create()">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        <span class="text">Agregar</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <h4 class="text-center" v-if="admins.length == 0">
                No cuentas con administradores
            </h4>
            
            <div class="table-responsive" v-else>
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th class="text-center" width="100">Estado</th>
                            <th class="text-center" width="140">Contraseña</th>
                            <th class="text-center" width="110">Editar</th>
                            <th class="text-center" width="110">Eliminar</th>
                        </tr>
                    </thead>

                    <tableAdmin v-on:dataEdit="dataEdit"
                                v-on:passwordEdit="passwordEdit" 
                                v-bind:index="index" 
                                v-bind:admins="filtroAdmin"
                                v-bind:page_state="page_state"></tableAdmin>
                </table>

                <paginate
                    :page-count="number_page"
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

        <storeAdmin v-bind:admin="admin" v-bind:index="index" v-bind:page_state="page_state"></storeAdmin>
        <updateAdmin v-bind:admin="admin" v-bind:index="index" v-bind:page_state="page_state"></updateAdmin>
        <passwordAdmin v-bind:admin="admin"></passwordAdmin>
    </div>

</template>

<script>

    import tableAdmin from './AdminsTable.vue'
    import storeAdmin from './AdminsStore.vue'
    import updateAdmin from './AdminsUpdate.vue'
    import passwordAdmin from './AdminsPassword.vue'

    export default {
        data: function() {
            return {
                admins: [],
                number_page: 0,
                page_state: 1,
                searchAdmin: '',
                admin: {
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
            'tableAdmin': tableAdmin,
            'passwordAdmin': passwordAdmin,
            'storeAdmin': storeAdmin,
            'updateAdmin': updateAdmin
        },
        computed: {
            filtroAdmin: function() {
                if(this.searchAdmin) {
                    return this.admins.filter((item) => {
                        return item.attributes.name.includes(this.searchAdmin);
                    });
                } else {
                    return this.admins;
                }
            }
        },
        methods: {
            index: function(page) {
                axios.get('/api/v1/admins?page='+page)
                .then((response) => {
                    this.page_state = page;
                    this.number_page = parseInt(response.data.meta.last_page);
                    this.admins = response.data.data;
                });
            },
            create: function() {
                $("#createAdmin").modal('show');
            },
            dataEdit: function(value) {
                this.admin.id = value.id;
                this.admin.name = value.name;
                this.admin.mother_surname = value.mother_surname;
                this.admin.father_surname = value.father_surname;
                this.admin.email = value.email;

                $("#updateAdmin").modal('show');
            },
            passwordEdit: function(value) {
                this.admin.id = value.id;
                this.admin.name = value.name;
                this.admin.mother_surname = value.mother_surname;
                this.admin.father_surname = value.father_surname;

                $("#passwordAdmin").modal('show'); 
            }
        }
    }
</script>
