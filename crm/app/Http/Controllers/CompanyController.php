<?php

namespace App\Http\Controllers;

use App\Models\Company;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use LDAP\Result;

class CompanyController extends Controller
{
    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'name_fantasy' => 'required',
                'cnpj' => 'required',
                'password' => 'required'
            ]);
            $cnpj = preg_replace('/\D/', '', $request->cnpj);
            if (Company::where('cnpj', $cnpj)->exists()) {
                return redirect()->back()->with(['error' => 'CNPJ já cadastrado']);
            }else{    
                $company = new Company();
                $company->name = $request->name;
                $company->name_fantasy = $request->name_fantasy;
                $company->cnpj = preg_replace('/\D/', '', $request->cnpj);
                $company->password = $request->password;
                $company->save();
                return redirect()->route('index')->with(['success' => 'Empresa cadastrada com sucesso']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}
