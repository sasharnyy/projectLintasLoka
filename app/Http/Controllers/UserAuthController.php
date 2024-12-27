<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


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


        if ($request->return_date) {
            $query->whereNotNull('return_date')
                ->where('return_date', $request->return_date);
            
            if ($request->return_time) {
                $query->where('return_time', $request->return_time);
            }
        } else {
            $query->where(function ($q) {
                $q->whereNull('return_date')
                  ->orWhere('return_date', '');
            });
        }        
        
        $tickets = $query->orderBy('departure_date')
                        ->orderBy('departure_time')
                        ->orderBy('return_date', 'asc')
                        ->orderBy('return_time', 'asc')
                        ->get();
        
        dd(vars: $tickets);
        dd([
            'query' => $query->toSql(),
            'bindings' => $query->getBindings(),
            'data' => $query->get(),
        ]);
        
        return view('user.cek_tiket', compact('tickets'));

    }



    public function book(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'full_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);

        UserTicket::create([
            'ticket_id' => $request->ticket_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->back()->with('success', 'Ticket booked successfully!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
