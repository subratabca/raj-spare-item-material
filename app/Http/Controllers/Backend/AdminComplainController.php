<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\ReviewFoodComplainNotification;
use App\Notifications\FoodComplainNotification;
use Illuminate\Support\Facades\Notification;
use Exception;
use App\Models\ComplainConversation;
use App\Models\Complain;
use App\Models\User;
use Carbon\Carbon;

class AdminComplainController extends Controller
{
    public function ComplainPage()
    {
        return view('backend.pages.complain.complain-list');
    }


    public function ComplainList(Request $request)
    {
        try {
            $complains = Complain::with(['order', 'food.user', 'user'])->latest()->get();

            if ($complains->isEmpty()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Complain not found',
                ], 404); 
            }

            return response()->json([
                'status' => 'success',
                'data' => $complains
            ], 200); 

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving complaints',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function ComplainDetailsPage(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', $email)->first();

        $notification_id = $request->query('notification_id');
        if ($notification_id) {
            $notification = $user->notifications()->where('id', $notification_id)->first();

            if ($notification && is_null($notification->read_at)) {
                $notification->markAsRead();
            }
        }
        
        return view('backend.pages.complain.complain-details');
    }

    
    public function ComplainDetails($complain_id)
    {
        try {
            $complains = Complain::with(['order', 'food', 'food.user', 'food.foodImages', 'user', 'conversations'])
                ->where('id', $complain_id)
                ->first();

            if (!$complains) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Complain information not found'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $complains
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving complain information',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function ComplainSendToClient($complain_id)
    {
        try {
            $complain = Complain::with(['order', 'food', 'food.user', 'food.foodImages', 'user'])->findOrFail($complain_id);

            if ($complain->status === 'pending') {
                $currentDateTime = Carbon::now();
                $clnt_cmp_date = $currentDateTime->format('d F Y');
                $clnt_cmp_time = $currentDateTime->format('h:i:s A');

                $result = $complain->update([
                    'status' => 'under-review',
                    'clnt_cmp_date' => $clnt_cmp_date, 
                    'clnt_cmp_time' => $clnt_cmp_time, 
                ]);

                $customer = $complain->user;             
                $client = $complain->food->user;        

                if ($customer->role === 'user') {
                    $customer->notify(new ReviewFoodComplainNotification($complain)); 
                }

                if ($client->role === 'client') {
                    $client->notify(new FoodComplainNotification($complain)); 
                }

                return response()->json([
                    'status' => 'success',
                    'message' => 'Complain sent successfully to client.'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Complain is not in pending status.'
                ], 400);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Complain not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Status update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    function delete(Request $request)
    {
        try {
            $user_id = $request->header('id');
            $complain_id = $request->input('id');

            $complain = Complain::with('conversations')->findOrFail($complain_id);
            $complain->conversations()->delete();
            $complain->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Complain and its related conversations deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Complain not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Deletion failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}