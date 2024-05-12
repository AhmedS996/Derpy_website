<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class AppController extends Controller
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function index()
    {
        $url = env('API_URL') . 'user';
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

            // Process the data as needed

            // Store the data into the database
            foreach ($data as $userData) {
                // Convert members and events data to JSON format
                $userData['groups'] = json_encode($userData['groups']);
                $userData['events'] = json_encode($userData['events']);

                if(isset($userData['profile_image'])){
                    $userData['profile_image'] =  env('API_STORAGE') . $userData['profile_image'];
                }


                if(!isset($userData['user_name'])){
                    App::creating(
                        ['user_name' => $userData['user_name']],
                        $userData
                    );

                }
                else if(isset($userData['user_name'])){
                    App::updating(
                        ['user_name' => $userData['user_name']],
                        $userData
                    );

                }

                if(count($data) < App::count()){
                    $existingAppIds = App::pluck('user_name')->toArray();

                    foreach ($existingAppIds as $userName) {
                        if (!in_array($userName, array_column($data, 'user_name'))) {
                            // Delete the group
                            App::where('user_name', $userName)->delete();
                        }
                    }
                }
            }

            // Returning only the IDs as JSON response with HTTP status 200
            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
