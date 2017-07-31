<?php

namespace App\Http\Controllers;
require '../vendor/autoload.php';

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;


class DashboardController extends Controller
{
	

	public function __construct(){
		$this->middleware('auth');
	}

	public function index(Request $request){
		return view('dashboard.index');
	}

	public function googleChartReport(Request $request){
		return view('dashboard.googlechart');	
	}

	public function iotconnect(Request $request){
		return view('dashboard.iotConnect');
	}

	public function awsSdkTest(){

		$client = new S3Client([
			'region' => 'us-west-2',
			'version' => 'latest'
			]);
		var_dump($client);
	}

}
