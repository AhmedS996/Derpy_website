<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class EventController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


public function index()
{
    $url = env('API_URL') . 'event';
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
        foreach ($data as $eventData) {
            $eventData['members'] = json_encode($eventData['members']);
            $eventData['event_avatar'] =  env('API_STORAGE') . $eventData['event_avatar'];


            if(!isset($eventData['event_id'])){
                Event::creating(
                    ['event_id' => $eventData['event_id']],
                    $eventData
                );

            }
            else if(isset($eventData['event_id'])){
                Event::updating(
                    ['event_id' => $eventData['event_id']],
                    $eventData
                );

            }

            if(count($data) < Event::count()){
                $existingEventIds = Event::pluck('event_id')->toArray();

                foreach ($existingEventIds as $eventId) {
                    if (!in_array($eventId, array_column($data, 'event_id'))) {
                        // Delete the group
                        Event::where('event_id', $eventId)->delete();
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
