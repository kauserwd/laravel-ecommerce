<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use Session;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index(){
        $product= Product::paginate(4);
        $comment= comment::orderby('id','desc')->get();
        $reply= reply::all();
        return view('home.userhome', compact('product','comment','reply'));
    
    }



    public function redirect(){
        
        $usertype = Auth::user()->usertype;
        if($usertype== '1'){
            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_customer=user::all()->count();
            

            $order= order::all();
            $total_revenue=0;

            foreach($order as $order){
                $total_revenue = $total_revenue+$order->price;
            }

            $total_delevered= order::where('delevary_status','=','delevered')->get()->count();
            $total_processing= order::where('delevary_status','=','Processing')->get()->count();
           
            return view('admin.adminhome', compact(
                'total_product',
                'total_order',
                'total_customer',
                'total_revenue',
                'total_delevered',
                'total_processing',
                
        
            ));

        }else{

            $product= Product::paginate(4);
            $comment= comment::orderby('id','desc')->get();
            $reply= reply::all();
            return view('home.userhome', compact('product','comment','reply'));
        }
    }

    public function ProductView($id){
        $product= Product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id){
        if(Auth::id()){
            $user = Auth::user();
            $product = product::find($id);
            $cart = new cart;

            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;

            $cart->product_title=$product->title;

            if($product->price_discount!= null){
                $cart->price=$product->price_discount * $request->quantity;
            }else{
                $cart->price=$product->price * $request->quantity;
            }
           
            $cart->image=$product->image;
            $cart->product_id=$product->id;

            $cart->quantity=$request->quantity;
            $cart->save();
            
            Alert::success('Product Added Successfully','We have added product to the cart');
            return redirect()->back();
        }else{

            return redirect('login');
        }
    }

    public function ShowCart(){
        if(Auth::id()){
            $id=Auth::user()->id;
            $cart= cart::where('user_id','=',$id)->get();
            return view('home.Show_cart', compact('cart'));
        }else{

            return redirect('login');
        }
        
    }
    public function DeleteCart($id){

        $cart= cart::find($id);
        $cart->delete();
        return redirect()->back();

    }

    public function CashOrder(){
        $user=Auth::user();
        $userid = $user->id;
        $data= cart::where('user_id','=',$userid)->get();

        foreach($data as $data){
            $order = new order;
            
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;

            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->product_id;

            $order->payment_status='Cash on Delivery';
            $order->delevary_status='Processing';

            $order->save();

            $cart_id=$data->id;
            $cart = cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('message', 'We received your order. We will contact you Soon');
    }

    public function stripe($totalprice){
        return view('home.stripe',compact('totalprice'));
    }
    
    public function stripePost(Request $request){

    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    Stripe\Charge::create ([

            "amount" => $totalprice * 100,

            "currency" => "usd",

            "customer" => $request->stripeToken,

            "description" => "Thanks for payment",
    ]); 

  

    Session::flash('success', 'Payment successful!');

           

    return back();

    }
    public function ShowOrder(){
        if(Auth::id()){
            $user=Auth::user();
            $userid = $user->id;
            $order= order::where('user_id','=',$userid)->get();

            return view('home.order_user_home',compact('order'));

        }else{

            return redirect('login');
        }
    }

    public function CancelOrder($id){
        
        $order = order::find($id);
        $order->delevary_status ="You canceled the order";
        $order->save();
        return redirect()->back();

    }

    public function add_comment(Request $request){
        if(Auth::id()){
            $comment = new comment;
            $comment->name=Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment=$request->comment;

            $comment->save();
            return redirect()->back();

        }else{

            return redirect('login');
        }
    }
    public function add_reply(Request $request){
        if(Auth::id()){
            $reply = new reply;
            $reply->name=Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id=$request->commentId;
            $reply->reply=$request->reply;

            $reply->save();
            return redirect()->back();

        }else{

            return redirect('login');
        }
    }

    public function product_search(Request $request){

        $comment= comment::orderby('id','desc')->get();
        $reply= reply::all();

        $search_text= $request->search;
        $product = product::where('title','LIKE',"%$search_text%")->
                            orWhere('category','LIKE',"%$search_text%")->paginate(4);
        return view('home.userhome',compact('product','comment','reply'));
    }

    public function products(){
        
        $product= Product::paginate(4);
        $comment= comment::orderby('id','desc')->get();
        $reply= reply::all();
        return view('home.all_products',compact('product','comment','reply'));
    }

}
