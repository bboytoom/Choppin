<template>
    <td class="text-center">
        <button type="button" class="btn btn-danger btn-circle" v-on:click.prevent="deleted(id)">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td>
</template>

<script>
    import { ToadAlert } from '../helpers';

    export default {
        props: {
            id:{ type: Number },
            index: { type: Function }
        },
        methods: {
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
