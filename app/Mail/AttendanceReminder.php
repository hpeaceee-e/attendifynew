<?php
namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class AttendanceReminder extends Mailable
{
    public $user;

    // Constructor to pass user data
    public function __construct(User $user)
    {
        $this->user = $user;
        // dd($user);
    }

    // Build the email
    public function build()
    {
        return $this->subject('Peringatan Kehadiran')
                    ->view('emails.attendance_reminder');
    }
}
