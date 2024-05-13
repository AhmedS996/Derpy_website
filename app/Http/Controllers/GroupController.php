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

        // Store the data into the database
        foreach ($data as $groupData) {
            // Convert members and events data to JSON format
            $groupData['members'] = json_encode($groupData['members']);
            $groupData['events'] = json_encode($groupData['events']);

            $groupData['group_image'] =  env('API_STORAGE') . $groupData['group_image'];

            if (isset($groupData['group_id'])) {
                Group::updateOrCreate(['group_id' => $groupData['group_id']], $groupData);
            }
        }

        if(count($data) < Group::count()){
            $existingGroupIds = Group::pluck('group_id')->toArray();

            foreach ($existingGroupIds as $groupId) {
                if (!in_array($groupId, array_column($data, 'group_id'))) {
                    // Delete the group
                    Group::where('group_id', $groupId)->delete();
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
