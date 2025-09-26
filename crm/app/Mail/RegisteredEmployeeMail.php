<?php

namespace App\Mail;

use App\Models\Employees;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisteredEmployeeMail extends Mailable
{
    use Queueable, SerializesModels;

    public Employees $employee;
    public Company $company;

    /**
     * Create a new message instance.
     */
    public function __construct(Employees $employee, Company $company)
    {
        $this->employee = $employee;
        $this->company = $company;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Sender can be forced via .env MAIL_SENDER_ADDRESS/MAIL_SENDER_NAME
        $fromAddress = env('MAIL_SENDER_ADDRESS', config('mail.from.address'));
        $fromName = env('MAIL_SENDER_NAME', config('mail.from.name') ?: ($this->company->name ?? null));

        $mail = $this->subject('Bem-vindo à empresa!')
            ->view('emails.registered_employee')
            ->with([
                'employee' => $this->employee,
                'company' => $this->company,
            ]);

        if ($fromAddress) {
            $mail->from($fromAddress, $fromName);
        }
        return $mail;
    }
}
