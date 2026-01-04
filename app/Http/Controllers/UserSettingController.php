<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $settings = UserSetting::getOrCreateForUser(auth()->id());
        $currencies = UserSetting::availableCurrencies();

        return view('settings.index', compact('settings', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $settings = UserSetting::getOrCreateForUser(auth()->id());

        $validated = $request->validate([
            'currency' => 'required|string|size:3',
            'language' => 'required|string|in:en,ar',
            'theme' => 'required|string|in:light,dark,auto',
            'notifications_enabled' => 'boolean',
            'email_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'budget_alerts' => 'boolean',
            'savings_reminders' => 'boolean',
            'cloud_sync_enabled' => 'boolean',
            'timezone' => 'required|string',
        ]);

        // Handle checkboxes (boolean values not present in request if unchecked)
        $booleans = [
            'notifications_enabled',
            'email_notifications',
            'push_notifications',
            'budget_alerts',
            'savings_reminders',
            'cloud_sync_enabled',
        ];

        foreach ($booleans as $boolean) {
            $validated[$boolean] = $request->has($boolean);
        }

        $settings->update($validated);

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
