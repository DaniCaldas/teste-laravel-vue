<template>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="flex w-full max-w-6xl h-[800px] bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="flex-1 flex flex-col justify-center px-12 py-12">
        <div class="max-w-md mx-auto w-full">
          <h1 class="text-3xl font-semibold text-gray-800 text-center mb-2">
            Registre sua empresa
          </h1>
          <p class="text-gray-600 text-center mb-8 leading-relaxed">
            Cadastre-se para gerenciar seus colaboradores com eficiência e segurança
          </p>

          <form @submit.prevent="submit" class="space-y-5">
            <div>
              <label for="cnpj" class="block text-sm font-semibold text-gray-700 mb-2">
                CNPJ
              </label>
              <input
                id="cnpj"
                type="text"
                v-model="form.cnpj"
                @input="applyCnpjMask"
                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-3 focus:ring-blue-100 transition-all duration-300"
                placeholder="00.000.000/0000-00"
                maxlength="18"
                required
                :class="{ 'border-red-300 focus:border-red-500': form.errors.cnpj }"
              />
              <div v-if="form.errors.cnpj" class="text-red-500 text-sm mt-1">
                {{ form.errors.cnpj }}
              </div>
            </div>

            <!-- Campo Senha -->
            <div>
              <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                Senha
              </label>
              <input
                id="password"
                type="password"
                v-model="form.password"
                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-3 focus:ring-blue-100 transition-all duration-300"
                placeholder="••••••••"
                required
                :class="{ 'border-red-300 focus:border-red-500': form.errors.password }"
              />
              <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
                {{ form.errors.password }}
              </div>
            </div>

            <!-- Campo Confirmar Senha -->
            <div>
              <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                Confirmar Senha
              </label>
              <input
                id="password_confirmation"
                type="password"
                v-model="form.password_confirmation"
                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-3 focus:ring-blue-100 transition-all duration-300"
                placeholder="••••••••"
                required
                :class="{ 'border-red-300 focus:border-red-500': form.errors.password_confirmation }"
              />
              <div v-if="form.errors.password_confirmation" class="text-red-500 text-sm mt-1">
                {{ form.errors.password_confirmation }}
              </div>
            </div>

            <!-- Campo Nome Fantasia -->
            <div>
              <label for="company_name" class="block text-sm font-semibold text-gray-700 mb-2">
                Nome Fantasia
              </label>
              <input
                id="company_name"
                type="text"
                v-model="form.name"
                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-3 focus:ring-blue-100 transition-all duration-300"
                placeholder="Ex.: Minha Empresa"
                required
                :class="{ 'border-red-300 focus:border-red-500': form.errors.name }"
              />
              <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                {{ form.errors.name }}
              </div>
            </div>

            <!-- Campo Razão Social -->
            <div>
              <label for="legal_name" class="block text-sm font-semibold text-gray-700 mb-2">
                Razão Social
              </label>
              <input
                id="legal_name"
                type="text"
                v-model="form.name_fantasy"
                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-3 focus:ring-blue-100 transition-all duration-300"
                placeholder="Ex.: Minha Empresa LTDA"
                required
                :class="{ 'border-red-300 focus:border-red-500': form.errors.name_fantasy }"
              />
              <div v-if="form.errors.name_fantasy" class="text-red-500 text-sm mt-1">
                {{ form.errors.name_fantasy }}
              </div>
            </div>

            <!-- Botão de Registro -->
            <button
              type="submit"
              :disabled="form.processing"
              class="w-full py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none mt-6"
            >
              {{ form.processing ? 'Registrando...' : 'Registrar' }}
            </button>
          </form>

          <!-- Link para Login -->
          <div class="text-center mt-6">
            <Link 
              href="/login" 
              class="inline-block px-6 py-2 text-blue-600 font-semibold border-2 border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 transform hover:-translate-y-0.5"
            >
              Voltar para login
            </Link>
          </div>
        </div>
      </div>

      <!-- Seção Promocional CRM -->
      <div class="flex-1 bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 text-white flex flex-col justify-center px-12 py-16 relative overflow-hidden">
        <!-- Elemento decorativo de fundo -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-5 rounded-full transform translate-x-32 -translate-y-32"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full transform -translate-x-16 translate-y-16"></div>
        
        <div class="relative z-10">
          <h2 class="text-5xl font-bold mb-4 text-shadow-lg">CRM</h2>
          <h3 class="text-2xl font-semibold mb-6 opacity-90">Laravel+Inertia+Vue</h3>
          <p class="text-xl mb-5 opacity-80 leading-relaxed">
            Organize seus colaboradores e otimize operações com praticidade.
          </p>
          <p class="text-lg opacity-75 leading-relaxed">
            Tudo em um só lugar, com alto desempenho e segurança para o seu negócio.
          </p>
        </div>
      </div>
    </div>

    <!-- Versão Mobile -->
    <div class="lg:hidden fixed inset-0 bg-gray-50 flex flex-col">
      <!-- Header Mobile -->
      <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-8 text-center">
        <h2 class="text-3xl font-bold mb-2">CRM</h2>
        <h3 class="text-lg font-medium opacity-90">Laravel+Inertia+Vue</h3>
      </div>

      <!-- Form Mobile -->
      <div class="flex-1 px-6 py-6 overflow-y-auto">
        <div class="max-w-sm mx-auto w-full">
          <h1 class="text-2xl font-semibold text-gray-800 text-center mb-2">
            Registre sua empresa
          </h1>
          <p class="text-gray-600 text-center mb-6 text-sm">
            Cadastre-se para gerenciar seus colaboradores com eficiência e segurança
          </p>

          <form @submit.prevent="submit" class="space-y-4">
            <div>
              <label for="cnpj-mobile" class="block text-sm font-semibold text-gray-700 mb-2">
                CNPJ
              </label>
              <input
                id="cnpj-mobile"
                type="text"
                v-model="form.cnpj"
                @input="applyCnpjMask"
                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"
                placeholder="00.000.000/0000-00"
                maxlength="18"
                required
              />
            </div>

            <div>
              <label for="password-mobile" class="block text-sm font-semibold text-gray-700 mb-2">
                Senha
              </label>
              <input
                id="password-mobile"
                type="password"
                v-model="form.password"
                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"
                placeholder="••••••••"
                required
              />
            </div>

            <div>
              <label for="password-confirmation-mobile" class="block text-sm font-semibold text-gray-700 mb-2">
                Confirmar Senha
              </label>
              <input
                id="password-confirmation-mobile"
                type="password"
                v-model="form.password_confirmation"
                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"
                placeholder="••••••••"
                required
              />
            </div>

            <div>
              <label for="company-name-mobile" class="block text-sm font-semibold text-gray-700 mb-2">
                Nome Fantasia
              </label>
              <input
                id="company-name-mobile"
                type="text"
                v-model="form.name_fantasy"
                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"
                placeholder="Ex.: Minha Empresa"
                required
              />
            </div>

            <div>
              <label for="legal-name-mobile" class="block text-sm font-semibold text-gray-700 mb-2">
                Razão Social
              </label>
              <input
                id="legal-name-mobile"
                type="text"
                v-model="form.name"
                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"
                placeholder="Ex.: Minha Empresa LTDA"
                required
              />
            </div>

            <button
              type="submit"
              :disabled="form.processing"
              class="w-full py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg transition-all duration-300 disabled:opacity-50 mt-6"
            >
              {{ form.processing ? 'Registrando...' : 'Registrar' }}
            </button>
          </form>

          <div class="text-center mt-6">
            <Link 
              href="/" 
              class="inline-block px-4 py-2 text-blue-600 font-medium border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-all"
            >
              Voltar para login
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import { watch } from 'vue'
import Swal from 'sweetalert2'

