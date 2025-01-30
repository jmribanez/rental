<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Payment;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userRole = Auth::user()->getRoleNames()[0];
        switch($userRole) {
            case 'Administrator':
            case 'Landlord':
                $counts = array();
                $properties = Property::all();
                $occupied = 0;
                foreach($properties as $p) {
                    if($p->activeContract() != null)
                        $occupied++;
                }
                $tenants = User::whereHas('roles', function ($query) {
                    $query->where('name', 'Tenant');
                }, 1)->get();
                $tenantsForCollection = 0;
                $amountForCollection = 0;
                foreach($tenants as $t) {
                    if($t->getBalanceRaw() > 0) {
                        $tenantsForCollection++;
                        $amountForCollection += $t->getBalanceRaw();
                    }
                }
                $counts['properties'] = count($properties);
                $counts['tenants'] = count($tenants);
                $counts['forCollection'] = $amountForCollection;
                $counts['tenantsForCollection'] = $tenantsForCollection;
                $counts['collectionToDate'] = Payment::sum('amount');
                $counts['occupied'] = $occupied;
                $counts['vacant'] = count($properties) - $occupied;
                $collectionData = $this->getPastMonths(12);
            
                return view('pages.home.admin')
                    ->with('counts', $counts)
                    ->with('collectionData', $collectionData);
                break;
            case 'Staff':
                return view('pages.home.staff');
                break;
            default:
                $status = '';
                $contract = null;
                $paymentHistory = Auth::user()->tenantPayments();
                if(Auth::user()->activeContract() != null) {
                    $contract = Auth::user()->activeContract();
                    $status = 'Active';
                } else if(Auth::user()->lastContract() != null) {
                    $contract = Auth::user()->lastContract();
                    $status = 'Last';
                }
                return view('pages.home.tenant')
                    ->with('contract',$contract)
                    ->with('status', $status)
                    ->with('paymentHistory', $paymentHistory);
                break;
        }
        return view('regularhome');
    }

    public function report($year, $month) {
        $start_date = date_create($year."-".$month."-01");
        $end_date = date_create(date('Y-m-d', strtotime("-1 day", strtotime("+1 month", strtotime(date_format($start_date,"Y-m-d"))))));
        $properties = Property::all(); // implement by landlord soon
        $payments = Payment::where('date_payment','<=',date_format($end_date, "Y-m-d"))->where('date_payment','>=',date_format($start_date, "Y-m-d"))->orderBy('date_payment','DESC')->get();
        $tenants = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tenant');
        }, 1)->get();
        $tenantsWithArrears = new Collection();
        foreach($tenants as $i => $t) {
            $contractCount = $t->contracts->where('date_start','<=',date_format($start_date, "Y-m-d"))->count();
            if($contractCount < 1)
                continue;
            if($t->getBalanceRawUntil(date_format($end_date, "Y-m-d")) > 0) {
                $tenantsWithArrears->push($t);
            }
        }
        return view('pages.home.report')
            ->with('start_date', $start_date)
            ->with('end_date', $end_date)
            ->with('properties', $properties)
            ->with('payments', $payments)
            ->with('tenants', $tenantsWithArrears);
    }

    private function getPastMonths($months) {
        $displayMonths = array();
        $displayAmount = array();
        $startdate = date_create(date("Y-m-01"));
        $enddate = date_create(date("Y-m-t"));
        while($months > 0) {
            $collectionsForMonth = 0;
            array_push($displayMonths, date_format($startdate, "M"));
            $collectionsForMonth += Payment::where('date_payment','>=',date_format($startdate,"Y-m-d"))->where('date_payment','<=',date_format($enddate,"Y-m-d"))->sum('amount');
            array_push($displayAmount, $collectionsForMonth);
            $months--;
            date_sub($startdate,date_interval_create_from_date_string("1 month"));
            $enddate = date_create(date_format($startdate,"Y-m-t"));
        }
        return array($displayMonths, $displayAmount);
    }
}
