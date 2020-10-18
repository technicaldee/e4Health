<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Resources\AppResource as App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $u = Appointment::where('status', 'Incomplete')->count();
        $a = Appointment::where('status', 'Complete')->count();
        if(auth()->user()->role == "Patient"){
            $appointment = Appointment::where('user', auth()->user()->id)->get();
            $c = $appointment->count();
        } else{
            $appointment = Appointment::get();
            $c = 1;
        }
        
        return view('home', [
            'apps' => $appointment,
            'c' => $c,
            'u' => $u,
            'a' => $a
        ]);
    }

    public function add(Request $request){
        $appointment = new Appointment;
        $appointment->user = auth()->user()->id;
        $appointment->description = request('description');
        $appointment->status = 'Incomplete';
        $appointment->save();

        return redirect('home')->with('status', 'Appointment added!');
    }

    public function del(Request $request){
        $del = request('btn');
        $appointment = Appointment::where('id', $del);
        $appointment->delete();

        return redirect('home')->with('status', 'Appointment cancelled!');
    }

    public function mark(Request $request){
        $del = request('btn');
        $appointment = Appointment::where('id', $del)->first();
        $appointment->status = 'Complete';
        $appointment->save();

        return redirect('home')->with('status', 'Appointment marked completed!');
    }


    // Api starts here

    public function api_appointment()
    {
        $app = Appointment::paginate(15);

        // as resource
        return App::collection($app);
    }
}
