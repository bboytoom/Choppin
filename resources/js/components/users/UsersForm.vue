<template>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="usereditLabel">Actualizar usuario {{ prueba }}</h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="user_name">Nombre</label>
                        <input type="text" class="form-control" id="user_name" placeholder="Ingresa tu nombre">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="user_father_surname">Apellido paterno</label>
                        <input type="text" class="form-control" id="user_father_surname" placeholder="Ingresa tu apellido">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="user_mother_surname">Apellido materno</label>
                        <input type="text" class="form-control" id="user_mother_surname" placeholder="Ingresa tu apellido">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="user_email">Correo electronico</label>
                        <input type="email" class="form-control" id="user_email" placeholder="Ingresa tu correo electronico">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-control custom-switch mt-4">
                        <input type="checkbox" class="custom-control-input" id="user_status">
                        <label class="custom-control-label" for="user_status">Estatus</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            prueba: String
        }
    }
</script>