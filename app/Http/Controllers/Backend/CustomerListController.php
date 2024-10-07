<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Complain;

class CustomerListController extends Controller
{
    public function CustomerPage()
    {
        return view('backend.pages.customer.customer-list');
    }


    public function CustomerList(Request $request)
    {
        try {
            $customers = User::where('role', 'user')
                ->with(['orders', 'complains']) 
                ->withCount(['orders', 'complains']) 
                ->latest() 
                ->get();

            foreach ($customers as $customer) {
                $distinctClients = $customer->orders->pluck('client_id')->unique();
                $customer->clients_count = $distinctClients->count();
            }

            if ($customers->isEmpty()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Customers not found',
                ], 404); 
            }

            return response()->json([
                'status' => 'success',
                'data' => $customers
            ], 200); 

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving customers',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function CustomerDetailsPage()
    {
        return view('backend.pages.customer.customer-details');
    }


    public function CustomerDetailsInfo($customer_id)
    {
        try {
            $customer = User::where('id', $customer_id)
                ->where('role', 'user')
                ->withCount(['orders', 'complains'])  
                ->first();

            if (!$customer) { 
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No customer found with this ID',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $customer
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving the customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function OrderListPageByCustomer()
    {
        return view('backend.pages.customer.order-list-by-customer');
    }


    public function OrderListByCustomer($customer_id)
    {
        try {
            $order = Order::with('user','food','food.user','complain')->where('user_id',$customer_id)->get();
            return response()->json([
                'status' => 'success',
                'data' => $order
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Order information not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }


    public function ComplainListPageByCustomer()
    {
        return view('backend.pages.customer.complain-list-by-customer');
    }


    public function ComplainListByCustomer($customer_id)
    {
        try {
            $complains = Complain::with(['order', 'food.user', 'user'])->where('user_id', $customer_id)->latest()->get();

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

    public function ClientListPageByCustomer()
    {
        return view('backend.pages.customer.client-list-by-customer');
    }


    public function ClientListByCustomer($customer_id)
    {
        try {
            $clientIds = Order::where('user_id', $customer_id)
                ->distinct('client_id')
                ->pluck('client_id'); 

            $clients = User::whereIn('id', $clientIds)
                ->where('role', 'client') 
                 ->withNonPendingFoodCount()
                 ->latest()
                ->get();

            if ($clients->isEmpty()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No clients found for this customer',
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
                ];
            });

            // Return success response with client data
            return response()->json([
                'status' => 'success',
                'data' => $clients
            ], 200);

        } catch (Exception $e) {
            // Handle any exceptions
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving clients',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}