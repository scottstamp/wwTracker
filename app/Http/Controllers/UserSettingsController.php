<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Grimthorr\LaravelUserSettings\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingsController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        setting()->set($request->except('_token'));
        setting()->save();

        return redirect()->back();
    }

    public function index() {
        $timezone = setting('timezone', 'America/St_Johns');
        $dailyLimit = setting('dailyLimit', 30);
        return view('auth.settings.index', compact('timezone', 'dailyLimit'));
    }
}