<!-- =========================================================================================
  File Name: UserEditTabInformation.vue
  Description: User Edit Information Tab content
  ----------------------------------------------------------------------------------------

========================================================================================== -->

<template>
  <div id="user-edit-tab-info">
    <div class="vx-row">
      <div class="vx-col sm:w-1/2 w-full mb-3">
        <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border
          label-placeholder="Nova Senha" v-model="data_local.password" />
      </div>
      <div class="vx-col sm:w-1/2 w-full mb-3">
        <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border
          label-placeholder="Confirmar Senha" v-model="data_local.passwordConfirm" />
      </div>
    </div>

    <!-- Save & Reset Button -->
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="mt-8 flex flex-wrap items-center justify-end">
          <vs-button class="ml-auto mt-2" @click="save_changes">Mudar Senha</vs-button>

          <vs-button type="border" color="danger" class=" ml-4 mt-2">
              <router-link :to="{ name: 'admin-user-view', params: { userId: this.data.id } }" class="text-inherit">Cancelar</router-link>
          </vs-button>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vSelect from 'vue-select'

export default {
  components: {
    vSelect,
  },
  props: {
    data: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {

      data_local: JSON.parse(JSON.stringify(this.data)),
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any()
    }
  },
  methods: {
    save_changes() {
      if(!this.validateForm) return

      // Here will go your API call for updating data
      // You can get data in "this.data_local"
    },
    cancel_changes() {
      return this.$router.push({ name: 'admin-user-view', params: { userId: this.data_local.id } })
    }
  },
}
</script>
