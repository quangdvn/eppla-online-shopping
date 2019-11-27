<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $toEmail = $this->order->billing_email;
        $toName = $this->order->billing_name_on_card;
        $orderNumb = $this->order->id;

        return $this->to($toEmail, $toName)
                    ->subject("Order number #{$orderNumb} from Eppla")
                    ->markdown('emails.order.placed');
    }
}
