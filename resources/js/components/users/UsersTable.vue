<template>
    <tr>
        <td>
            {{ item.name + ' ' + item.mother_surname + ' ' + item.father_surname }}
        </td>
        <td>
            {{ item.email }}
        </td>
        <td class="text-center">
            <a href="#" class="btn btn-success btn-circle btn-sm" v-if="item.status == 1">
                <i class="fas fa-check"></i>
            </a>

            <a href="#" class="btn btn-danger btn-circle btn-sm" v-else>
                <i class="fas fa-times"></i>
            </a>
        </td>

        <td class="text-center">
            <button type="button" class="btn btn-warning btn-circle" v-on:click.prevent="showModalEdit(item.id)">
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
            showModalEdit(id) { 
                
            }
        }
    }
</script>