<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Case_;
use App\Models\CaseUpdate;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class CasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $cases = Case_::with(['client', 'lawyer'])->latest()->paginate(15);
        return view('admin.cases.index', compact('cases'));
    }

    public function create()
    {
        $clients = Client::all();
        $lawyers = User::where('role', 'محامي')->get();
        return view('admin.cases.create', compact('clients', 'lawyers'));
    }

    public function getLastCaseNumber()
    {
        $lastCase = Case_::orderBy('id', 'desc')->first();
        return response()->json([
            'last_number' => $lastCase ? $lastCase->case_number : null
        ]);
    }

    public function generateCaseNumber(Request $request)
    {
        try {
            $year = date('Y');
            $maxAttempts = 1000; // Limit attempts to prevent infinite loop
            
            // Get all case numbers for this year
            $cases = Case_::where('case_number', 'like', "CASE-{$year}-%")
                ->pluck('case_number')
                ->toArray();
            
            $nextNumber = 1;
            
            // Find the highest number for this year
            if (!empty($cases)) {
                $maxNumber = 0;
                foreach ($cases as $caseNumber) {
                    $parts = explode('-', $caseNumber);
                    if (count($parts) === 3 && $parts[0] === 'CASE' && $parts[1] == $year) {
                        $num = (int)$parts[2];
                        if ($num > $maxNumber) {
                            $maxNumber = $num;
                        }
                    }
                }
                $nextNumber = $maxNumber + 1;
            }
            
            // Generate unique case number
            $attempts = 0;
            do {
                $caseNumber = sprintf('CASE-%s-%03d', $year, $nextNumber);
                $exists = Case_::where('case_number', $caseNumber)->exists();
                
                if (!$exists) {
                    return response()->json([
                        'success' => true,
                        'case_number' => $caseNumber
                    ], 200);
                }
                
                $nextNumber++;
                $attempts++;
            } while ($attempts < $maxAttempts);
            
            // Fallback: use timestamp if all sequential numbers are taken
            $timestamp = time();
            $caseNumber = sprintf('CASE-%s-%s', $year, substr($timestamp, -6));
            
            // Ensure uniqueness even with timestamp
            $counter = 1;
            while (Case_::where('case_number', $caseNumber)->exists() && $counter < 100) {
                $caseNumber = sprintf('CASE-%s-%s-%d', $year, substr($timestamp, -6), $counter);
                $counter++;
            }
            
            return response()->json([
                'success' => true,
                'case_number' => $caseNumber
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error generating case number: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'error' => 'حدث خطأ أثناء توليد رقم القضية: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'case_number' => 'required|string|unique:cases,case_number',
            'client_id' => 'required|exists:clients,id',
            'lawyer_id' => 'nullable|exists:users,id',
            'court_name' => 'nullable|string|max:255',
            'status' => 'required|in:قيد المعالجة,قيد المحاكمة,منتهية,ملغاة',
            'description' => 'nullable|string',
        ]);

        Case_::create($validated);

        return redirect()->route('admin.cases.index')->with('success', 'تم إضافة القضية بنجاح.');
    }

    public function show(Case_ $case)
    {
        $case->load(['client', 'lawyer', 'updates', 'inquiries.client']);
        return view('admin.cases.show', compact('case'));
    }

    public function edit(Case_ $case)
    {
        $clients = Client::all();
        $lawyers = User::where('role', 'محامي')->get();
        return view('admin.cases.edit', compact('case', 'clients', 'lawyers'));
    }

    public function update(Request $request, Case_ $case)
    {
        $validated = $request->validate([
            'case_number' => 'required|string|unique:cases,case_number,' . $case->id,
            'client_id' => 'required|exists:clients,id',
            'lawyer_id' => 'nullable|exists:users,id',
            'court_name' => 'nullable|string|max:255',
            'status' => 'required|in:قيد المعالجة,قيد المحاكمة,منتهية,ملغاة',
            'description' => 'nullable|string',
        ]);

        $case->update($validated);

        return redirect()->route('admin.cases.index')->with('success', 'تم تحديث القضية بنجاح.');
    }

    public function destroy(Case_ $case)
    {
        $case->delete();
        return redirect()->route('admin.cases.index')->with('success', 'تم حذف القضية بنجاح.');
    }

    public function addUpdate(Request $request, Case_ $case)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
        ]);

        CaseUpdate::create([
            'case_id' => $case->id,
            'title' => $validated['title'],
            'detail' => $validated['detail'],
        ]);

        return redirect()->back()->with('success', 'تم إضافة التحديث بنجاح.');
    }
}

