<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     * @param $event
     * @param Request $request
     */
    public function handleUserLogin($event) {
        auth()->user()->attendances()->firstOrCreate([
            'date'=> Carbon::today()->format('Y-m-d')
        ], [
            'login_time'=> Carbon::now()->format('H:i:s'),
            'login_ip'=> \request()->getClientIp()
        ]);
    }

    /**
     * Handle user logout events.
     * @param $event
     * @param Request $request
     */
    public function handleUserLogout($event) {
        $loginUser = $event->user->attendances()->where('date', Carbon::today()->format('Y-m-d'))->where('logout_time', null)->first();
        if(!empty($loginUser)){
            $loginUser->update([
                'logout_time'=> Carbon::now()->format('H:i:s'),
                'logout_ip'=> \request()->getClientIp()
            ]);
        }else{
            $event->user->attendances()->create([
                'date'=> Carbon::today()->format('Y-m-d'),
                'logout_time'=> Carbon::now()->format('H:i:s'),
                'login_ip'=> \request()->getClientIp()
            ]);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            [UserEventSubscriber::class, 'handleUserLogin']
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            [UserEventSubscriber::class, 'handleUserLogout']
        );
    }
}
