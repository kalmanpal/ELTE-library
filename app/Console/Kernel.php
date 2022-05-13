<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {// checks if any subscriptions are expired

            $expiredSubs = DB::table('subscriptions')
            ->where('subscriptions.subexpiry',"<", Carbon::today())
            ->update(['subscriptions.active' => '0']);

        })->everyMinute();



        $schedule->call(function () {// checks if any reservations are expired

            $expiredReservations = DB::table('reservations')
            ->join('users', 'reservations.email', "=", 'users.email')
            ->join('stocks', 'reservations.isbn', "=", 'stocks.isbn')
            ->where('reservations.expiry',"<", Carbon::today())
            ->select('reservations.email as email', 'users.current as current', 'stocks.available_number as available_number', 'reservations.isbn as isbn')
            ->get();

            $isbnNumbers = $expiredReservations->countBy('isbn');
            $isbnKeys = $isbnNumbers->keys();

            for($i = 0; $i<$isbnKeys->count(); $i++)
            {
                $isbnValue = $isbnNumbers->get($isbnKeys[$i]);

                $stocks = DB::table('stocks')
                ->where('stocks.isbn', '=', $isbnKeys[$i])
                ->get();

                $stockToUpdate = DB::table('stocks')
                ->where('stocks.isbn', '=', $isbnKeys[$i])
                ->update(['stocks.available_number' => $stocks[0]->available_number + $isbnValue]);
            }

            $emails = $expiredReservations->countBy('email');
            $emailKeys = $emails->keys();

            for($i = 0; $i<$emailKeys->count(); $i++)
            {
                $emailValue = $emails->get($emailKeys[$i]);

                $users = DB::table('users')
                ->where('users.email', '=', $emailKeys[$i])
                ->get();

                $userToUpdate = DB::table('users')
                ->where('users.email', '=', $emailKeys[$i])
                ->update(['users.current' => $users[0]->current - $emailValue]);
            }

            $reservationsToDelete = DB::table('reservations')
            ->where('reservations.expiry',"<", Carbon::today())
            ->delete();

        })->dailyAt('00:00')->timezone('Europe/Budapest');



        $schedule->call(function () {// checks if any rentals are late + add daily fee

            $lateRents = DB::table('rentals')
            ->whereNull('rentals.in_date')
            ->where('rentals.deadline', '<', Carbon::today())
            ->get();

            $numberOfUsers = $lateRents->countBy('email');
            $userList = $numberOfUsers->keys();

            $dailyFee = 50;

            for($i = 0; $i<$userList->count(); $i++)
            {
                $dailyFeeSum = $numberOfUsers->get($userList[$i])*$dailyFee;

                $sub = DB::table('subscriptions')
                ->where('subscriptions.email', '=', $userList[$i])
                ->get();

                $subToUpdate = DB::table('subscriptions')
                ->where('subscriptions.email', '=', $userList[$i])
                ->update(['subscriptions.plus_charge' => $sub[0]->plus_charge + $dailyFeeSum]);
            }

        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
