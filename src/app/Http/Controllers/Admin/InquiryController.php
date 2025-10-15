<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('id')->get();

        $contacts = Contact::with('category')
            
            ->when($request->filled('keyword'), function ($q) use ($request) {
                $kw = $request->keyword;
                $q->where(function ($q) use ($kw) {
                    $q->where('last_name', 'like', "%{$kw}%")
                      ->orWhere('first_name', 'like', "%{$kw}%")
                      ->orWhereRaw("CONCAT(last_name, first_name) like ?", ["%{$kw}%"])
                      ->orWhere('email', 'like', "%{$kw}%");
                });
            })
            
            ->when(in_array($request->gender, ['1','2','3'], true), function ($q) use ($request) {
                $q->where('gender', (int)$request->gender);
            })
            
            ->when($request->filled('category_id'), function ($q) use ($request) {
                $q->where('category_id', (int)$request->category_id);
            })
            
            ->when($request->filled('from') || $request->filled('to'), function ($q) use ($request) {
                $from = $request->filled('from') ? $request->date('from')->startOfDay() : null;
                $to   = $request->filled('to')   ? $request->date('to')->endOfDay()   : null;

                if ($from && $to)     $q->whereBetween('created_at', [$from, $to]);
                elseif ($from)        $q->where('created_at', '>=', $from);
                elseif ($to)          $q->where('created_at', '<=', $to);
            })
            ->orderByDesc('created_at')
            ->paginate(7)
            ->withQueryString();

        return view('admin.index', compact('contacts', 'categories'));
    }
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.index')->with('status','削除しました');
    }
    public function show($id)
{
    $contact = Contact::with('category')->find($id);

    return view('admin.show', compact('contact'));
}
}