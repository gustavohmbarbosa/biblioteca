<!-- =========================================================================================
  File Name: UserEdit.vue
  Description: User Edit Page
  ----------------------------------------------------------------------------------------

========================================================================================== -->

<template>
  <div id="page-user-edit">

    <vs-alert color="danger" title="Usuário Não Encontrado" :active.sync="user_not_found">
      <span>Registro de usuário com id: {{ $route.params.userId }} não encontrado. </span>
      <span>
        <span>Verificar </span>
        <router-link :to="{name:'page-user-list'}" class="text-inherit underline">Todos Os Usuários</router-link>
      </span>
    </vs-alert>

    <vx-card v-if="user_data">

      <div slot="no-body" class="tabs-container px-6 pt-6">

        <vs-tabs v-model="activeTab" class="tab-action-btn-fill-conatiner">
          <vs-tab label="Conta" icon-pack="feather" icon="icon-user">
            <div class="tab-text">
              <user-edit-tab-account class="mt-4" :data="user_data" />
            </div>
          </vs-tab>
          <vs-tab label="Senha" icon-pack="feather" icon="icon-lock">
            <div class="tab-text">
              <user-edit-tab-password class="mt-4" :data="user_data" />
            </div>
          </vs-tab>
        </vs-tabs>

      </div>

    </vx-card>
  </div>
</template>

<script>
import UserEditTabAccount     from "./UserEditTabAccount.vue"
import UserEditTabPassword from "./UserEditTabPassword.vue"

// Store Module
import moduleUserManagement from '@/store/admin/user/moduleUserManagement.js'

export default {
  components: {
    UserEditTabAccount,
    UserEditTabPassword,
  },
  data() {
    return {
      user_data: 
        {
          "id": 1,
          "image": require("@/assets/images/portrait/small/avatar-s-3.jpg"),
          "name": "Angelo Sashington",
          "email": "angelo@sashington.com",
          "role": "admin",
          "status": "active",
        },
      user_not_found: false,

      /*
        This property is created for fetching latest data from API when tab is changed

        Please check it's watcher
      */
      activeTab: 0,
    }
  },
  watch: {
    activeTab() {
      this.fetch_user_data(this.$route.params.userId)
    }
  },
  methods: {
    fetch_user_data(userId) {
      this.$store.dispatch("userManagement/fetchUser", userId)
        .then(res => { this.user_data = res.data })
        .catch(err => {
          if(err.response.status === 404) {
            this.user_not_found = true
            return
          }
          console.error(err) })
    }
  },
  created() {
    // Register Module UserManagement Module
    if(!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
    }
    this.fetch_user_data(this.$route.params.userId)
  }
}

</script>
