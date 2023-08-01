<?php

namespace App\Http\Controllers;
use App\User;
use App\Product;
use Illuminate\Http\Request;

class ContactSellerController extends Controller
{
    public function sendWhatsAppMessage($seller, $productName)
    {
        // Retrieve the WhatsApp number and message data from the seller
        $user = Product::where('phone_number', $seller)->firstOrFail();
        $number = $user->phone_number;
        $message = "Produk " . urlencode($productName) . " apakah masih ada?";

        // Generate the WhatsApp URL with the number and message
        $whatsappUrl = "https://wa.me/{$number}?text=" . urlencode($message);

        // Redirect to the WhatsApp URL
        return redirect()->away($whatsappUrl);
    }
}
