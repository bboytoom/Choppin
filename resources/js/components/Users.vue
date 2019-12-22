<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-right">
            <button type="button" class="btn btn-primary btn-icon-split btn-sm" v-on:click.prevent="$emit('create')">
                <span class="icon text-white-50">
                    <i class="fa fa-plus-circle"></i>
                </span>
                <span class="text">Agregar</span>
            </button>
        </div>

        <div class="card-body">
            <h4 class="text-center" v-if="data.length == 0">
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
                        <tr v-for="item in data" v-bind:key="item.id">
                            <td>
                                {{ item.attributes.name + ' ' + item.attributes.father_surname + ' ' + (item.attributes.mother_surname === null ? '': item.attributes.mother_surname) }}
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
                                <button type="button" class="btn btn-warning btn-circle" v-on:click.prevent="$emit('edit', item.id)">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-circle" v-on:click.prevent="$emit('delete', item.id)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data']
    }
</script>