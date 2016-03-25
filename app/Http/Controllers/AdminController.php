<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Package;
use App\Models\Customer;

use Input;
use Auth;
use View;
class AdminController extends Controller {
  
  /**
   * Function to retrieve the index page
   */
  public function index()
  {
    $errors = "None";
    return view('admin/login')->with('errors', $errors);
  }
  
  /**
   * Function to attempt authorization, and redirect to admin page if successful, redirect to login with errors if not
   */
  public function login()
  {
    $input = Input::all();
    if (Auth::attempt(array('username' => $input['username'], 'password' => $input['password'] ))) {
      return redirect('admin/appointments');
    } else {
      $errors = "Invalid username or password";
      return view('admin/login')->with('errors', $errors);
    }
  }

  public function appointments()
  {
    return view('admin/appointments');
  }

  public function availability()
  {
    return view('admin/availability');
  }

  /**
   * View function for list of packages
   * @return view 
   */
  public function packages() {
    $packages = Package::all();
    return view('admin/packages/index', ['packages' => $packages]);
  }

  /**
   * View Function to edit package information
   * @param  int $package_id
   * @return view
   */
  public function editPackage($package_id)
  {
    return view('admin/packages/editPackage', ['package' => Package::find($package_id)]);
  }

  public function updatePackage($package_id)
  {
    dd('tets');
  }

  /**
   * Function to add all submitted form times to that date
   * Will need to detect collisions, if any
   * 
   */
  public function addAvailability()
  {
    $post = Input::all();
   
    $dateToAdd = $post['dateSelected'];
    $times = [];
    foreach($post['time'] as $key => $value) {
      $times[$value] = $post['timeOfDay'][$key];
    }

    foreach($times as $time){
      dd($dateToAdd.' '.$time);
    }
  }
   
}