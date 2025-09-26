<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Company;
use App\Mail\RegisteredEmployeeMail;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->session()->get('company_id');
        $employees = Employees::where('company_id', $companyId)
            ->whereNull('deleted_at')
            ->orderByDesc('created_at')
            ->get(['id', 'name', 'email', 'phone', 'created_at']);

        return inertia('Employees/Index', [
            'employees' => $employees,
        ]);
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $companyId = $request->session()->get('company_id');

        $existingByEmail = Employees::where('email', $validated['email'])->whereNull('deleted_at')->first();
        if ($existingByEmail) {
            if ((int) $existingByEmail->company_id === (int) $companyId) {
                throw ValidationException::withMessages([
                    'email' => 'Colaborador já está cadastrado na sua empresa (email).',
                ]);
            }
            throw ValidationException::withMessages([
                'email' => 'Colaborador já está cadastrado em outra empresa (email).',
            ]);
        }

        $existingByPhone = Employees::where('phone', $validated['phone'])->whereNull('deleted_at')->first();
        if ($existingByPhone) {
            if ((int) $existingByPhone->company_id === (int) $companyId) {
                throw ValidationException::withMessages([
                    'phone' => 'Colaborador já está cadastrado na sua empresa (telefone).',
                ]);
            }
            throw ValidationException::withMessages([
                'phone' => 'Colaborador já está cadastrado em outra empresa (telefone).',
            ]);
        }

        $employee = Employees::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company_id' => $companyId,
        ]);

        // Enviar e-mail de boas-vindas
        try {
            $company = Company::find($companyId);
            // Permitir múltiplos destinatários via .env: MAIL_TO_ADDRESSES="a@ex.com,b@ex.com"
            $toListEnv = env('MAIL_TO_ADDRESSES');
            $recipients = [];
            if ($toListEnv) {
                $recipients = array_values(array_filter(array_map('trim', explode(',', $toListEnv))));
            }
            // Fallback: usa MAIL_FROM_ADDRESS se não houver lista própria
            if (empty($recipients)) {
                $fallback = config('mail.from.address');
                if ($fallback) $recipients = [$fallback];
            }

            if ($company && !empty($recipients)) {
                Mail::to($recipients)->send(new RegisteredEmployeeMail($employee, $company));
            } else {
                Log::warning('E-mail não enviado: company ou MAIL_FROM_ADDRESS ausentes', [
                    'company_id' => $companyId,
                    'recipients' => $recipients,
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('Erro ao enviar e-mail de colaborador registrado', [
                'employee_id' => $employee->id ?? null,
                'message' => $e->getMessage(),
            ]);
            // Não bloquear o fluxo em caso de falha no envio de e-mail
        }

        return redirect()->back()->with(['success' => 'Colaborador criado com sucesso' . (session('error') ? '' : ' e e-mail enviado.')]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $employee = Employees::findOrFail($id);
        $employee->update($validated);

        return redirect()->back()->with(['success' => 'Colaborador atualizado com sucesso.']);
    }

    public function destroy(Request $request)
    {
        $employee = Employees::findOrFail($request->id);
        $employee->deleted_at = now()->toDateTimeString();
        $employee->save();

        return redirect()->back()->with(['success' => 'Colaborador removido com sucesso.']);
    }
}



