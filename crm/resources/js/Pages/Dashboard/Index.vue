<template>
  <div>
    <h1 class="text-xl font-semibold text-slate-900 mb-1">
      Dashboard de colaboradores
    </h1>
    <p class="text-slate-600 mb-6">
      Acompanhe os números da sua empresa
    </p>

    <!-- Grid de Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Card Contratados -->
      <div class="bg-slate-100 rounded-xl shadow-sm p-4 flex flex-col justify-between">
        <div>
          <h2 class="text-slate-700 font-semibold mb-2">
            Colaboradores contratados
          </h2>
          <p class="text-3xl font-bold text-slate-900">2</p>
        </div>
        <span
          class="self-end mt-4 inline-flex items-center rounded-full bg-emerald-200 px-3 py-1 text-xs font-medium text-emerald-800"
        >
          Este mês
        </span>
      </div>

      <!-- Card Demitidos -->
      <div class="bg-slate-100 rounded-xl shadow-sm p-4 flex flex-col justify-between">
        <div>
          <h2 class="text-slate-700 font-semibold mb-2">
            Colaboradores demitidos
          </h2>
          <p class="text-3xl font-bold text-slate-900">1</p>
        </div>
        <span
          class="self-end mt-4 inline-flex items-center rounded-full bg-emerald-200 px-3 py-1 text-xs font-medium text-emerald-800"
        >
          Este mês
        </span>
      </div>

      <!-- Card Total -->
      <div class="bg-slate-100 rounded-xl shadow-sm p-4 flex flex-col justify-between">
        <div>
          <h2 class="text-slate-700 font-semibold mb-2">
            Total de Colaboradores
          </h2>
          <p class="text-3xl font-bold text-slate-900">1</p>
        </div>
      </div>
    </div>
  </div>
</template>