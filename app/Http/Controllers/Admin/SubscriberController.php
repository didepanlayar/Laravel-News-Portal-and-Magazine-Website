<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $subscriber = Subscriber::findOrFail($id);
            $subscriber->delete();

            toast(__('Subscriber delete successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $th) {
            toast(__('Subscriber delete error'), 'error')->width('350')->timerProgressBar();
        }

        return redirect()->route('admin.subscribers');
    }
}
