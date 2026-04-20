<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Log;

class AdminAlertService
{
    /**
     * Admin inbox: site_settings.contact_email, else mail.from.address.
     */
    public static function mailRecipient(): ?string
    {
        $raw = SiteSetting::query()
            ->where('setting_key', 'contact_email')
            ->value('setting_value');

        $email = $raw !== null ? trim((string) $raw) : '';
        if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }

        $fallback = trim((string) config('mail.from.address', ''));
        if ($fallback !== '' && filter_var($fallback, FILTER_VALIDATE_EMAIL)) {
            return $fallback;
        }

        return null;
    }

    public function notifyNewContact(array $data): void
    {
        Log::info('[AdminAlert] notifyNewContact (WhatsApp stub)', [
            'channel' => 'log',
            'event' => 'new_contact',
            'data' => $data,
        ]);
    }

    public function notifyNewComment(array $data): void
    {
        Log::info('[AdminAlert] notifyNewComment (WhatsApp stub)', [
            'channel' => 'log',
            'event' => 'new_pending_comment',
            'data' => $data,
        ]);
    }
}
