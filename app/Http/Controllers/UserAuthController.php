<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Booking;
use App\Models\Outlet;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('user.login');
    }

    public function showRegister()
    {
        return view('user.register');
    }

    public function home()
    {
        return view('user.home'); 
    }

    public function register(Request $request)
    {
    

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);


        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with('success', 'Registration successful!');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.home');
        }

        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    public function cekTiketForm()
    {
        return view('user.cek_tiket'); 
    }

    public function searchTicket(Request $request)
    {
        $request->validate([
            'departure' => 'required|string',
            'destination' => 'required|string',
            'departure_date' => 'required|date',
            'return_date' => 'nullable|date|after:departure_date',
        ]);

        $query = Ticket::query()
            ->where('departure', $request->departure)
            ->where('destination', $request->destination)
            ->where('departure_date', $request->departure_date);

        if (!empty($request->return_date)) {
            $query->whereNotNull('return_date')
                ->where('return_date', $request->return_date);
        } else {
            $query->whereNull('return_date');
        }

        $tickets = $query->orderBy('departure_date')
                        ->orderBy('departure_time')
                        ->get();

        $return_date = $request->return_date;
        $searchPerformed = true;
                        
        return view('user.cek_tiket', compact('tickets', 'searchPerformed'))
            ->with('tripType', $return_date ? 'pulang_pergi' : 'sekali_jalan');
    } 
    public function showBookingPage($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        $bookedSeats = Booking::where('ticket_id', $ticketId)
            ->pluck('seat_details')
            ->toArray();

        $bookedSeats = array_reduce($bookedSeats, function ($carry, $item) {
            return array_merge($carry, json_decode($item, true) ?? []);
        }, []);

        return view('user.booking', compact('ticket', 'bookedSeats'));
    }

    public function storeBooking(Request $request, $ticketId)
    {
        $request->validate([
            'number_of_passengers' => 'required|integer|min:1',
            'passenger_details' => 'required|array|min:1|max:' . $request->number_of_passengers,
            'seat_details' => 'required|string',
        ]);
        
        $ticket = Ticket::findOrFail($ticketId);
        $selectedSeats = json_decode($request->seat_details);

        $bookedSeats = Booking::where('ticket_id', $ticketId)
            ->pluck('seat_details')
            ->toArray();

        $bookedSeats = array_reduce($bookedSeats, function ($carry, $item) {
            return array_merge($carry, json_decode($item, true) ?? []);
        }, []);

        foreach ($selectedSeats as $seat) {
            if (in_array($seat, $bookedSeats)) {
                return back()->withErrors(['seat_details' => "Kursi {$seat} sudah dipesan."]);
            }
        }

        $booking = Booking::create([
            'ticket_id' => $ticket->id,
            'number_of_passengers' => $request->number_of_passengers,
            'passenger_details' => json_encode($request->passenger_details),
            'seat_details' => $request->seat_details,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.payment', ['bookingId' => $booking->id]);
    }


    public function showSuccess($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        return view('user.booking-success', compact('booking'));
    }

    public function showPaymentPage($bookingId)
    {
        $booking = Booking::with('ticket')->findOrFail($bookingId);  
        return view('user.payment', compact('booking'));
    }
    

    public function completeBooking(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $booking->payment_method = $request->input('payment_method');

        $ticketPrice = $request->input('ticket_price');
        $booking->ticket_price = $ticketPrice;  

        $passengerCount = count(json_decode($booking->passenger_details, true));
        $totalPrice = $ticketPrice * $passengerCount;
        $booking->total_price = $totalPrice;  

        if ($request->input('payment_method') == 'virtual_account') {
            $booking->bank_account = $request->input('bank_account');
            $booking->va_number = $request->input('va_number');  
        }

        if ($request->input('payment_method') == 'dana') {
            $booking->dana_number = $request->input('dana_number');
        }

        $booking->status = 'paid';
        $booking->save();

        $order = new Order();
        $order->user_id = $booking->user_id;
        $order->destination_id = $booking->destination_id; 
        $order->customer_name = $booking->user->name; 
        $order->customer_email = $booking->user->email; 
        $order->total_amount = $booking->total_price; 
        $order->status = 'pending'; 
        $order->save();

        return redirect()->route('booking.success', ['booking' => $booking->id]);
    }


    public function showOutlets()
    {
        $outlets = Outlet::all(); 
        return view('user.outlet', compact('outlets'));
    }

    public function showCustomerServiceForm()
    {
        return view('user.custService');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
