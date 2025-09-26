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
            <td class="px-4 py-3">{{ colab.name || colab.nome }}</td>
            <td class="px-4 py-3">{{ colab.phone || colab.telefone }}</td>
            <td class="px-4 py-3">{{ colab.email }}</td>
            <td class="px-4 py-3">{{ colab.created_at ? new Date(colab.created_at).toLocaleString('pt-BR') : colab.criadoEm }}</td>
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
            v-model="form.name"
            type="text"
            placeholder="Digite o nome"
            class="w-full border rounded-md px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
          />
          <p v-if="form.errors.name" class="text-red-600 text-sm mt-1">
            {{ Array.isArray(form.errors.name) ? form.errors.name[0] : form.errors.name }}
          </p>
        </div>

        <!-- Telefone -->
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Telefone</label>
          <input
            v-model="form.phone"
            type="text"
            placeholder="(11) 98765-4321"
            class="w-full border rounded-md px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
          />
          <p v-if="form.errors.phone" class="text-red-600 text-sm mt-1">
            {{ Array.isArray(form.errors.phone) ? form.errors.phone[0] : form.errors.phone }}
          </p>
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
          <p v-if="form.errors.email" class="text-red-600 text-sm mt-1">
            {{ Array.isArray(form.errors.email) ? form.errors.email[0] : form.errors.email }}
          </p>
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
            {{ editIndex !== null ? 'Atualizar' : 'Salvar' }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { useForm, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const openModal = ref(false);
const editIndex = ref(null);

const props = defineProps({
  employees: { type: Array, default: () => [] },
  flash: { type: Object, default: () => ({}) }
});

const colaboradores = ref(props.employees || []);

const refreshEmployees = () => {
  router.reload({ only: ['employees'] });
};

watch(
  () => props.employees,
  (emps) => {
    colaboradores.value = emps || [];
  },
  { immediate: true }
);

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

const form = useForm({
  name: "",
  phone: "",
  email: "",
});

const resetForm = () => {
  form.reset('name','phone','email');
  editIndex.value = null;
};

const closeModal = () => {
  openModal.value = false;
  resetForm();
};

const handleSave = async () => {
  if (!form.name || !form.phone || !form.email) {
    Toast.fire({ icon: 'error', title: 'Preencha todos os campos!' });
    return;
  }

  // Editar
  if (editIndex.value !== null) {
    const colab = colaboradores.value[editIndex.value];
    if (!colab || !colab.id) {
      Toast.fire({ icon: 'error', title: 'Registro inválido.' });
      return;
    }
    router.put(`/employees/${colab.id}`, {
      name: form.name,
      phone: form.phone,
      email: form.email,
    }, {
      preserveScroll: true,
      onSuccess: () => {
        Toast.fire({ icon: 'success', title: 'Colaborador atualizado com sucesso.' });
        closeModal();
        refreshEmployees();
      }
    });
    return;
  }

  // Verificar se o email ou mobile ja esta cadastrado
  colaboradores.value.map((colab) => {
    if (colab.email === form.email) {
      form.errors.email = 'O email ja esta cadastrado para esta empresa.';
      Toast.fire({ icon: 'error', title: 'Erro ao cadastrar colaborador.' });
      return;
    }
    if (colab.phone === form.phone) {
      form.errors.phone = 'O mobile ja esta cadastrado para esta empresa.';
      Toast.fire({ icon: 'error', title: 'Erro ao cadastrar colaborador.' });
      return;
    }
  });
  // Criar
  form.post('/employees', {
    preserveScroll: true,
    onSuccess: () => {
      Toast.fire({ icon: 'success', title: 'Colaborador criado com sucesso.' });
      closeModal();
      form.reset('name','phone','email');
      refreshEmployees();
    }
  });
};

const editarColaborador = (index) => {
  const colab = colaboradores.value[index];
  if (!colab) return;
  form.name = colab.name || colab.nome || '';
  form.phone = colab.phone || colab.telefone || '';
  form.email = colab.email || '';
  editIndex.value = index;
  openModal.value = true;
};

const removerColaborador = async (index) => {
  const colab = colaboradores.value[index];
  if (!colab || !colab.id) return;

  const res = await Swal.fire({
    title: 'Remover colaborador?',
    text: 'Esta ação não poderá ser desfeita.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sim, remover',
    cancelButtonText: 'Cancelar'
  });

  if (res.isConfirmed) {
    router.put(`/employees`, {
      id: colab.id,
      preserveScroll: true,
      onSuccess: () => {
        Toast.fire({ icon: 'success', title: 'Colaborador removido com sucesso.' });
        refreshEmployees();
      }
    });
    router.reload();
    document.location.reload();
  }
};

</script>
