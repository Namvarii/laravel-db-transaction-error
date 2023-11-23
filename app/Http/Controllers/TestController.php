<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testOne()
    {

        \DB::beginTransaction();
        try {
            $order = Order::create([
                'a' => 'aa',
                'b' => 'bb',
                'c' => 'cc',
            ]);

            // error 1
            throw new \Exception("I'm an error!!!");
            $order->notes()->create([
                'type' => 2,
                'error' => '!!!' // error 2 | cause throw error
            ]);

            $order->transaction()->create(["tt" => "ttt"]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return "error";
        }

        \DB::commit();
        return "success";

    }

    public function testTwo()
    {

        \DB::transaction(function(){
            $order = Order::create([
                'a' => 'aa',
                'b' => 'bb',
                'c' => 'cc',
            ]);

            // error 1
            throw new \Exception("I'm an error!!!");
            $order->notes()->create([
                'type' => 2,
                'error' => '!!!' // error 2 | cause throw error
            ]);

            $order->transaction()->create(["tt" => "ttt"]);
        });

        return "success";

    }
}
