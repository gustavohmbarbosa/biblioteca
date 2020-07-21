<template>
  <div class="clearfix">
    <vs-input
      label-placeholder="Nome"
      name="name"
      placeholder="Nome"
      v-model="name"
      class="w-full" />

    <vs-input
      name="email"
      type="email"
      label-placeholder="Email"
      placeholder="Email"
      v-model="email"
      class="w-full mt-6" />

    <vs-input
      ref="password"
      type="password"
      name="password"
      label-placeholder="Senha"
      placeholder="Senha"
      v-model="password"
      class="w-full mt-6" />

    <vs-input
      type="password"
      name="confirm_password"
      label-placeholder="Confirmar Senha"
      placeholder="Confirmar Senha"
      v-model="confirm_password"
      class="w-full mt-6" />

    <vs-checkbox v-model="isTermsConditionAccepted" class="mt-6">Eu aceito os termos e condições.</vs-checkbox>
    <vs-button  type="border" to="/pages/login" class="mt-6">Entrar</vs-button>
    <vs-button class="float-right mt-6">Registrar</vs-button>
  </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            confirm_password: '',
            isTermsConditionAccepted: true
        }
    }
}
</script>
