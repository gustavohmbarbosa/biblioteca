<template>
  <div class="the-navbar__user-meta flex items-center" v-if="activeUserInfo.name">

    <div class="text-right leading-tight hidden sm:block">
      <p class="font-semibold">{{ activeUserInfo.name }}</p>
      <small>{{ activeUserInfo.role }}</small>
    </div>

    <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">

      <div class="con-img ml-3">
        <vs-avatar :src="activeUserInfo.image" key="onlineImg" class="rounded-full shadow-md cursor-pointer block" size="40px"/>
      </div>

      <vs-dropdown-menu class="vx-navbar-dropdown">
        <ul style="min-width: 9rem">

          <li
            class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
            @click="$router.push('/perfil').catch(() => {})">
            <feather-icon icon="UserIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">Perfil</span>
          </li>

          <li
            class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
            @click="$router.push('/contas/editar').catch(() => {})">
            <feather-icon icon="SettingsIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">Configurações</span>
          </li>

          <vs-divider class="m-1" />

          <li
            class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
            @click="logout">
            <feather-icon icon="LogOutIcon" svgClasses="w-4 h-4" />
            <span class="ml-2" @click="logout()">Sair</span>
          </li>
        </ul>
      </vs-dropdown-menu>
    </vs-dropdown>
  </div>
</template>

<script>
export default {
  data() {
    return {

    }
  },
  computed: {
    activeUserInfo() {
      return this.$store.state.auth.user
    }
  },
  methods: {
    logout() {
      // This is just for demo Purpose. If user clicks on logout -> redirect
      // Loading
      this.$vs.loading()

      this.$store.dispatch('auth/signOut')
        .then(res => {
          this.$vs.loading.close()
          this.showSignInSuccess(res.data.message)
          this.$router.push('/pages/login').catch(() => {})
        })
    },
    showSignInSuccess(message) {
      this.$vs.notify({
          title: 'Sucesso!',
          text: message,
          iconPack: 'feather',
          icon: 'icon-check',
          color: 'success'
        })
    }
  }
}
</script>
