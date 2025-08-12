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
        // تحقق من تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit a complaint.');
        }

        // التحقق من صحة البيانات
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // حفظ الشكوى مع ربطها بالمستخدم الحالي
        Complaint::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Your complaint has been submitted successfully.');
    }

    // عرض كل الشكاوى (صفحة الادمن فقط)
    public function index()
    {
        // ممكن تضيف تحقق من صلاحية الادمن هنا
        $complaints = Complaint::with('user')->latest()->paginate(20);
        return view('complaints.index', compact('complaints'));
    }
}


