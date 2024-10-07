<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Models\Food;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function HomePage()
    {
        return view('frontend.pages.home-page');
    }


    public function SettingList(): JsonResponse
    {
        try {
            $data = SiteSetting::first(); 

            if ($data) { 
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request Successful',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No data found',
                    'data' => null
                ], 404); 
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while processing your request',
                'error' => $e->getMessage() 
            ], 500);
        }
    }



    public function SliderList():JsonResponse
    {
        try {
            $data = Slider::all(); 

            if ($data->isNotEmpty()) { 
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request Successful',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No data found'
                ], 404); 
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred'
            ], 500);
        }
    }


    public function FoodList(Request $request,$id=null)
    {
        try {
            $currentDate = Carbon::now(new \DateTimeZone('Asia/Dhaka'));
            $foods = Food::where('expire_date', '>=', $currentDate)
                        ->where('status', 'published')
                        ->orWhere('status', 'processing')
                        ->latest()
                        ->paginate(6);

            if ($foods->isNotEmpty()) { 
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request Successful',
                    'foods' => $foods
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Food Not Found'
                ], 404); 
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred'
            ], 500);
        }
    }


    public function getAvailableFoodByDate(Request $request, $date)
    {
        try {
            $timezone = new \DateTimeZone('Asia/Dhaka');
            $date = Carbon::parse($date, $timezone)->format('Y-m-d');

            $foods = Food::where('expire_date', '>=', $date)
                    ->whereDate('collection_date', $date)
                    ->where(function ($query) {
                        $query->where('status', 'published')
                              ->orWhere('status', 'processing');
                    })
                    ->latest()
                    ->paginate(6);

            if ($foods->isNotEmpty()) { 
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request successful',
                    'foods' => $foods
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Food not found'
                ], 404); 
            }

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            \Log::error('Error fetching available food by date: ' . $e->getMessage());

            return response()->json([
                'status' => 'failed',
                'error' => 'An error occurred while fetching available food. Please try again later.'
            ], 500);
        }
    }


    public function searchFood(Request $request)
    {
        try {
            $query = $request->input('query');
            $currentDate = Carbon::now(new \DateTimeZone('Asia/Dhaka'));

            $foods = Food::where(function ($q) use ($query) {
                                $q->where('name', 'like', "%{$query}%")
                                  ->orWhere('address', 'like', "%{$query}%");
                            })
                            ->where('expire_date', '>=', $currentDate)
                            ->where(function ($q) {
                                $q->where('status', 'published')
                                  ->orWhere('status', 'processing');
                            })
                            ->get();

            if ($foods->isEmpty()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No food available matching your search criteria.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'foods' => $foods
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while searching for food.'
            ], 500);
        }
    }

public function FoodListByLocation(Request $request)
{
    try {
        // Validate latitude and longitude inputs
        $validated = $request->validate([
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180'
        ]);

        $latitude = $validated['latitude'] ?? null;
        $longitude = $validated['longitude'] ?? null;
        $radius = 10; // Radius in kilometers

        // Log the received latitude and longitude
        //Log::info("Latitude: $latitude, Longitude: $longitude");

        // Get the current date and time in the 'Asia/Dhaka' timezone
        $currentDate = Carbon::now(new \DateTimeZone('Asia/Dhaka'));

        // Start the query for food items that have not expired
        $query = Food::where('expire_date', '>=', $currentDate)
                    ->whereIn('status', ['published', 'processing']);

        // If latitude and longitude are provided, calculate the distance using the Haversine formula
        if ($latitude && $longitude) {
            $haversine = "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
                            * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))";
            $query->selectRaw("*, {$haversine} AS distance", [$latitude, $longitude, $latitude])
                  ->having('distance', '<=', $radius) // Filter by distance (within the specified radius)
                  ->orderBy('distance', 'asc'); // Sort by distance (nearest first)
        } else {
            // If no location is provided, order by the latest food items
            //$query->latest();
        }

        // Paginate the results, 6 items per page
        $foods = $query->paginate(6);

        // Check if any food items were found and return the appropriate response
        if ($foods->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
                'foods' => $foods,
                'hasFood' => true // Indicate food was found
            ], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'No Food Found by Location',
                'hasFood' => false // Indicate no food was found
            ], 200);
        }
    } catch (\Throwable $e) {
        // Handle any exceptions and return a proper error response
         Log::error("An error occurred: " . $e->getMessage());
        return response()->json([
            'status' => 'failed',
            'message' => 'An error occurred',
            'error' => $e->getMessage() // Include the error message for easier debugging
        ], 500);
    }
}


}