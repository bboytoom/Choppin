<template>
    <tbody>
        <tr v-for="item in admins" v-bind:key="item.id">
            <td> 
                {{ item.attributes.name | capitalize }} 
                {{ item.attributes.father_surname | capitalize }} 
                {{ item.attributes.mother_surname === null ? '': item.attributes.mother_surname | capitalize }}
            </td>
            <td>
                {{ item.attributes.email }}
            </td>

            <td class="text-center">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" :id="`status_${item.id}`" :checked="item.attributes.status == 1" v-on:click.prevent="editStatus(item.id, item.attributes)">
                    <label class="custom-control-label" :for="`status_${item.id}`"></label>
                </div>
            </td>

            <td class="text-center">
                <button type="button" class="btn btn-secondary btn-sm" v-on:click.prevent="password(item.id)">
                    <i class="fas fa-lock"></i>
                </button>
            </td>
            
            <td class="text-center">
                <button type="button" class="btn btn-warning btn-circle" v-on:click.prevent="edit(item.id)">
                    <i class="fas fa-pen"></i>
                </button>
            </td>

            <td class="text-center">
                <button type="button" class="btn btn-danger btn-circle" v-on:click.prevent="deleted(item.id)">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
    </tbody>
</template>

<script>
    import { ToadAlert } from '../helpers';

    export default {
        props: {
            admins: { type: Array },
            index: { type: Function },
            page_state: { type: Number },
        },
        methods: {
            edit: function(id) {
                axios.get('/api/v1/admins/'+id)
                .then((response) => {
                    this.$emit('dataEdit', {
                        'id': response.data.id, 
                        'name': response.data.attributes.name,
                        'mother_surname': response.data.attributes.mother_surname,
                        'father_surname': response.data.attributes.father_surname,
                        'email': response.data.attributes.email
                    });
                });
            },
            deleted: function(id) {
                Swal.fire({
                    html: '<h6><strong>Seguro que quiere eliminar al administrador</strong></h6>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    width: '21rem',
                    preConfirm: () => {
                        axios.delete('/api/v1/admins/'+id)
                        .then((response) => {
                            console.log(response);
                            
                            /*if(response.status === 204) {
                                axios.get('/api/v1/admins')
                                .then((response) => {
                                    if(this.page_state > parseInt(response.data.meta.last_page)) {
                                        this.index(parseInt(response.data.meta.last_page));
                                    } else {
                                        this.index(this.page_state);
                                    }
                                    
                                    ToadAlert.toad('El Administrador se elimino correctamente'); 
                                });
                            }*/
                        });
                    }
                });
            },
            password: function(id) {
                axios.get('/api/v1/admins/'+id)
                .then((response) => {
                    this.$emit('passwordEdit', {
                        'id': response.data.id, 
                        'name': response.data.attributes.name,
                        'mother_surname': response.data.attributes.mother_surname,
                        'father_surname': response.data.attributes.father_surname,
                    });
                });
            },
            editStatus: function(id, attr) {
                Swal.fire({
                    html: '<h6><strong>Desea cambiar el estatus del administrador</strong></h6>',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    width: '21rem',
                    preConfirm: () => {
                       axios.put('/api/v1/admins/'+id, {
                            'name': attr.name,
                            'father_surname': attr.father_surname,
                            'email': attr.email,
                            'status': (attr.status == 1) ? 0 : 1
                       })
                        .then((response) => {
                            if(response.status === 200) {
                                this.index(this.page_state);
                            }
                        });
                    }
                });
            }
        }
    }
</script>
