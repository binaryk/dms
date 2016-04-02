<?php namespace App\Http\Controllers\PS;
use App\Http\Controllers\Basic\BaseController;
use App\Models\Access\User\User;
use App\Models\PS\Vehicle;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use XMLWriter;

class ParsatorController extends BaseController
{
    public function index()
    {
        $this->makeNavigation();
        return view('ps.parsators.index')
            ->with($this->data('Parsator xml'));
    }

    public function uploadxml()
    {
        $input = Input::all();
        $image = $input['file'];
        $name = $image->getClientOriginalName();
        $path = $image->move( public_path() . '/ps/', $name);
        $data = $this->parse($path->getRealPath());
        Vehicle::create($data);
        return success([]);
    }

    public function parse($path)
    {
        $xml = \XmlParser::load($path);
        $car = $xml->parse([
           'make' => ['uses' => 'car.make'],
           'model' => ['uses' => 'car.model'],
           'rental_price' => ['uses' => 'car.price'],
           'year' => ['uses' => 'car.year'],
           'mileage' => ['uses' => 'car.milage'],
           'fuel_type' => ['uses' => 'car.fuel_type'],
        ]);
        return $car;
    }

    public function report()
    {
        $this->makeNavigation();
        return view('ps.parsators.report')
            ->with($this->data('Report'));;
    }

    public function user_json()
    {
        $users = User::all();
        $bytes_written = File::put(public_path('ps/users.json'), $users);
        if ($bytes_written === false)
        {
            die("Error writing to file");
        }
        return response($users)->header('Content-Type', 'text/json');
        return redirect()->back();
    }

    public function user_xml()
    {
        $users = User::all();
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->startDocument();
        $xml->startElement('users');
        foreach($users as $user) {
            $xml->startElement('user');
            $xml->writeAttribute('id', $user->id);
            $xml->writeAttribute('name', $user->name);
            $xml->writeAttribute('email', $user->email);
            $xml->writeAttribute('created_at', $user->created_at);
            $xml->endElement();
        }
        $xml->endElement();
        $xml->endDocument();

        $content = $xml->outputMemory();
        File::put(public_path('ps/users.xml'), $content);
        $xml = null;

        return response($content)->header('Content-Type', 'text/xml');

        return redirect()->back();
    }

    public function vehicle_json()
    {
        $vehicles = Vehicle::all();
        $bytes_written = File::put(public_path('ps/vehicles.json'), $vehicles);
        if ($bytes_written === false)
        {
            die("Error writing to file");
        }
        return response($vehicles)->header('Content-Type', 'text/json');
        return redirect()->back();
    }

    public function vehicle_xml()
    {
        $users = Vehicle::all();
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->startDocument();
        $xml->startElement('users');
        foreach($users as $user) {
            $xml->startElement('vehicle');
            $xml->writeAttribute('id', $user->id);
            $xml->writeAttribute('location', $user->location);
            $xml->writeAttribute('make', $user->make);
            $xml->writeAttribute('model', $user->model);
            $xml->writeAttribute('rental_price', $user->rental_price);
            $xml->writeAttribute('year', $user->year);
            $xml->writeAttribute('features', $user->features);
            $xml->writeAttribute('created_at', $user->created_at);
            $xml->endElement();
        }
        $xml->endElement();
        $xml->endDocument();

        $content = $xml->outputMemory();
        File::put(public_path('ps/vehicles.xml'), $content);
        $xml = null;

        return response($content)->header('Content-Type', 'text/xml');

        return redirect()->back();
    }

    public function reserved()
    {

        $vehicles = Vehicle::where('is_blocked', '1')->where('user_id', access()->user()->id)->get();
        $bytes_written = File::put(public_path('ps/reserved.json'), $vehicles);
        if ($bytes_written === false)
        {
            die("Error writing to file");
        }
        return response($vehicles)->header('Content-Type', 'text/json');
    }

    public function reserved_email()
    {


        $vehicles = Vehicle::where('is_blocked', '1')->where('user_id', access()->user()->id)->get();
        $bytes_written = File::put(public_path('ps/reserved'.access()->user()->id.'.json'), $vehicles);
        if ($bytes_written === false)
        {
            die("Error writing to file");
        }
        Mail::send('ps.email.index', ['user' => access()->user()], function ($message) {
//            $message->from('us@example.com', 'Laravel');
            $message->subject('Rental report');
            $message->to('lupacescueduard@yahoo.com');
            $message->attach(public_path('ps/reserved'.access()->user()->id.'.json'));
        });
        return redirect()->back()->withFlashSuccess('Email is sended with success');
    }
}