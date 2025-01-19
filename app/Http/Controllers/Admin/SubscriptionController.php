<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Subscription;

use App\Traits\WHMCS;

class SubscriptionController extends Controller
{
    use WHMCS;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $subscriptions = Subscription::orderBy('next_payment_date', 'ASC')->get();

        return view('admin.subscriptions')
            ->with('subscriptions', $subscriptions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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


    public function synchronize()
    {
        DB::beginTransaction();

        try {
            $suscribedCustomers = $this->getSubscribedCustomers();

            foreach ($suscribedCustomers as $customer) {
                $subscription = Subscription::where('client_id', $customer->id)->first();

                if (!$subscription) {
                    $subscription = new Subscription();
                    $subscription->firstname = $customer->firstname;
                    $subscription->lastname = $customer->lastname;
                    $subscription->email = $customer->email;
                    $subscription->phonenumber = $customer->phonenumber;
                    $subscription->client_id = $customer->id;
                    $subscription->next_payment_date = now(); 
                    $subscription->link = null;

                    $subscription->save();
                }
            }

            DB::commit();

            return redirect()->route('admin/subscriptions/index')->with('success', 'Suscripciones sincronizadas exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
           
            return redirect()->route('admin/subscriptions/index')->with('error', 'Hubo un error al sincronizar las suscripciones.');
        }
    }

    public function cancel(Request $request)
    {
        $subscription = Subscription::find($request->id);

        if ($subscription) {
            $subscription->delete();

            session()->flash('success', 'La suscripción se ha cancelado correctamente.');

        } else {
            session()->flash('error', 'No se encontró la suscripción.');
        }

        return redirect()->route('admin/subscriptions/index');
    }

    public function renew(Request $request)
    {
        $id = $request->id;
    
        $subscription = Subscription::find($id);
    
        if (! $subscription) {
            return redirect()->route('admin/subscriptions/index')->with('error', 'Suscripción no encontrada.');
        }
    
        $nextPaymentDate = Carbon::parse($subscription->next_payment_date);
    
        $subscription->next_payment_date = $nextPaymentDate->addMonth();

        $subscription->save();

        return redirect()->route('admin/subscriptions/index')->with('success', 'Suscripción renovada correctamente.');
        
    }

}
