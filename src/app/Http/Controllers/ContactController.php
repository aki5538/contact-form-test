<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Response;

class ContactController extends Controller
{

    // 入力画面表示
    public function create()
    {
        $categories = Category::all();
        return view('contact.create', compact('categories'));
    }

    // 確認画面表示
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
        $inputs['gender_label'] = match((int)$inputs['gender']) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
            default => '未設定',
        };
        $category = Category::find($inputs['category_id']);
        $request->session()->put('inputs', $inputs);

        return view('contact.confirm', compact('inputs', 'category'));
    }

    // データ保存 → サンクスページへ
    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender' => 'required',
            'email' => 'required|email',
            'tel1' => 'required|digits_between:2,4',
            'tel2' => 'required|digits_between:2,4',
            'tel3' => 'required|digits_between:2,4',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'category_id' => 'required|integer',
            'detail' => 'required|string',
        ]);

        $validated['tel'] = $validated['tel1'] . '-' . $validated['tel2'] . '-' . $validated['tel3'];
        Contact::create($validated);

        return redirect()->route('contact.thanks');
    }

    // サンクスページ表示
    public function thanks()
    {
        return view('contact.thanks');
    }

    // 管理画面（一覧表示＋検索）
    public function index(Request $request)
    {

        $query = Contact::query();

    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function ($q) use ($keyword) {
            $q->where('last_name', 'like', "%{$keyword}%")
              ->orWhere('first_name', 'like', "%{$keyword}%")
              ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"])
              ->orWhere('email', 'like', "%{$keyword}%");
        });
    }

    if ($request->filled('email')) {
        $query->where('email', 'like', "%{$request->email}%");
    }

    if ($request->filled('gender')) {
        $genderMap = [
            'male' => 1,
            'female' => 2,
            'other' => 3,
        ];
        if (isset($genderMap[$request->gender])) {
            $query->where('gender', $genderMap[$request->gender]);
        }
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

    // 詳細表示（モーダル用）
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact.modal', compact('contact'));
    }

    // 削除処理
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', '削除しました');
    }

    // CSVエクスポート
    public function export(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"])
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        $csv = "名前,性別,メールアドレス,お問い合わせ種類,お問い合わせ内容,登録日時\n";

        foreach ($contacts as $contact) {
            $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
            $csv .= "{$contact->last_name} {$contact->first_name},{$gender},{$contact->email},{$contact->category->name},{$contact->detail},{$contact->created_at}\n";
        }

        $csv = "\xEF\xBB\xBF" . $csv;

        $filename = 'contacts_export_' . now()->format('Ymd_His') . '.csv';

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
