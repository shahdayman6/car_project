<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // عرض صفحة الفورم لإضافة شكوى جديدة
    public function create()
    {
        return view('complaints.create');
    }

    // حفظ الشكوى في قاعدة البيانات
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit a complaint.');
        }

        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        Complaint::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Your complaint has been submitted successfully.');
    }

    // عرض كل الشكاوى (صفحة الادمن فقط)
    public function index()
{
    // تحقق هل المستخدم مسجل دخول وهل هو أدمن
    if (!auth()->check() || !auth()->user()->is_admin) {
        return redirect()->route('complaints.create')->with('error', 'Access denied.');
    }

    $complaints = Complaint::with('user')->latest()->paginate(20);
    return view('complaints.index', compact('complaints'));
}


    // دالة توجيه حسب دور المستخدم (is_admin)
    public function redirectBasedOnRole()
    {
        if (auth()->check()) {
            if (auth()->user()->is_admin) {
                // لو الادمن، اوديه لصفحة الشكاوى
                return redirect()->route('complaints.index');
            } else {
                // لو مش ادمن، اوديه لصفحة المستخدم العادي (غيري الاسم حسب اللي عندك)
                return redirect()->route('complaints.create');
            }
        }

        return redirect()->route('login');
    }
}
