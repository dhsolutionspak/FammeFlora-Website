<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Session;
use DB;
use Hash;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        return view('admin.notification.index', ['data' => $data]);
    }

    public function store(Request $request)
    {

        //if image
        $fileName = '';
        $imageURL = null;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $extension = $request['image']->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $file->move(public_path() . '/notificationImages', $fileName);
            $imageURL = url('/') . '/notificationImages/' . $fileName;
        }

        //  foreach ($chunkToken as $key => $arrChunk) {
        $this->sendFirebaseNotification([], $request->name, $request->body, $request->link, $imageURL);
        //}

        return redirect(route('notifications'))->with('success', 'Notification Successfully Send!');
    }

    public function sendFirebaseNotification($fb_key_array, $title, $message, $link, $imageURL)
    {
        $authorization_key = env('FIREBASE_SERVER_KEY');

        $finalPostArray = array(
            'to' => '/topics/otrixcommercelaravelpromotion',
            'notification' => array(
                'body' => $message,
                'title' => $title,
                "image" => $imageURL,

                "sound" => '1',
                "vibrate" => '1',
            ),
            "data" => array(
                "click_action" => "NO ACTION BRO",
                "link" => $link,
                'bodytitle' => $title,
                'body' => $message,
                "image" => $imageURL,
                "type" => "prmotional",
                "sound" => "default",
                "status" => "done"
            ),
            'android' => array(

            )

        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($finalPostArray)); //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: key=' . $authorization_key));
        $server_output = curl_exec($ch);

        curl_close($ch);

    }

}