<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Module;
use Illuminate\Http\Request;

class CompanyModuleController extends Controller
{
    public function assignModulesToCompany(Request $request, $companyId)
    {
        $request->validate([
            'module_ids' => 'required|array',
            'module_ids.*' => 'exists:modules,id'
        ]);

        $company = Company::findOrFail($companyId);
        $company->modules()->sync($request->module_ids);

        return response()->json(['message' => 'Modules assigned successfully']);
    }

    public function getCompanyModules($companyId)
    {
        $company = Company::with('modules')->findOrFail($companyId);

        return response()->json($company->modules);
    }
}
