<template>
  <div class="modal-body vfa-demo">
    <VueFileAgent
      ref="vfaGalleryRef"
      v-model="profilePic"
      class="upload-block"
      :multiple="false"
      :deletable="true"
      :theme="'list'"
      :max-size="'1MB'"
      :error-text="{
        type: 'Archivo no valido',
        size: 'El tamaño maximo es de 1MB ',
      }"
      @select="onSelect($event)"
    >
      <template v-slot:before-outer>
        <div class="row">
          <div class="col-md-12 text-center">
            <img class="img-thumbnail rounded" :src="`${photogallery.url}`" :alt="`${photogallery.name}`" style="width: 500px;">
          </div>

          <div class="col-md-12 mt-4">
            <div class="form-group">
              <label>Nombre</label>
              <validation-provider v-slot="{ errors, classes }" name="Nombre" rules="min:3|max:100|required">
                <div class="control" :class="classes">
                  <input v-model="photogallery.name" type="text" class="form-control lower--mdf" placeholder="Ingresa el nombre" maxlength="101">
                  <span>
                    {{ errors[0] }}
                  </span>
                </div>
              </validation-provider>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Descripcion</label>
              <validation-provider v-slot="{ errors, classes }" name="Descripcion" rules="min:4|max:250">
                <div class="control" :class="classes">
                  <textarea v-model="photogallery.description" class="form-control lower--mdf" rows="5" placeholder="Ingresa la descripcion de la caracteristica" maxlength="251" />
                  <span>
                    {{ errors[0] }}
                  </span>
                </div>
              </validation-provider>
            </div>
          </div>
        </div>
      </template>

      <template v-slot:file-preview="slotProps">
        <div :key="slotProps.index" class="grid-box-item file-row">
          <button type="button" class="close remove" aria-label="Remove" @click="removeFileData(slotProps.fileData)">
            <span aria-hidden="true">&times;</span>
          </button>

          <strong>{{ slotProps.fileData.name() }}</strong>
          <span class="text-muted">({{ slotProps.fileData.size() }})</span>
        </div>
      </template>

      <template v-slot:file-preview-new>
        <div key="new">
          <button title="after-inner" class="btn btn-primary btn-sm btn-block rounded-0">
            <i class="fas fa-upload" /> Subir imagen
          </button>
        </div>
      </template>
    </VueFileAgent>
  </div>
</template>

<script>

export default {
  props: {
    photogallery: {
      type: Object,
      default: function () {
        return {}
      }
    }
  },
  data: function () {
    return {
      profilePic: null
    }
  },
  methods: {
    removeFileData: function (fileData) {
      this.photogallery.url = this.photogallery.temp
      this.profilePic = null

      return this.$refs.vfaGalleryRef.removeFileData(fileData)
    },
    onSelect: function (fileData) {
      var reader = new FileReader()

      reader.onload = (e) => {
        this.photogallery.url = reader.result

        this.$emit('imageSelect', {
          image: fileData[0].file.name,
          type: fileData[0].file.type,
          base: reader.result
        })
      }

      reader.readAsDataURL(fileData[0].file)
    }
  }
}

</script>
