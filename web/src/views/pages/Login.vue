<template>
  <div
    class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center"
    id="page-login"
  >
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">
          <div class="vx-row no-gutter justify-center items-center">
            <div class="vx-col hidden lg:block lg:w-1/2">
              <img
                src="@/assets/images/pages/login.png"
                alt="login"
                class="mx-auto"
              />
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
                    v-model="user.email"
                    class="w-full"
                  />

                  <vs-input
                    type="password"
                    name="password"
                    icon-no-border
                    icon="icon icon-lock"
                    icon-pack="feather"
                    label-placeholder="Senha"
                    v-model="user.password"
                    class="w-full mt-6"
                  />

                  <div class="flex flex-wrap justify-between my-5">
                    <router-link to="">Esqueceu sua senha?</router-link>
                  </div>
                  <vs-button type="border" to="/pages/register"
                    >Criar Conta</vs-button
                  >
                  <vs-button class="float-right" @click.prevent="login()"
                    >Entrar</vs-button
                  >
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
      user: {
        email: "beltrao.laura@example.com",
        password: "12345678"
      }
    };
  },
  methods: {
    async login() {
      try {
        this.$vs.loading();

        const data = await this.$store.dispatch("auth/login", this.user);

        this.$vs.loading.close();

        this.showLoginSuccess(data.message);

        this.$router.push({ name: "admin-home" }); // $this.store.state.routeThatWillBeAccessed
      } catch (error) {
        console.log(error);
        this.$vs.loading.close();

        this.showLoginFailed("Erro ao realizar o login!");
      }
    },
    showLoginSuccess(message) {
      this.$vs.notify({
        title: "Sucesso!",
        text: message,
        iconPack: "feather",
        icon: "icon-check",
        color: "success"
      });
    },
    showLoginFailed(message) {
      this.$vs.notify({
        title: "Erro!",
        text: message,
        iconPack: "feather",
        icon: "icon-alert-circle",
        color: "danger"
      });
    }
  }
};
</script>
