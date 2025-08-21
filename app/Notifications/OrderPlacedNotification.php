<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Order Confirmation - #' . $this->order->id)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Thank you for placing your order with us! ')
            ->line('Order ID: #' . $this->order->id)
            ->line('Total Amount: $' . number_format($this->order->total_amount, 2))
            ->line('We will notify you once your order is shipped.')
            ->action('View Order', url('/orders/' . $this->order->id))
            ->line('We appreciate your trust in us!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        // For Admin Notification
        if ($notifiable->usertype === 'admin') {
            return [
                'title' => 'New Order Placed',
                'message' => sprintf(
                    'Order #%d has been placed by %s %s. Total: $%s',
                    $this->order->id,
                    $this->order->first_name,
                    $this->order->last_name,
                    number_format($this->order->total_amount, 2)
                ),
                'order_id' => $this->order->id,
            ];
        }

        // For User Notification
        return [
            'title' => 'Order Placed Successfully',
            'message' => 'Your order has been placed successfully!',
            'order_id' => $this->order->id,
        ];
    }
}