// Reactive form usando Inertia
const form = useForm({
  cnpj: '',
  password: '',
  password_confirmation: '',
  name: '',
  name_fantasy: '',
})

// Função para aplicar máscara no CNPJ
const applyCnpjMask = (event) => {
  let value = event.target.value.replace(/\D/g, '')
  
  if (value.length <= 14) {
    // Aplica a máscara progressivamente
    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, '$1.$2.$3/$4-$5')
    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{1})$/, '$1.$2.$3/$4-$5')
    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})$/, '$1.$2.$3/$4')
    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{1,4})$/, '$1.$2.$3/$4')
    value = value.replace(/^(\d{2})(\d{3})(\d{1,3})$/, '$1.$2.$3')
    value = value.replace(/^(\d{2})(\d{1,3})$/, '$1.$2')
  }
  
  form.cnpj = value
}

const page = usePage()

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});

const submit = () => {
  if (form.password !== form.password_confirmation) {
    Toast.fire({
      icon: 'error',
      title: 'Senhas não conferem!'
    })
  }
  else{
    form.post('/register', {
      onFinish: () => {
        Toast.fire({
          icon: 'success',
          title: 'Registrado com sucesso!'
        })
        form.reset('password', 'password_confirmation')
      },
    })
  }
}

watch(
  () => page.props.flash || {},
  (flash) => {
    if (flash.success) {
      Toast.fire({
        icon: 'success',
        title: flash.success
      })
    }
    if (flash.error) {
      Toast.fire({
        icon: 'error',
        title: flash.error
      })
    }
  },
  { immediate: true }
)

</script>

<style scoped>
.text-shadow-lg {
  text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Hide mobile version on desktop */
@media (min-width: 1024px) {
  .lg\:hidden {
    display: none !important;
  }
}

/* Hide desktop version on mobile */
@media (max-width: 1023px) {
  .min-h-screen.bg-gray-50.flex.items-center.justify-center.p-4 > .flex.w-full.max-w-6xl {
    display: none;
  }
}
</style>