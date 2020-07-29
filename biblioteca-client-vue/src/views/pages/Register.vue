<!-- =========================================================================================
    File Name: Register.vue
    Description: Register Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center">
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">
          <div class="vx-row no-gutter">
            <div class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center">
              <img src="@/assets/images/pages/register.png" alt="register" class="mx-auto">
            </div>
            <div class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center  d-theme-dark-bg">
              <div class="px-8 pt-8 register-tabs-container">
                <div class="vx-card__title mb-4">
                    <h4 class="mb-4">Criar Conta</h4>
                    <p>Preencha o formulário abaixo para criar uma nova conta.</p>
                </div>

                <div>
                  <div class="clearfix">
                    <vs-input
                      label-placeholder="Nome"
                      name="name"
                      placeholder="Nome"
                      v-model="form.name"
                      class="w-full" />

                    <vs-input
                      name="email"
                      type="email"
                      label-placeholder="Email"
                      placeholder="Email"
                      v-model="form.email"
                      class="w-full mt-6" />

                    <vs-input
                      ref="password"
                      type="password"
                      name="password"
                      label-placeholder="Senha"
                      placeholder="Senha"
                      v-model="form.password"
                      class="w-full mt-6" />

                    <vs-input
                      type="password"
                      name="confirm_password"
                      label-placeholder="Confirmar Senha"
                      placeholder="Confirmar Senha"
                      v-model="form.confirm_password"
                      class="w-full mt-6" />

                    <vs-checkbox v-model="form.isTermsConditionAccepted" class="mt-6">Eu aceito os termos e condições.</vs-checkbox>
                    <vs-button  type="border" to="/pages/login" class="mt-6">Entrar</vs-button>
                    <vs-button class="float-right mt-6">Registrar</vs-button>
                  </div>
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

export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          password: '',
          confirm_password: '',
          isTermsConditionAccepted: ''
        }
      }
    }
}
</script>

<style lang="scss">
.register-tabs-container {
  min-height: 517px;

  .con-tab {
    padding-bottom: 23px;
  }
}
</style>
