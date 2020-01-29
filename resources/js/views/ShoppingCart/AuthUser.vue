<template>
  <div id="authuser" class="container mt-4">
    <form action="">
      <div class="form-group">
        <label>Correo</label>
        <input v-model="email" type="email" class="form-control lower--mdf" placeholder="Ingresa tu correo electronico" maxlength="81">
      </div>

      <div class="form-group">
        <label>contraseña</label>
        <input v-model="password" type="password" class="form-control" placeholder="Ingresa la contraseña" maxlength="21">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success btn-icon-split">
          login
        </button>
      </div>
    </form>
  </div>
</template>

<script>

export default {
  name: 'AuthUser',
  data: function () {
    return {
      email: '',
      password: ''
    }
  }
}

</script>
