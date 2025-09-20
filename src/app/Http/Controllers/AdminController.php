<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInquiry;
use App\Models\Category;
use App\Exports\UserInquiryExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = UserInquiry::with('category');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->gender && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(10);
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function export(Request $request)
    {
        return Excel::download(new UserInquiryExport($request), 'inquiries.xlsx');
    }

    public function destroy($id)
    {
        $inquiry = UserInquiry::findOrFail($id);
        $inquiry->delete();

        return redirect()->route('admin.index')->with('success', 'お問い合わせを削除しました');
    }
}