<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Complain;
use App\Models\Food;
use DB;

class ClientListController extends Controller
{
    public function ClientPage()
    {
        return view('backend.pages.client.client-list');
    }


    public function ClientList(Request $request)
    {
        try {
            $clients = User::where('role', 'client')
                ->withCount(['foods' => function ($query) {
                    $query->where('status', '!=', 'pending');
                }])
                ->withCount(['ordersBasedOnRole as total_orders'])
                ->withCount(['foods as total_complaints' => function ($query) {
                    $query->whereHas('order.complain');
                }])
                ->withCount(['ordersBasedOnRole as total_customers' => function ($query) {
                    $query->select(DB::raw('count(distinct user_id)'));
                }])
                ->latest()
                ->get();

            if ($clients->isEmpty()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Clients not found',
                ], 404);
            }

            $clients = $clients->map(function ($client) {
                return [
                    'id' => $client->id,
                    'firstName' => $client->firstName,
                    'lastName' => $client->lastName,
                    'email' => $client->email,
                    'mobile' => $client->mobile,
                    'image' => $client->image,
                    'created_at' => $client->created_at,
                    'non_pending_food_count' => $client->foods_count,
                    'total_orders' => $client->total_orders, 
                    'total_complaints' => $client->total_complaints, 
                    'total_customers' => $client->total_customers, 
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $clients
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving clients',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function ClientDetailsPage()
    {
        return view('backend.pages.client.client-details');
    }


    public function ClientDetailsInfo($client_id)
    {
        try {
            $client = User::where('id', $client_id)
                ->where('role', 'client')
                ->withCount(['foods' => function ($query) {
                    $query->where('status', '!=', 'pending');
                }])
                ->withCount(['ordersBasedOnRole as total_orders'])
                ->withCount(['foods as total_complaints' => function ($query) {
                    $query->whereHas('order.complain');
                }])
                ->withCount(['ordersBasedOnRole as total_customers' => function ($query) {
                    $query->select(DB::raw('count(distinct user_id)'));
                }]) 
                ->first();

            if (!$client) { 
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No client found with this ID',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $client
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving the customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function OrderListPageByClient()
    {
        return view('backend.pages.client.order-list-by-client');
    }
    

    public function OrderListByClient($client_id)
    {
        try {
            $orders = Order::with('user', 'food')->where('client_id',$client_id)->latest()->get();

            if ($orders->isEmpty()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Order information not found',
                ], 404); 
            }

            return response()->json([
                'status' => 'success',
                'data' => $orders
            ], 200); 

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function ComplainListPageByClient()
    {
        return view('backend.pages.client.complain-list-by-client');
    }


    public function ComplainListByClient($client_id)
    {
        try {
            $complains = Complain::with(['order', 'food.user', 'user'])
                ->whereHas('order', function ($query) use ($client_id) {
                    $query->where('client_id', $client_id);
                })
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


    public function CustomerListPageByClient()
    {
        return view('backend.pages.client.customer-list-by-client');
    }


    public function CustomerListByClient($client_id)
    {
        try {
            $customerIds = Order::where('client_id', $client_id)
                ->distinct('user_id')
                ->pluck('user_id'); 

            $customers = User::whereIn('id', $customerIds)
                ->where('role', 'user') 
                 ->withNonPendingFoodCount()
                 ->latest()
                ->get();

            if ($customers->isEmpty()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No customers found for this client',
                ], 404);
            }

            $customers = $customers->map(function ($customer) {
                return [
                    'id' => $customer->id,
                    'firstName' => $customer->firstName,
                    'lastName' => $customer->lastName,
                    'email' => $customer->email,
                    'mobile' => $customer->mobile,
                    'image' => $customer->image,
                    'created_at' => $customer->created_at,
                    'non_pending_food_count' => $customer->foods_count, 
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $customers
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving clients',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function FoodListPageByClient()
    {
        return view('backend.pages.client.food-list-by-client');
    }


    public function FoodListByClient($client_id)
    {
        try {
            $foods = Food::with('user')->where('user_id', $client_id)->latest()->get();

            if ($foods->isEmpty()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Food not found',
                ], 404); 
            }

            return response()->json([
                'status' => 'success',
                'data' => $foods
            ], 200); 

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving foods',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}