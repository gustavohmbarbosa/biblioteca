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
                      v-validate="'required'"
                      class="w-full"/>
                  <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>

                  <vs-input
                      type="password"
                      name="password"
                      icon-no-border
                      icon="icon icon-lock"
                      icon-pack="feather"
                      label-placeholder="Senha"
                      v-model="form.password"
                      v-validate="'required'"
                      class="w-full mt-6" />
                  <span class="text-danger text-sm" v-show="errors.has('password')">{{ errors.first('password') }}</span>

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
// For custom error message
import { Validator } from 'vee-validate';
const dict = {
  custom: {
    email: {
      required: 'Este campo é obrigatório.'
    },
    password: {
      required: 'Este campo é obrigatório.'
    },
  }
};

// register custom messages
Validator.localize('ptBR', dict);

export default{
  data() {
    return {
      form: {
        email: "bauch.vito@example.org",
        password: "password",
      },
    }
  },
  methods: {

    submit() {

      // Validating
      this.$validator.validateAll().then(result => {
        if(!result) {
          this.$vs.notify({
            title: 'Aviso!',
            text: 'Verifique os campos e os preencha corretamente',
            iconPack: 'feather',
            icon: 'icon-alert-circle',
            color: 'warning'
          })
          return;
        }
      })

      // Loading
      this.$vs.loading()

      this.$store.dispatch('auth/doLogin', this.form).then(res => {
        // Close Loading
        this.$vs.loading.close()
        this.showSignInSuccess(res.data.message)
        this.$router.push({ name: 'admin-home' }) // $this.store.state.routeThatWillBeAccessed
      }).catch(() => {
        // Close Loading
        this.$vs.loading.close()
        this.showSignInFailed('Erro ao realizar o login!')
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
    },
    showSignInFailed(message) {
      this.$vs.notify({
          title: 'Erro!',
          text: message,
          iconPack: 'feather',
          icon: 'icon-alert-circle',
          color: 'danger'
        })
    },
  }
}
</script>
