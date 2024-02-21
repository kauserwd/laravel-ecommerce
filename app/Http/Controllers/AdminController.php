<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use PDF;
use Notification;
use App\Notifications\SendEmailNotifcation;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function ViewCategory(){
        if(Auth::id()){
            $data= Category::all();
            return view('admin.category', compact('data'));
        }else{

            return redirect('login');
        }
       
    }

    public function AddCategory(Request $request){
        $category= new Category;
        $category->category_name= $request->category_name;
        $category->save();

        return redirect()->back()->with('message','Category Update Successfully');
    }
    public function ShoCategory($id){
        $data= Category::find($id);
        return view('admin.update_category', compact('data'));
    }
    public function UpdateCategory(Request $request, $id){
        $data= Category::find($id);
        $data->category_name=$request->category_name;
        $data->save();
        return redirect()->back()->with('message','Category Update Successfully');
    }
    public function DeleteCategory($id){
        $data= Category::find($id);
        $data->delete();
        return redirect()->back();
    }

    /* products */
    public function ViewProducts(){
        $category= Category::all();
        return view('admin.add_products', compact('category'));
    }


    public function AddProducts(Request $request){
        $product= new product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->category=$request->category;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->price_discount=$request->price_discount;

        $image= $request->image;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('productimage',$imagename);
            $product->image= $imagename;
        }

        $product->save();
        return redirect()->back();

    }
    public function ShowProducts(){
        $product= Product::all();
        return view('admin.all_products',compact('product'));
    }
    public function updateShow($id){
        $product= Product::find($id);
        return view('admin.update_product',compact('product'));
    }
    public function UpdateProducts(Request $request, $id){

        if(Auth::id()){
            $product= Product::find($id);

            $product->title=$request->title;
            $product->description=$request->description;
            $product->category=$request->category;
            $product->quantity=$request->quantity;
            $product->price=$request->price;
            $product->price_discount=$request->price_discount;

            $image = $request->image;
            if($image){
                $imagename=time().'.'.$image->getClientOriginalExtension();
                $request->image->move('productimage',$imagename);
                $product->image= $imagename;
            }

            $product->save();
            return redirect()->back()->with('message','Category Update Successfully');
        }else{

            return redirect('login');
        }
    }
    public function DeleteProduct($id){
        $data= Product::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function ViewOrder(){
        $order= order::all();
        return view('admin.order', compact('order'));
    }
    public function delevered($id){

        $order = order::find($id);
        $order->delevary_status ="delevered";
        $order->payment_status="paid";

        $order->save();
        return redirect()->back();
    }

    public function PrintPdf($id){
        $order = order::find($id);
        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function SendEmail($id){
        $order = order::find($id);
        return view('admin.email_info',compact('order'));
    }

    public function send_user_email( Request $request, $id){
        $order = order::find($id);
        $details=[
            'greeting'=> $request->greeting,
            'firstline'=> $request->firstline,
            'body'=> $request->body,
            'button'=> $request->button,
            'url'=> $request->url,
            'lastline'=> $request->lastline,
        ];
        
        Notification::send($order, new SendEmailNotifcation($details));
        return redirect()->back()->with('message','Notification Sent Successfully!');
    }

    public function SearchData(Request $request){

        $searchData = $request->search;
        $order = order::where('name','LIKE',"%$searchData%")->
        orWhere('phone','LIKE',"%$searchData%")->
        orWhere('product_title','LIKE',"%$searchData%")->
        orWhere('email','LIKE',"%$searchData%")->get();

        return view('admin.order',compact('order'));

    }
}