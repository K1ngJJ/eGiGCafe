<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Reservation;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     public function index() {
        $user = Auth::user();
        
    
        if ($user && $user->role == 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user && $user->role == 'kitchenStaff') {
            return redirect()->route('kitchenOrder');
        }
    
        // If the user is not redirected by role, check if the email is verified
        if ($user && !$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

         // Best Reservation Month
         $bestReservationMonth = Reservation::selectRaw('MONTH(res_date) as month, COUNT(*) as count')
         ->where('status', 'Fulfilled')
         ->groupBy('month')
         ->orderByDesc('count')
         ->first();
 
         // Best Events or Services
         $bestEventOrService = Reservation::join('services', 'reservations.service_id', '=', 'services.id')
         ->selectRaw('services.name, COUNT(*) as count')
         ->where('reservations.status', 'Fulfilled')
         ->groupBy('services.name')
         ->orderByDesc('count')
         ->first();
 
          // Format data for JavaScript
         $reservationMonthData = $bestReservationMonth ? [
             'month' => $bestReservationMonth->month,
             'count' => $bestReservationMonth->count,
         ] : null;
 
         $eventOrServiceData = $bestEventOrService ? [
             'name' => $bestEventOrService->name,
             'count' => $bestEventOrService->count,
         ] : null;



         
        // General variables useful for all charts / graphs
        $lastMonthDate = Carbon::now()->subDays(30)->toDateTimeString();
        $today = Carbon::today()->toDateString();
        $oneMonthTransactions = Transaction::where('created_at', '>=', $lastMonthDate)->get();
        
        // ================   Calculate Revenue   ========================
        $totalRevenue = $oneMonthTransactions->sum("final_amount");
        // $dailyRevenue will store date-revenue pair for the past 30 days
        $dailyRevenue = Transaction::select(
            DB::raw('date(created_at) as date'), DB::raw('SUM(final_amount) as revenue'))
            ->where('created_at', '>=', $lastMonthDate)
            ->groupBy('date')->orderBy('date')->get();
        // =============   End of Calculate Revenue   =====================

        // ================   Calculate Estimated Cost   =====================
        $totalCost = 0;
        foreach ($oneMonthTransactions as $transaction) {
            $totalCost += $transaction->order->getTotalCost();
        }
        // ===============   End of Calculate Estimated Cost   ===============

        // ================   Calculate Gross Profit   =====================
        $grossProfit = $totalRevenue - $totalCost;
        // ================   End of Calculate Gross Profit   =====================

        // ================   Total Orders   =====================
        $totalOrders = $oneMonthTransactions->count();
        $dailyOrders = Order::select(
            DB::raw('date(dateTime) as date'), DB::raw('COUNT(*) as orders'))
            ->where('created_at', '>=', $lastMonthDate)
            ->groupBy('date')->orderBy('date')->get();
        // =============   End of Total Orders   =====================
       // ================ Product Category =====================
        $categoricalSales = [0, 0, 0, 0, 0, 0, 0, 0]; // Initialize all category totals to 0
        foreach ($oneMonthTransactions as $transaction) {
            $cartItems = $transaction->order->cartItems;

            foreach ($cartItems as $item) {
                $itemType = $item->menu->type;
                $itemPrice = $item->menu->price;
                $itemQty = $item->quantity;

                switch($itemType) {
                    case "Silog":
                        $categoricalSales[0] += $itemPrice * $itemQty;
                        break;
                    case "Sandwich":
                        $categoricalSales[1] += $itemPrice * $itemQty;
                        break;
                    case "Burger":
                        $categoricalSales[2] += $itemPrice * $itemQty;
                        break;
                    case "Pasta":
                        $categoricalSales[3] += $itemPrice * $itemQty;
                        break;
                    case "Snacks":
                        $categoricalSales[4] += $itemPrice * $itemQty;
                        break;
                    case "MilkTea":
                        $categoricalSales[5] += $itemPrice * $itemQty;
                        break;
                    case "FruitTea":
                        $categoricalSales[6] += $itemPrice * $itemQty;
                        break;
                    case "Etc.":
                        $categoricalSales[7] += $itemPrice * $itemQty;
                        break;
                }
            }
        }

        // Format the sales with two decimal points
        for ($i = 0; $i < count($categoricalSales); $i++) {
            $categoricalSales[$i] = number_format((float)$categoricalSales[$i], 2, '.', '');
        }
        // ============= End of Product Category =====================

         // =============   Best Selling Product   =====================
        $productSales = array();

        foreach ($oneMonthTransactions as $transaction) {
            $cartItems = $transaction->order->cartItems;

            foreach ($cartItems as $item) {
                $itemName = $item->menu->name;
                $itemQty = $item->quantity;

                // Add to product sales count
                if (isset($productSales[$itemName])) {
                    $productSales[$itemName] += $itemQty; // Increment quantity
                } else {
                    $productSales[$itemName] = $itemQty;
                }
            }
        }

        arsort($productSales);
        $finalProductSales = array();

        foreach ($productSales as $product => $sale_count) {
            // Fetch image from the menus table for this product
            $menuItem = \App\Models\Menu::where('name', $product)->first(); // Ensure you import the Menu model
            $temp = array();
            $temp['x'] = $product;
            $temp['y'] = $sale_count;
            $temp['image'] = $menuItem ? $menuItem->image : ''; // Assign image if found
            array_push($finalProductSales, $temp);
        }

        $finalProductSales = json_encode($finalProductSales);

        $sortedSales = collect(json_decode($finalProductSales))->sortByDesc('y')->take(3);
        // =============   End of Best Selling Product   =====================

    
         return view('home', compact("eventOrServiceData", "reservationMonthData", "sortedSales"));
    }



    public function guest() {
           // Best Reservation Month
           $bestReservationMonth = Reservation::selectRaw('MONTH(res_date) as month, COUNT(*) as count')
           ->where('status', 'Fulfilled')
           ->groupBy('month')
           ->orderByDesc('count')
           ->first();
   
           // Best Events or Services
           $bestEventOrService = Reservation::join('services', 'reservations.service_id', '=', 'services.id')
           ->selectRaw('services.name, COUNT(*) as count')
           ->where('reservations.status', 'Fulfilled')
           ->groupBy('services.name')
           ->orderByDesc('count')
           ->first();
   
            // Format data for JavaScript
           $reservationMonthData = $bestReservationMonth ? [
               'month' => $bestReservationMonth->month,
               'count' => $bestReservationMonth->count,
           ] : null;
   
           $eventOrServiceData = $bestEventOrService ? [
               'name' => $bestEventOrService->name,
               'count' => $bestEventOrService->count,
           ] : null;
  
  
  
           
          // General variables useful for all charts / graphs
          $lastMonthDate = Carbon::now()->subDays(30)->toDateTimeString();
          $today = Carbon::today()->toDateString();
          $oneMonthTransactions = Transaction::where('created_at', '>=', $lastMonthDate)->get();
          
          // ================   Calculate Revenue   ========================
          $totalRevenue = $oneMonthTransactions->sum("final_amount");
          // $dailyRevenue will store date-revenue pair for the past 30 days
          $dailyRevenue = Transaction::select(
              DB::raw('date(created_at) as date'), DB::raw('SUM(final_amount) as revenue'))
              ->where('created_at', '>=', $lastMonthDate)
              ->groupBy('date')->orderBy('date')->get();
          // =============   End of Calculate Revenue   =====================
  
          // ================   Calculate Estimated Cost   =====================
          $totalCost = 0;
          foreach ($oneMonthTransactions as $transaction) {
              $totalCost += $transaction->order->getTotalCost();
          }
          // ===============   End of Calculate Estimated Cost   ===============
  
          // ================   Calculate Gross Profit   =====================
          $grossProfit = $totalRevenue - $totalCost;
          // ================   End of Calculate Gross Profit   =====================
  
          // ================   Total Orders   =====================
          $totalOrders = $oneMonthTransactions->count();
          $dailyOrders = Order::select(
              DB::raw('date(dateTime) as date'), DB::raw('COUNT(*) as orders'))
              ->where('created_at', '>=', $lastMonthDate)
              ->groupBy('date')->orderBy('date')->get();
          // =============   End of Total Orders   =====================
         // ================ Product Category =====================
          $categoricalSales = [0, 0, 0, 0, 0, 0, 0, 0]; // Initialize all category totals to 0
          foreach ($oneMonthTransactions as $transaction) {
              $cartItems = $transaction->order->cartItems;
  
              foreach ($cartItems as $item) {
                  $itemType = $item->menu->type;
                  $itemPrice = $item->menu->price;
                  $itemQty = $item->quantity;
  
                  switch($itemType) {
                      case "Silog":
                          $categoricalSales[0] += $itemPrice * $itemQty;
                          break;
                      case "Sandwich":
                          $categoricalSales[1] += $itemPrice * $itemQty;
                          break;
                      case "Burger":
                          $categoricalSales[2] += $itemPrice * $itemQty;
                          break;
                      case "Pasta":
                          $categoricalSales[3] += $itemPrice * $itemQty;
                          break;
                      case "Snacks":
                          $categoricalSales[4] += $itemPrice * $itemQty;
                          break;
                      case "MilkTea":
                          $categoricalSales[5] += $itemPrice * $itemQty;
                          break;
                      case "FruitTea":
                          $categoricalSales[6] += $itemPrice * $itemQty;
                          break;
                      case "Etc.":
                          $categoricalSales[7] += $itemPrice * $itemQty;
                          break;
                  }
              }
          }
  
          // Format the sales with two decimal points
          for ($i = 0; $i < count($categoricalSales); $i++) {
              $categoricalSales[$i] = number_format((float)$categoricalSales[$i], 2, '.', '');
          }
          // ============= End of Product Category =====================
  
           // =============   Best Selling Product   =====================
          $productSales = array();
  
          foreach ($oneMonthTransactions as $transaction) {
              $cartItems = $transaction->order->cartItems;
  
              foreach ($cartItems as $item) {
                  $itemName = $item->menu->name;
                  $itemQty = $item->quantity;
  
                  // Add to product sales count
                  if (isset($productSales[$itemName])) {
                      $productSales[$itemName] += $itemQty; // Increment quantity
                  } else {
                      $productSales[$itemName] = $itemQty;
                  }
              }
          }
  
          arsort($productSales);
          $finalProductSales = array();
  
          foreach ($productSales as $product => $sale_count) {
              // Fetch image from the menus table for this product
              $menuItem = \App\Models\Menu::where('name', $product)->first(); // Ensure you import the Menu model
              $temp = array();
              $temp['x'] = $product;
              $temp['y'] = $sale_count;
              $temp['image'] = $menuItem ? $menuItem->image : ''; // Assign image if found
              array_push($finalProductSales, $temp);
          }
  
          $finalProductSales = json_encode($finalProductSales);
  
          $sortedSales = collect(json_decode($finalProductSales))->sortByDesc('y')->take(3);
          // =============   End of Best Selling Product   =====================
  
      
           return view('guest', compact("eventOrServiceData", "reservationMonthData", "sortedSales"));
    }

    

    
}
