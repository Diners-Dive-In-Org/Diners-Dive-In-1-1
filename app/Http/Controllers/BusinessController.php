<?php

namespace App\Http\Controllers;

use App\Business;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BusinessRepository;
use Symfony\Component\HttpFoundation\Response;

class BusinessController extends Controller
{
    /**
     * The business repository instance.
     *
     * @var BusinessRepository
     */
    protected $business;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BusinessRepository $business)
    {
        $this->middleware('auth');

        $this->business = $business;
    }

    /**
     * Display a list of all of the user's businesses.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('business/home', [
            'business' => $this->business->forUser($request->user()),
        ]);
    }

    /**
     * Register a business
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        return view('business/register', [
            'business' => $this->business->forUser($request->user()),
        ]);
    }

    /**
     * Create a new business.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:business',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'street_address' => 'required|max:255',
            'email' => 'max:255',
            'phone_number' => 'required|max:255|unique:business',
        ]);

        // Create The Business...
        $request->user()->business()->create([
            'name' => $request->name,
            'country' => $request->country,
            'city' => $request->city,
            'street_address' => $request->street_address,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return redirect('/business/home');
    }

    public function edit($id)
    {
        $business = Business::findOrFail($id);

        return view('business.edit')->withBusiness($business);
    }

    public function update($id, Request $request)
    {
        $business = Business::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255|unique:business',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'street_address' => 'required|max:255',
            'email' => 'max:255',
            'phone_number' => 'required|max:255|unique:business',
        ]);

        $input = $request->all();

        $business->fill($input)->save();

        Session::flash('flash_message', 'Task successfully added!');

        return redirect()->back();
    }

    /**
     * Destroy the given business.
     *
     * @param  Request  $request
     * @param  Business  $restaurant
     * @return Response
     */
    public function destroy(Request $request, Business $business)
    {
        $this->authorize('destroy', $business);

        // Delete The Task...
        $business->delete();

        return redirect('/business/home');
    }
}
