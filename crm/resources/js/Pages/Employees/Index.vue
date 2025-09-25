<template>
  <div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-xl font-semibold">Colaboradores</h1>
      <button
        @click="openModal = true"
        class="bg-blue-600 text-white px-5 py-2 rounded-full font-medium hover:bg-blue-700 transition"
      >
        Cadastrar colaborador +
      </button>
    </div>

    <!-- Tabela -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
      <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 text-sm font-medium">
          <tr>
            <th class="px-4 py-3">Nome</th>
            <th class="px-4 py-3">Telefone</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Criado em</th>
            <th class="px-4 py-3">Editar</th>
            <th class="px-4 py-3">Remover</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(colab, index) in colaboradores"
            :key="index"
            class="border-t hover:bg-gray-50"
          >
            <td class="px-4 py-3">{{ colab.nome }}</td>
            <td class="px-4 py-3">{{ colab.telefone }}</td>
            <td class="px-4 py-3">{{ colab.email }}</td>
            <td class="px-4 py-3">{{ colab.criadoEm }}</td>
            <td class="px-4 py-3">
              <button
                @click="editarColaborador(index)"
                class="bg-gray-200 text-gray-700 px-3 py-1 rounded-md hover:bg-gray-300"
              >
                ✏️
              </button>
            </td>
            <td class="px-4 py-3">
              <button
                @click="removerColaborador(index)"
                class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600"
              >
                🗑️
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <div
      v-if="openModal"
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    >
      <div class="bg-white rounded-2xl w-full max-w-md shadow-lg p-6">
        <h2 class="text-lg font-semibold mb-4">
          {{ editIndex !== null ? "Editar colaborador" : "Cadastrar colaborador" }}
        </h2>

        <!-- Nome -->
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Nome</label>
          <input
            v-model="form.nome"
            type="text"
            placeholder="Digite o nome"
            class="w-full border rounded-md px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <!-- Telefone -->
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Telefone</label>
          <input
            v-model="form.telefone"
            type="text"
            placeholder="(11) 98765-4321"
            class="w-full border rounded-md px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <!-- Email -->
        <div class="mb-6">
          <label class="block text-sm font-medium mb-1">Email</label>
          <input
            v-model="form.email"
            type="email"
            placeholder="email@teste.com"
            class="w-full border rounded-md px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <!-- Ações -->
        <div class="flex justify-end space-x-3">
          <button
            @click="closeModal"
            class="px-4 py-2 rounded-md border hover:bg-gray-100 transition"
          >
            Cancelar
          </button>
          <button
            @click="handleSave"
            class="px-6 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition"
          >
            Salvar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const openModal = ref(false);
const editIndex = ref(null);

const colaboradores = ref([
  {
    nome: "Fulano de Tal",
    telefone: "(11) 91234-5678",
    email: "fulano@teste.com",
    criadoEm: new Date().toLocaleString("pt-BR"),
  },
]);

const form = ref({
  nome: "",
  telefone: "",
  email: "",
});

const resetForm = () => {
  form.value = { nome: "", telefone: "", email: "" };
  editIndex.value = null;
};

const closeModal = () => {
  openModal.value = false;
  resetForm();
};

const handleSave = () => {
  if (!form.value.nome || !form.value.telefone || !form.value.email) {
    alert("Preencha todos os campos!");
    return;
  }

  const colaborador = {
    ...form.value,
    criadoEm: new Date().toLocaleString("pt-BR"),
  };

  if (editIndex.value !== null) {
    colaboradores.value[editIndex.value] = colaborador;
  } else {
    colaboradores.value.push(colaborador);
  }

  closeModal();
};

const editarColaborador = (index) => {
  const colab = colaboradores.value[index];
  form.value = { nome: colab.nome, telefone: colab.telefone, email: colab.email };
  editIndex.value = index;
  openModal.value = true;
};

const removerColaborador = (index) => {
  if (confirm("Deseja remover este colaborador?")) {
    colaboradores.value.splice(index, 1);
  }
};
</script>
