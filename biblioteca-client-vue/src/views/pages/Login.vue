<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center" id="page-login">
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">

          <div class="vx-row no-gutter justify-center items-center">

            <div class="vx-col hidden lg:block lg:w-1/2">
              <img src="@/assets/images/pages/login.png" alt="login" class="mx-auto">
            </div>

            <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
              <div class="p-8 login-tabs-container">

                <div class="vx-card__title mb-4">
                  <h4 class="mb-4">Login</h4>
                  <p>Bem vindo de volta, por favor entre na sua conta.</p>
                </div>

                <div>
                  <vs-input
                      name="email"
                      icon-no-border
                      icon="icon icon-user"
                      icon-pack="feather"
                      label-placeholder="Email"
                      v-model="form.email"
                      class="w-full"/>

                  <vs-input
                      type="password"
                      name="password"
                      icon-no-border
                      icon="icon icon-lock"
                      icon-pack="feather"
                      label-placeholder="Senha"
                      v-model="form.password"
                      class="w-full mt-6" />

                  <div class="flex flex-wrap justify-between my-5">
                      <router-link to="">Esqueceu sua senha?</router-link>
                  </div>
                  <vs-button type="border" to="/pages/register">Criar Conta</vs-button>
                  <vs-button class="float-right" @click.prevent="submit()">Entrar</vs-button>
                </div>

              </div>
            </div>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</template>

<script>

export default{
  data() {
    return {
      form: {
        email: "stamm.abbie@example.org",
        password: "password",
      },
    }
  },
  methods: {

    submit() {

      // Loading
      this.$vs.loading()

      this.$store.dispatch('auth/doLogin', this.form).then(res => {
        // Close Loading
        this.$vs.loading.close()

        console.log(res)
        this.$router.push('/')
      }).catch(err => {
        console.log(err)

        // Close Loading
        this.$vs.loading.close()
        this.$vs.notify({
          title: 'Error',
          text: 'Não foi possível realizar o login.',
          iconPack: 'feather',
          icon: 'icon-alert-circle',
          color: 'danger'
        })
      })
    }

  }
}
</script>
