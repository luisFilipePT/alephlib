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
        echo 'Set_number: '.$xml->set_number.'</br>';
        $num_records = $xml->no_records;
        echo 'No_Records: '.$num_records.'</br></br>';
        
        $request = $client->createRequest('GET', 'http://aleph20.ipleiria.pt/X?op=present&set_entry=000000001-'.$num_records.'&set_number='.$xml->set_number);
        $response = $client->send($request);

        $xml2 = $response->xml();
        for ($i = 1; $i < $num_records+1; $i++) {
            echo 'Título '.$i.' : Registo Interno: '.$xml2->xpath("//record[".$i."]/doc_number")[0].' -> ';
            echo $xml2->xpath("//record[".$i."]/metadata/oai_marc/varfield[@id='245']/subfield")[0].'</br>';
        }

        //echo $xml2->xpath("//record[1]/metadata/oai_marc/varfield[@id='245']/subfield")[0];
        
        //var_dump($name);
        return  view('results')->with('name', $name);
    }
}
