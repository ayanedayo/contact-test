<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;


class ContactController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
}
    public function confirm(Request $request) {
        $inputs = $request->validate([
            'last_name'   => ['required','max:255'],
            'first_name'  => ['required','max:255'],
            'email'       => ['required','email','max:255'],
            'tel'         => ['required','max:255'],
            'address'     => ['required','max:255'],
            'building'    => ['required','max:255'],
            'gender'      => ['required','in:1,2,3'],
            'category_id' => ['required','exists:categories,id'],
            'detail'      => ['required','max:2000'],
        ]);
        return view('contact.confirm', compact('inputs'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'last_name'   => ['required','max:255'],
            'first_name'  => ['required','max:255'],
            'email'       => ['required','email','max:255'],
            'tel'         => ['required','max:255'],
            'address'     => ['required','max:255'],
            'building'    => ['required','max:255'],
            'gender'      => ['required','in:1,2,3'],
            'category_id' => ['required','exists:categories,id'],
            'detail'      => ['required','max:2000'],
        ]);

        Contact::create($data);
        return redirect()->route('contact.thanks');
    }

    public function thanks() {
        return view('contact.thanks');
    }
}