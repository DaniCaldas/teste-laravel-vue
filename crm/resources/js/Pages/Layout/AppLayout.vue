<template>
  <div class="min-h-screen">
    <!-- Sidebar fixa -->
    <aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-200">
      <div class="px-4 py-5 text-slate-900 font-semibold text-lg">
        Minha Empresa
      </div>

      <nav class="px-2 space-y-1">
        <Link href="/dashboard" :class="linkClass('/dashboard')">
            <LayoutGrid :class="iconClass('/dashboard')" size="18" />
            <span>Início</span>
        </Link>

        <Link href="/colaboradores" :class="linkClass('/colaboradores')">
            <Users2 :class="iconClass('/colaboradores')" size="18" />
            <span>Colaboradores</span>
        </Link>
      </nav>

      <div class="absolute bottom-0 left-0 right-0 p-3">
        <Link
          @click="logout"
          as="button"
          class="w-full flex items-center justify-center gap-2 rounded-full bg-red-500 px-3 py-2 text-white hover:bg-red-600"
        >          
          <LogOut size="18" /> Sair
        </Link>
      </div>
    </aside>

    <!-- Conteúdo deslocado pela largura da sidebar -->
    <main class="ml-64 min-h-screen bg-gray-50 p-6">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { LayoutGrid, Users2, LogOut } from 'lucide-vue-next'
import { router } from '@inertiajs/vue3'

const logout = () => {
  router.post('/logoff')
}

const page = usePage()

// classes dos links
const linkClass = (path) => {
  return [
    "flex items-center gap-2 rounded-full px-3 py-2 transition font-medium",
    page.url.startsWith(path)
      ? "bg-blue-600 text-white"
      : "text-slate-700 hover:bg-slate-100"
  ]
}

// classes dos ícones
const iconClass = (path) => {
  return page.url.startsWith(path)
    ? "text-slate-900"
    : "text-slate-500"
}

</script>