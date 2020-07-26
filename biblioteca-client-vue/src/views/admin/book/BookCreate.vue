<template>
  <div class="vx-col w-full mb-base">
    <vx-card>

      <div class="vx-row">
        <div class="vx-col sm:w-1/2 w-full mb-3">
          <label>Título</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border placeholder="Título"
            v-model="book.title" />
        </div>

        <div class="vx-col sm:w-1/2 w-full mb-3">
          <label>SubTítulo</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border placeholder="SubTítulo"
            v-model="book.subtitle" />
        </div>
      </div>

      <div class="vx-row">
        <div class="vx-col sm:w-1/4 w-full">
          <label>Título</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border placeholder="Título"
            v-model="book.title" />
        </div>

        <div class="vx-col sm:w-1/4 w-full">
          <label>Título</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border placeholder="Título"
            v-model="book.title" />
        </div>

        <div class="vx-col sm:w-1/4 w-full">
          <label>Título</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border placeholder="Título"
            v-model="book.title" />
        </div>

        <div class="vx-col sm:w-1/4 w-full">
          <label>Título</label>
          <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border placeholder="Título"
            v-model="book.title" />
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
      book: {
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
          this.data.image = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    reset_data() {
       Object.assign(this.$data, this.$options.data())
    }
  }
}
</script>
