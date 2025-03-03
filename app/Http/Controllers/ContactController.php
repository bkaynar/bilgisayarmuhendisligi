<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{

    public function index()
    {
        $mesajlar = Contact::orderBy('id', 'desc')->get();
        return view('iletisim.index', compact('mesajlar'));
    }

    public function show($id)
    {
        $mesaj = Contact::findOrFail($id);
        return view('iletisim.show', compact('mesaj'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => $request->ip(),
        ]);

        Session::flash('success', __('messages.Mesajınız başarıyla gönderildi'));

        return back();
    }
}
