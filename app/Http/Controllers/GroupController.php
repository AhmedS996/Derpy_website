<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GroupController extends Controller
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $url = env('API_URL') . 'group';
        $apiKey = env('API_KEY');

    try {
        $response = $this->client->request('GET', $url, [
            'headers' => [
                'apikey' => $apiKey,
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '. $apiKey,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Process the data as needed

        // Store the data into the database
        foreach ($data as $eventData) {
            // Convert members and events data to JSON format
            $eventData['members'] = json_encode($eventData['members']);
            $eventData['events'] = json_encode($eventData['events']);

            Group::updateOrCreate(
                ['group_id' => $eventData['group_id']],
                $eventData
            );
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
