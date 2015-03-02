<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $name = Input::get('search');
        

        $client = new Client();
$response = $client->get('http://httpbin.org/get');

// You can use the same methods you saw in the procedural API
$response = $client->head('http://httpbin.org/get');

$request = $client->createRequest('GET', 'http://aleph20.ipleiria.pt/X?op=find&code=wrd&request='.$name.'&base=usm01');
$response = $client->send($request);


$xml = $response->xml();
echo $xml->set_number . " - ";

$request = $client->createRequest('GET', 'http://aleph20.ipleiria.pt/X?op=present&set_entry=000000001-000000010&set_number='.$xml->set_number);
$response = $client->send($request);

$xml2 = $response->xml();
echo $xml2->record[0]->metadata->oai_marc->varfield['id'];
        
        //var_dump($name);
        return view('results')->with('name', $name);
    }
}
