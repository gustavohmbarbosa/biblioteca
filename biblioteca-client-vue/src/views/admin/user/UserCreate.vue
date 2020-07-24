<template>
  <div class="vx-col w-full mb-base">
    <vx-card>

      <div class="vx-row">
        <div class="vx-col mb-2" vs-w="6">

          <div class="vx-row mb-2">
            <div class="vx-col w-full">
              <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border label-placeholder="Nome"
                v-model="data.name" />
            </div>
          </div>

          <div class="vx-row mb-2">
            <div class="vx-col w-full">
              <vs-input type="email" class="w-full" icon-pack="feather" icon="icon-mail" icon-no-border
                label-placeholder="Email" v-model="data.email" />
            </div>
          </div>

          <div class="vx-row">
            <div class="vx-col sm:w-1/2 w-full mb-3">
              <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border
                label-placeholder="Senha" v-model="data.password" />
            </div>
            <div class="vx-col sm:w-1/2 w-full mb-3">
              <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border
                label-placeholder="Confirmar Senha" v-model="data.passwordConfirm" />
            </div>
          </div>
          <div class="vx-row">
            <div class="vx-col w-full mb-3">
              <h6 class="mb-3 text-center">Nível de Acesso</h6>
              <v-select :options="['Master','Comum']" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="data.role" />
            </div>
          </div>
        </div>

<<<<<<< HEAD
          <div class="vx-col m-auto" vs-w="6" vs-justify="center" vs-align="center">
            <div class="centerx">
              <vs-upload action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload"/>
=======
        <div class="vx-col m-auto centerx" vs-w="6" vs-justify="center" vs-align="center">
          <div class="centerx">

            <div class="upload-img mt-5" v-if="!data.image">
              <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
              <vs-button color="success" @click="$refs.uploadImgInput.click()">Selecionar Imagem</vs-button>
>>>>>>> e75ab67b8b886e1e67a10709d4881333ded823a0
            </div>

            <template v-if="data.image">

              <!-- Image Container -->
              <div class="img-container w-64 mx-auto flex items-center justify-center">
                <img :src="data.image" alt="img"  class="rounded responsive">
              </div>

              <!-- Image upload Buttons -->
              <div class="modify-img flex justify-between mt-5">
                <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*">
                <vs-button color="success" class="mr-4" @click="$refs.updateImgInput.click()">Atualizar Imagem</vs-button>
                <vs-button color="danger" type="border" @click="data.image = null">Remover Imagem</vs-button>
              </div>
            </template>
            
          </div>
        </div>
      </div>

      <div class="vx-row">
        <div class="vx-col w-full">
          <vs-button class="ml-auto mt-2">Cadastrar</vs-button>
          <vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset_data">Redefinir</vs-button>
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
      data: {
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
<<<<<<< HEAD
    successUpload: () => {

    }
  },
=======
    updateCurrImg(input) {
      if (input.target.files && input.target.files[0]) {
        var reader = new FileReader()
        reader.onload = e => {
          this.data.image = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    reset_data() {
       Object.assign(this.$data, this.$options.data())
    }
  }
>>>>>>> e75ab67b8b886e1e67a10709d4881333ded823a0
}
</script>

<style scoped>
 
  .con-img-upload {
    padding: 0;
  }
  .con-input-upload {
    width: 100%;
    margin: 0;
  }
</style>
