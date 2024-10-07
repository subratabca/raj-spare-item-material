<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\FoodComplainFeedbackNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;
use Exception;
use App\Models\User;
use App\Models\Complain;
use App\Models\ComplainConversation;
use Carbon\Carbon;

class ClientComplainController extends Controller
{
    public function ComplainPage()
    {
        return view('client.pages.complain.complain-list');
    }

    public function ComplainList(Request $request)
    {
        try {
            $user_id = $request->header('id');

            $complains = Complain::whereHas('food', function($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->with(['order', 'food.user', 'user'])
            ->latest()
            ->get();

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

        return view('client.pages.complain.complain-details');
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


    public function StoreComplainFeedbackInfo(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'reply_message' => 'required|string|min:10|max:500',
                'complain_id' => 'required|exists:complains,id',
            ]);

            $user_id = $request->header('id');
            $sender_role = User::where('id', $user_id)->value('role');

            if ($sender_role !== 'client') {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Only clients can reply to complaints.',
                ], 403);
            }

            $complain = Complain::find($validated['complain_id']);
            if (!$complain) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Complaint not found.',
                ], 404);
            }

            $lastConversation = ComplainConversation::where('complain_id', $complain->id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($lastConversation) {
                if ($lastConversation->sender_role !== 'user') {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'You cannot reply until the customer has responded.',
                    ], 403);
                }
            } 

            $complainConversation = ComplainConversation::create([
                'complain_id' => $complain->id,
                'sender_id' => $user_id,
                'reply_message' => $validated['reply_message'],
                'sender_role' => 'client',
            ]);

            if ($complainConversation) {
                $admin = User::where('role', 'admin')->first();
                $customer = $complain->user;

                if ($admin && $customer) {
                    $admin->notify(new FoodComplainFeedbackNotification($complainConversation));
                    $customer->notify(new FoodComplainFeedbackNotification($complainConversation));

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Complain feedback has been sent successfully.',
                        'data' => $complainConversation,
                    ], 201);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Admin or customer not found.',
                    ], 404);
                }
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to create complain feedback.',
                ], 500);
            }

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while processing the request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




}