<template>
    <div class="vx-col w-full mb-base">
			<vx-card title="Cadastrar Usuário">

        <div class="vx-row">
          <div class="vx-col mb-2" vs-w="6">
            <div class="vx-row">
              <div class="vx-col sm:w-1/2 w-full mb-3">
                <vs-input class="w-full" icon="person" label-placeholder="Nome" v-model="user.name" />
              </div>
              <div class="vx-col sm:w-1/2 w-full mb-3">
                <vs-input class="w-full" icon="email" label-placeholder="Email" v-model="user.email" />
              </div>
            </div>
            <div class="vx-row">
              <div class="vx-col sm:w-1/2 w-full mb-3">
                <vs-input type="password" class="w-full" icon="lock" label-placeholder="Senha" v-model="user.password" />
              </div>
              <div class="vx-col sm:w-1/2 w-full mb-3">
                <vs-input type="password" class="w-full" icon="lock" label-placeholder="Confirmar Senha" v-model="user.passwordConfirm" />
              </div>
            </div>
            <div class="vx-row">
              <div class="vx-col w-full mb-3">
                <h6 class="mb-3">Nível de Acesso</h6>
                <v-select :options="['Master','Comum']" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="user.role"/>
              </div>
            </div>
          </div>

          <div class="vx-col m-auto" vs-w="6" vs-justify="center" vs-align="center">
            <div class="centerx">
              <vs-upload action=""/>
            </div>
          </div>
        </div>

				<div class="vx-row">
					<div class="vx-col w-full">
						<vs-button class="mr-3 mb-2">Criar</vs-button>
						<vs-button color="danger" type="border" class="mb-2">Voltar</vs-button>
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
      user: {
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
  }
}
</script>
