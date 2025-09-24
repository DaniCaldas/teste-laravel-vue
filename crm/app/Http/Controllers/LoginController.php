<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'cnpj' => 'required',
            'password' => 'required'
        ]);
        $cnpj = preg_replace('/\D/', '', $request->cnpj);
        $company = Company::where('cnpj', $cnpj)->first();
        if (!$company) {
            return redirect()->back()->with(['error' => 'CNPJ não encontrado'], 404);
        }

        if (!Hash::check($request->password, $company->password)) {
            return redirect()->back()->with(['error' => 'Senha incorreta'], 404);
        }
        
        $request->session()->put('company_id', $company->id);
        $request->session()->put('company_name', $company->name_fantasy);

        return redirect()->route('dashboard')->with(['success' => 'Logado com sucesso']);
    }
}
