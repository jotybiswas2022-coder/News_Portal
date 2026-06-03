<?php

namespace App\Mail;

use App\Models\BloodRequest;
use App\Models\Profile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BloodRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public BloodRequest $bloodRequest;
    public Profile $donorProfile;

    public function __construct(BloodRequest $bloodRequest, Profile $donorProfile)
    {
        $this->bloodRequest = $bloodRequest;
        $this->donorProfile = $donorProfile;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🚨 জরুরি রক্তের প্রয়োজন - ' . $this->bloodRequest->blood_group . ' (' . $this->bloodRequest->patient_name . ')',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.blood-request-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
