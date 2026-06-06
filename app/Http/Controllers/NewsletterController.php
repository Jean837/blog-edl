<?php
namespace App\Http\Controllers;

use App\Mail\NewsletterConfirmMail;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request) {
        $request->validate(['email' => 'required|email']);

        if (Newsletter::where('email', $request->email)->exists()) {
            return back()->with('newsletter_info', 'Vous êtes déjà abonné !');
        }

        $token = Str::random(32);
        Newsletter::create([
            'email'  => $request->email,
            'token'  => $token,
            'active' => true,
        ]);

        $unsubscribeUrl = route('newsletter.unsubscribe', $token);
        Mail::to($request->email)->send(new NewsletterConfirmMail($unsubscribeUrl));

        return back()->with('newsletter_success', '🎉 Abonnement confirmé ! Vérifiez votre email.');
    }

    public function unsubscribe(string $token) {
        $sub = Newsletter::where('token', $token)->first();
        if ($sub) {
            $sub->delete();
            return redirect('/')->with('success', 'Vous avez été désabonné.');
        }
        return redirect('/');
    }
}