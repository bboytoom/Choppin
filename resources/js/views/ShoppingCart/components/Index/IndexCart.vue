<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <div class="btn-group">
        <button id="dropdownMenu2" class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          compras
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">
                  qty
                </th>
                <th scope="col">
                  Nombre
                </th>
                <th scope="col">
                  precio
                </th>
                <th scope="col">
                  image
                </th>
                <th scope="col">
                  eliminar
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>mlsdmflfmld dfdsf</td>
                <td>$ 20</td>
                <td>image</td>
                <td>
                  <button type="button" class="btn btn-danger">
                    elimnar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>

export default {
  name: 'IndexCart'
}

</script>
