<template>
    <td class="text-center">
        <button type="button" class="btn btn-warning btn-circle" v-on:click.prevent="edit(id)">
            <i class="fas fa-pen"></i>
        </button>
    </td>
</template>

<script>
    export default {
        props: {
            id:{
                type: Number,
                default: 0
            }
        },
        methods: {
            edit: function(id) {
                axios.get('/api/v1/users/'+id)
                .then((response) => {
                    this.$emit('dataEdit', {
                        'id': response.data.id, 
                        'name': response.data.attributes.name,
                        'mother_surname': response.data.attributes.mother_surname,
                        'father_surname': response.data.attributes.father_surname,
                        'email': response.data.attributes.email,
                        'status': (response.data.attributes.status === 1) ? true : false
                    });
                });
            }
        }
    }
</script>