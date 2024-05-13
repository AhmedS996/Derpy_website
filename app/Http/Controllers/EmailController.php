<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EmailController extends Controller
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function index()
    {
        $url = env('API_URL') . 'emails';
        $apiKey = env('API_KEY');

        try {
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'apikey' => $apiKey,
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '. $apiKey, // Added space after Bearer
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            // Store the data into the database
            foreach ($data as $emailData) {

                if (isset($emailData['email'])) {
                    Email::updateOrCreate(['email' => $emailData['email']], $emailData);
                }


            }

            if(count($data) < Email::count()){
                $existingEmailIds = Email::pluck('email')->toArray();
                foreach ($existingEmailIds as $emailAddress) {
                    if (!in_array($emailAddress, array_column($data, 'email'))) {
                        // Delete the group
                        Email::where('email', $emailAddress)->delete();
                    }
                }
            }

            // Returning only the IDs as JSON response with HTTP status 200
            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
