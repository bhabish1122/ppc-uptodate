<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notice;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
  public function index()
  {
    $saveData = [
      'id' => '1',
      'title' => 'this is test',
    ];
  	$notice = Notice::orderBy('id','DESC')->get();
      $response = [
        'data' => $saveData
      ];
      return response()->json($response);
  }


  public function store(Request $request){
    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'https://moh.p1.gov.np/api/notice');
    $jsonArray = json_decode($res->getBody()->getContents(), true);
    // $response = Http::get('https://moh.p1.gov.np/api/notice');
    // dd($jsonArray);
    foreach ($jsonArray as $key => $notice) {
      // var_dump($notice[$key]['title']);
      Notice::create(
            [
              'page' => '1',
              'title' => $notice['title'],
              'slug' => $notice['title'],
              'image' => 'a.jpg',
              'image_enc' => 'a.jpg',
              'image_enc' => 'a.jpg',
              'date' => '2020',
              'date_np' => '21020',
              'remark' => 'ddd',
              'created_at_np' => '2020',
              'created_by' => '1',
            ]
          );
    }
  }
}