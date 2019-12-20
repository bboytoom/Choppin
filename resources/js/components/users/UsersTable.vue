<template>
    <tr>
        <td>
            {{ item.attributes.name + ' ' + item.attributes.mother_surname + ' ' + item.attributes.father_surname }}
        </td>
        <td>
            {{ item.attributes.email }}
        </td>
        <td class="text-center">
            <a href="#" class="btn btn-success btn-circle btn-sm" v-if="item.attributes.status == 1">
                <i class="fas fa-check"></i>
            </a>

            <a href="#" class="btn btn-danger btn-circle btn-sm" v-else>
                <i class="fas fa-times"></i>
            </a>
        </td>

        <td class="text-center">
            <button type="button" class="btn btn-warning btn-circle" v-on:click.prevent="edit(item.id)">
                <i class="fas fa-exclamation-triangle"></i>
            </button>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-circle">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            item: {
                type: Object
            }
        },
        methods: {
            edit(id) {
                axios.get('/api/v1/users/'+id)
                .then((response) => {
                    this.$emit('edituser', response.data);
                });
            }
        }
    }
</script>
