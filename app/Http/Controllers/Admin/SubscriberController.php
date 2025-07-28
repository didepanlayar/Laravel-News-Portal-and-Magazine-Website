<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Admin\NewsletterMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    /**
     * Apply middleware or inject service dependencies.
     */
    public function __construct()
    {
        $this->middleware(['permission:Read Subscriber,admin'])->only('index', 'broadcast');
        $this->middleware(['permission:Delete Subscriber,admin'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = Subscriber::all();

        $title = 'Delete Language!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.subscribers.index', compact('subscribers'));
    }

    /**
     * Broadcast view.
     */
    public function broadcast()
    {
        return view('admin.subscribers.broadcast');
    }

    /**
     * Send broadcast to subscribers.
     */
    public function send(Request $request)
    {
        $request->validate(
            [
                'subject' => 'required|string|max:255',
                'message' => 'required|string'
            ]
        );

        $subscribers = Subscriber::pluck('email')->toArray();

        // Send email
        Mail::to($subscribers)->send(new NewsletterMail($request->subject, $request->message));

        toast(__('backend.Broadcast successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.subscribers');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $subscriber = Subscriber::findOrFail($id);
            $subscriber->delete();

            toast(__('backend.Subscriber delete successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $th) {
            toast(__('backend.Subscriber delete error'), 'error')->width('350')->timerProgressBar();
        }

        return redirect()->route('admin.subscribers');
    }
}
