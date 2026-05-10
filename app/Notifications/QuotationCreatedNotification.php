<?php

namespace App\Notifications;

use App\Models\Quotation;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuotationCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create notification instance.
     */
    public function __construct( protected Quotation $quotation) 
    {
        //
    }

    /**
     * Notification delivery channels.
     */
    public function via(object $notifiable): array 
    {
        return [
            'mail',
        ];
    }

    /**
     * Build mail notification.
     */
    public function toMail(object $notifiable): MailMessage 
    {

        return (new MailMessage)
            ->subject(
                'Your Prescription Quotation Is Ready'
            )
            ->greeting(
                'Hello '
                . $notifiable->name
                . ','
            )
            ->line(
                'A pharmacy has prepared your quotation.'
            )
            ->line('Total Amount: Rs. ' . number_format($this->quotation->total_amount, 2))
            ->action('View Quotation', url('/customer/prescriptions'))
            ->line('Thank you for using our system.');
    }

    /**
     * Array representation.
     */
    public function toArray(object $notifiable): array 
    {

        return [];
    }
}