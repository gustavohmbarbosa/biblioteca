<template>
  <div class="vx-col w-full mb-base">
    <vx-card>

      <div class="vx-row">
        <div class="vx-col mb-2" vs-w="6">

          <div class="vx-row mb-2">
            <div class="vx-col w-full">
              <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border label-placeholder="Nome"
                v-model="user.name" />
            </div>
          </div>

          <div class="vx-row mb-2">
            <div class="vx-col w-full">
              <vs-input type="email" class="w-full" icon-pack="feather" icon="icon-mail" icon-no-border
                label-placeholder="Email" v-model="user.email" />
            </div>
          </div>

          <div class="vx-row">
            <div class="vx-col sm:w-1/2 w-full mb-3">
              <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border
                label-placeholder="Senha" v-model="user.password" />
            </div>
            <div class="vx-col sm:w-1/2 w-full mb-3">
              <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border
                label-placeholder="Confirmar Senha" v-model="user.passwordConfirm" />
            </div>
          </div>
          <div class="vx-row">
            <div class="vx-col w-full mb-3">
              <h6 class="mb-3">Nível de Acesso</h6>
              <v-select :options="['Master','Comum']" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="user.role" />
            </div>
          </div>
        </div>

        <div class="vx-col m-auto centerx" vs-w="6" vs-justify="center" vs-align="center">
          <div class="centerx">

            <div class="upload-img mt-5" v-if="!user.image">
              <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
              <vs-button @click="$refs.uploadImgInput.click()">Selecionar Imagem</vs-button>
            </div>

            <template v-if="user.image">

              <!-- Image Container -->
              <div class="img-container w-64 mx-auto flex items-center justify-center">
                <img :src="user.image" alt="img" class="responsive">
              </div>

              <!-- Image upload Buttons -->
              <div class="modify-img flex justify-between mt-5">
                <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*">
                <vs-button class="mr-4" type="flat" @click="$refs.updateImgInput.click()">Update Image</vs-button>
                <vs-button type="flat" color="#999" @click="user.image = null">Remove Image</vs-button>
              </div>
            </template>
            
          </div>
        </div>
      </div>

      <div class="vx-row">
        <div class="vx-col w-full">
          <vs-button class="mr-3 mb-2">Cadastrar</vs-button>
          <vs-button color="danger" type="border" class="mb-2">Cancelar</vs-button>
        </div>
      </div>
    </vx-card>
  </div>
</template>

<script>
import vSelect from 'vue-select'

export default {
  data() {
    return {
      user: {
        name: '',
        email: '',
        password: '',
        role: '',
        image: ''
      }
    }
  },
  components: {
    'v-select': vSelect
  },
  methods: {
    updateCurrImg(input) {
      if (input.target.files && input.target.files[0]) {
        var reader = new FileReader()
        reader.onload = e => {
          this.user.image = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
  }
}
</script>

<style scoped>
  .img-upload {
    margin-top: 2rem;
  }
  .con-img-upload {
    padding: 0;
  }
  .con-input-upload {
    width: 100%;
    margin: 0;
  }
</style>
