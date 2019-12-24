<template>
    <div class="card-header py-3 text-right">
        <button type="button" class="btn btn-primary btn-icon-split btn-sm" v-on:click.prevent="create()">
            <span class="icon text-white-50">
                <i class="fa fa-plus-circle"></i>
            </span>
            <span class="text">Agregar</span>
        </button>
    </div>
</template>

<script>
    export default {
        methods: {
            create: function() {
                $("#userModal").modal('show');
            },
        }
    }
</script>
