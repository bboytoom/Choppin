<template>
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
        props: ['users', 'index'], 
        methods: {
            edit: function(id) {
                axios.get('/api/v1/users/'+id)
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
                axios.delete('/api/v1/users/'+id)
                .then((response) => {
                    if(response.status === 204) {
                        this.index();
                        ToadAlert.toad('El usuario se elimino correctamente');
                    }
                });
            }    
        }
    }
</script>