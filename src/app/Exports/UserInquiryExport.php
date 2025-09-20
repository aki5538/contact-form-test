<?php

namespace App\Exports;


use App\Models\UserInquiry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserInquiryExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = UserInquiry::with('category');

        if ($this->request->filled('name')) {
            $query->where('name', 'like', '%' . $this->request->name . '%');
        }

        if ($this->request->filled('email')) {
            $query->where('email', 'like', '%' . $this->request->email . '%');
        }

        if ($this->request->gender && $this->request->gender !== 'all') {
            $query->where('gender', $this->request->gender);
        }

        if ($this->request->filled('category_id')) {
            $query->where('category_id', $this->request->category_id);
        }

        if ($this->request->filled('date')) {
            $query->whereDate('created_at', $this->request->date);
        }

        $inquiries = $query->get();

        return view('admin.export', compact('inquiries'));
    }
}