<?php

namespace App\Http\Controllers;

use App\Events\NewTrade;
use App\Events\GroupChat;
use App\Models\Chat;
use App\Models\Group;
use App\Models\GroupChat as GroupChating;
use App\Models\Notification;
use App\Models\TutorSubjectOffer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function Studentchat()
    {

           if(Auth::user()->role_id != 4){
                return  back();
            }


        $tutors = [];

        $chatsUsers = Chat::where('sender_id', Auth::id())->pluck('reciver_id')->unique();

        $c_users = User::whereIn('id', $chatsUsers)->where('id', '!=', Auth::id())->get();
        $j = 0;
        foreach ($c_users as $i => $user) {

            $tutors[$i]['id'] = $user->id;
            $tutors[$i]['username'] = $user->username == ''? $user->first_name.' '.$user->last_name:$user->username;
            $tutors[$i]['image'] = $user->image;
            $tutors[$i]['facebook_link'] = $user->facebook_link;

            $j++;
        }

        $chatsUsers = Chat::where('reciver_id', Auth::id())->pluck('sender_id')->unique();

        foreach (User::whereIn('id', $chatsUsers)->where('id', '!=', Auth::id())->get() as $i => $user) {

            $tutors[$i]['id'] = $user->id;
            $tutors[$i]['username'] = $user->username == ''? $user->first_name.' '.$user->last_name:$user->username;
            $tutors[$i]['image'] = $user->image;

            $j++;
        }

        // dd($tutors);

        return view('pages.chat.index', compact('tutors'));
    }



        public function Parentchat()
    {

           if(Auth::user()->role_id != 5){
                return  back();
            }


        $tutors = [];

        $chatsUsers = Chat::where('sender_id', Auth::id())->pluck('reciver_id')->unique();

        $c_users = User::whereIn('id', $chatsUsers)->where('id', '!=', Auth::id())->get();
        $j = 0;
        foreach ($c_users as $i => $user) {

            $tutors[$i]['id'] = $user->id;
            $tutors[$i]['username'] = $user->username == ''? $user->first_name.' '.$user->last_name:$user->username;
            $tutors[$i]['image'] = $user->image;
            $tutors[$i]['facebook_link'] = $user->facebook_link;

            $j++;
        }

        $chatsUsers = Chat::where('reciver_id', Auth::id())->pluck('sender_id')->unique();

        foreach (User::whereIn('id', $chatsUsers)->where('id', '!=', Auth::id())->get() as $i => $user) {

            $tutors[$i]['id'] = $user->id;
            $tutors[$i]['username'] = $user->username == ''? $user->first_name.' '.$user->last_name:$user->username;
            $tutors[$i]['image'] = $user->image;

            $j++;
        }

        // dd($tutors);

        return view('pages.chat.index', compact('tutors'));
    }


            public function Organizationchat()
    {

           if(Auth::user()->role_id != 6){
                return  back();
            }


        $tutors = [];

        $chatsUsers = Chat::where('sender_id', Auth::id())->pluck('reciver_id')->unique();

        $c_users = User::whereIn('id', $chatsUsers)->where('id', '!=', Auth::id())->get();
        $j = 0;
        foreach ($c_users as $i => $user) {

            $tutors[$i]['id'] = $user->id;
            $tutors[$i]['username'] = $user->username == ''? $user->first_name.' '.$user->last_name:$user->username;
            $tutors[$i]['image'] = $user->image;
            $tutors[$i]['facebook_link'] = $user->facebook_link;

            $j++;
        }

        $chatsUsers = Chat::where('reciver_id', Auth::id())->pluck('sender_id')->unique();

        foreach (User::whereIn('id', $chatsUsers)->where('id', '!=', Auth::id())->get() as $i => $user) {

            $tutors[$i]['id'] = $user->id;
            $tutors[$i]['username'] = $user->username == ''? $user->first_name.' '.$user->last_name:$user->username;
            $tutors[$i]['image'] = $user->image;

            $j++;
        }

        // dd($tutors);

        return view('pages.chat.index', compact('tutors'));
    }

        public function Tutorchat()
    {

           if(Auth::user()->role_id != 3){
                return  back();
            }


        $tutors = [];

        $chatsUsers = Chat::where('sender_id', Auth::id())->pluck('reciver_id')->unique();

        $c_users = User::whereIn('id', $chatsUsers)->where('id', '!=', Auth::id())->get();
        $j = 0;
        foreach ($c_users as $i => $user) {

            $tutors[$i]['id'] = $user->id;
            $tutors[$i]['username'] = $user->username == ''? $user->first_name.' '.$user->last_name:$user->username;
            $tutors[$i]['image'] = $user->image;
            $tutors[$i]['facebook_link'] = $user->facebook_link;

            $j++;
        }

        $chatsUsers = Chat::where('reciver_id', Auth::id())->pluck('sender_id')->unique();

        foreach (User::whereIn('id', $chatsUsers)->where('id', '!=', Auth::id())->get() as $i => $user) {

            $tutors[$i]['id'] = $user->id;
            $tutors[$i]['username'] = $user->username == ''? $user->first_name.' '.$user->last_name:$user->username;
            $tutors[$i]['image'] = $user->image;

            $j++;
        }

        // dd($tutors);

        return view('pages.chat.index', compact('tutors'));
    }

    public function index($id)
    {

        Chat::where('sender_id', $id)->update(['status' => 1,]);

        $senderId = $id;
        $receiverId = Auth::id();
        $chats = Chat::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('reciver_id', $receiverId);
        })
            ->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('reciver_id', $senderId);
            })
            ->get();
        return view('pages.dashboard.welcome', compact('chats', 'id'));
    }

    public function singlechat($id)
    {

        if (Auth::user()->role_id == '3' && User::find($id)->role_id == '3') {
            return back()->with('error', 'Sorry You Cannot Chat with Tutor');
        }
        Chat::where('sender_id', $id)->update(['status' => 1,]);
        $subject = TutorSubjectOffer::where('tutor_id', $id);
        $senderId = $id;
        $receiverId = Auth::id();
        $chats = Chat::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('reciver_id', $receiverId);
        })
            ->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('reciver_id', $senderId);
            })
            ->get();
        return view('pages.chat.singlechat', compact('chats', 'id', 'subject'));
    }
    public function send_message(Request $request)
    {
        // event(new NewTrade($request->reciver_id, $request->message));

        // $user = User::where(function($query) use ($request) {
        //         $query->where('id', Auth::id());
        //             //   ->where('first_name', 'like', "%" . $request->message . "%")
        //             //   ->orWhere('last_name', 'like', "%" . $request->message . "%");
        //     })
        //     ->first();

        // if (empty($user)) {
        $chat = new Chat();
        $chat->reciver_id = $request->reciver_id;
        $chat->sender_id = Auth::id();
        $chat->message = $request->message;
        $chat->save();

        return response()->json(['status' => 'true']);
        // }
        // else {
        //     return response()->json(['status' => 'false']);
        // }
    }

    public function get_message(Request $request)
    {

        $senderId = $request->id;
        $receiverId = Auth::id();
        $chats = Chat::with(['sender', 'reciver'])->where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('reciver_id', $receiverId);
        })
            ->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('reciver_id', $senderId);
            })
            ->get();
        return response()->json(['chats' => $chats]);
    }


    public function chat_with_students()
    {
        $chats = GroupChating::All();
        $groups = Group::All();
        return view('pages.dashboard.group_chats2', compact('chats', 'groups'));
    }
    public function chat_send_to_student(Request $request)
    {
        if (!empty($request->group)) {
            // event(new GroupChat($request->group,Auth::id(),$request->message));
            $chat = new GroupChating();
            $chat->sender_id = Auth::id();
            $chat->group_id = $request->group;
            $chat->message = $request->message;
            $chat->save();
            return $chat;
        }
    }

    public function create_group(Request $request)
    {

        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $user = new Group();


        $user->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
            'image' => 'images/' . $imageName,
        ]);
        return back();
    }

    public function get_chat(Request $request)
    {
        $chats = GroupChating::where('group_id', $request->id)->get();
        $html = '';

        if (!empty($chats)) {
            foreach ($chats as $chat) {
                if ($chat->sender_id == Auth::id()) {
                    $html .= '
                    <li class="me">
                        <div class="entete">
                            <h3>10:12AM</h3>
                            <h2>' . User::find($chat->sender_id)->first_name . ' ' . User::find($chat->sender_id)->last_name . '</h2>
                            <span class="status blue"></span>
                        </div>

                        <div class="message">
                            ' . $chat->message . '
                        </div>
                    </li>';
                } else {
                    $check_sender = GroupChating::where('sender_id', Auth::id())->first();
                    if (!empty($check_sender) || $chats[0]->sender_id == Auth::user()->parent_id) {
                        $html .= '
                        <li class="you">
                            <div class="entete">
                                <span class="status green"></span>
                                <h2>' . User::find($chat->sender_id)->first_name . ' ' . User::find($chat->sender_id)->last_name . '</h2>
                                <h3>10:12AM</h3>
                            </div>

                            <div class="message">
                                ' . $chat->message . '
                            </div>
                        </li>';
                    }
                }
            }
        }
        return $html;
    }
    public function get_notification()
    {
        $notifications = Notification::where('is_read', 0)->get();
        $notificationCount = Notification::with('Notifier')->where('is_read', 0)->whereHas('Notifier', function ($query) {
            $query->whereNotNull('id');
        })->count();
        $html = '';

        if (!empty($notifications)) {
            foreach ($notifications as $notification) {

                $checkUser = User::find($notification->user_id);
                if (!empty($checkUser)) {
                    if ($notification->user_type == 3 || $notification->title == 'Tutor Logout') {
                        $url = url('tutorProfile') . '/' . $notification->user_id . '?NoteId=' . $notification->id;
                    } elseif ($notification->user_type == 4 && $notification->title == 'Complaint') {
                        $url = 'Complaintlogs';
                    } elseif ($notification->user_type == 5 && $notification->title == 'Parent Signup') {
                        $url = 'parents';
                    } elseif ($notification->user_type == 6 && $notification->title == 'Organization Signup') {
                        $url = 'organizations';
                    } elseif ($notification->user_type == 4 && $notification->title == 'Student Signup'){
                        $url = 'students';
                    } elseif ($notification->title == 'New Booking'){
                        $url = 'AdminBookings';
                    } elseif ($notification->title == 'Refound Request'){
                        $url = 'admin/RefundList';
                    } elseif ($notification->title == 'Rescheduled Meeting'){
                        $url = 'AdminBookings';
                    } elseif ($notification->title == 'Apperove Rescheduled Meeting'){
                        $url = 'AdminBookings';
                    } elseif ($notification->title == 'Add Amount To Wallet'){
                        $url = 'transaction';
                    } elseif ($notification->title == 'Amount to be refunded'){
                        $url = 'admin/RefundList';
                    } elseif ($notification->title == 'Refunded Request Processing'){
                        $url = 'admin/RefundList';
                    } elseif ($notification->title == 'Cancelled Booking' || $notification->title == 'Cancelled By User Booking' || $notification->title == 'Cancelled By Tutor Booking'){
                        $url = 'AdminBookings';
                    } elseif ($notification->title == 'Pending Booking'){
                        $url = 'AdminBookings';
                    } elseif ($notification->title == 'Scheduled Booking'){
                        $url = 'AdminBookings';
                    } elseif ($notification->title == 'In Process Booking'){
                        $url = 'AdminBookings';
                    } elseif ($notification->title == 'Completed Booking'){
                        $url = 'AdminBookings';
                    } elseif ($notification->title == 'Student Logout'){
                        $url = 'students';
                    } elseif ($notification->title == 'Parent Logout'){
                        $url = 'parents';
                    } elseif ($notification->title == 'Organization Logout'){
                        $url = 'organizations';
                    }


                    $html .= '<a href="' . $url . '" class="list-group-item" data-chat-user="' . optional(User::find($notification->user_id))->username . '">
                            <figure class="">
                                <img src="';

                        if (!empty(User::find($notification->user_id)->image) && file_exists(public_path(!empty(User::find($notification->user_id)->image) ? User::find($notification->user_id)->image : ''))) {
                            $html .= asset(User::find($notification->user_id)->image);
                        } else {
                            if (User::find($notification->user_id)->gender == 'Male') {
                                $html .= asset('assets/images/male.jpg');
                            } elseif (User::find($notification->user_id)->gender == 'Female') {
                                $html .= asset('assets/images/female.jpg');
                            } else {
                                $html .= asset('assets/images/default.jpg');
                            }
                        }

                $html .= '" class="rounded-circle" alt="">
                            </figure><span><span class="name">' . optional(User::find($notification->user_id))->username . '</span>  <span class="username">' . $notification->title . '</span> </span>
                        </a>';
                }else{
                    if($notification->title == 'Newsletter'){
                        $html .= '<a href="' . url('newsletter') . '" class="list-group-item" data-chat-user="newsletter">
                            <figure class="">
                                <img src="'.asset('assets/images/male.jpg').'" class="rounded-circle" alt="">
                            </figure><span><span class="name">New Subscriber</span>  <span class="username">' . $notification->title . '</span> </span>
                        </a>';
                    }else if($notification->title == 'Chat Support'){
                        $html .= '<a href="' . url('newsletter') . '" class="list-group-item" data-chat-user="newsletter">
                            <figure class="">
                                <img src="'.asset('assets/images/male.jpg').'" class="rounded-circle" alt="">
                            </figure><span><span class="name">Chat Support</span>  <span class="username" style="font-size: 13px;">' . $notification->description . '</span> </span>
                        </a>';

                    }

                }
            }
        }

        return response()->json(['html' => $html, 'count' => $notificationCount]);
    }
}
