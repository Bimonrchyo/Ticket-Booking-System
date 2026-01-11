<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    // Histori Pemesanan User
    public function history()
    {
        $histori = Booking::where('user_id', auth('web')->id())
            ->with('jadwal.transportasi')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.riwayat', compact('histori'));
    }

    // Proses Cetak Tiket ke PDF
    public function printTicket($id)
    {
        $booking = Booking::with('jadwal.transportasi', 'user')->findOrFail($id);

        // Cek apakah sudah bayar
        if ($booking->status != 'paid') {
            return redirect()->back()->with('error', 'Bayar dulu bos!');
        }

        $pdf = Pdf::loadView('pdf.tiket-pdf', compact('booking'));
        return $pdf->download('Tiket-'.$booking->kode_booking.'.pdf');
    }

    // Proses Cetak Struk ke PDF
    public function printInvoice($id)
    {
        $booking = Booking::with('payment', 'user')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.invoice-pdf', compact('booking'));
        return $pdf->stream('Invoice-'.$booking->kode_booking.'.pdf');
    }
}
