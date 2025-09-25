<template>
  <div class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-40">
    <div class="p-6">
      <!-- Logo/Título da Empresa -->
      <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800">{{ companyName }}</h2>
      </div>
      
      <!-- Menu de Navegação -->
      <nav class="space-y-2">
        
      </nav>
    </div>
    
    <!-- Botão de Logout -->
    <div class="absolute bottom-6 left-6 right-6">
      <button 
        @click="logout" 
        class="w-full flex items-center justify-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors"
      >
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
        </svg>
        Sair
      </button>
    </div>
  </div>
</template>

<script>

export default {
  name: 'Sidebar',
  components: {
    
  },
  
  props: {
    companyName: {
      type: String,
      default: 'Minha Empresa'
    }
  },
  
  data() {
    return {
      menuItems: [
        {
          name: 'Início',
          route: 'dashboard',
          icon: 'dashboard'
        },
        {
          name: 'Colaboradores',
          route: 'colaboradores.index',
          icon: 'users'
        },
        {
          name: 'Relatórios',
          route: 'relatorios.index',
          icon: 'chart'
        },
        {
          name: 'Configurações',
          route: 'configuracoes.index',
          icon: 'settings'
        }
      ]
    }
  },
  
  methods: {
    isActiveRoute(routeName) {
      return this.$page.component.startsWith(this.getRouteComponent(routeName))
    },
    
    getRouteComponent(routeName) {
      const routeMap = {
        'dashboard': 'Dashboard',
        'colaboradores.index': 'Colaboradores',
        'relatorios.index': 'Relatorios',
        'configuracoes.index': 'Configuracoes'
      }
      return routeMap[routeName] || routeName
    },
    
  }
}
</script>