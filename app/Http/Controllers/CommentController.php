<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

session_start();

class CommentController extends Controller
{
    //
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->where('comment_parent_comment', 0)->where('comment_status', 0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->orderBy('comment_id', 'DESC')->get();
        $output = '';
        foreach ($comment as $key => $comm) {
            $output .= '
        <div class="row style_comment">
        <div class="col-md-2">
            <img width="100%" src="/public/frontend/images/iconava.jpg" class="img img-responsive img-thumbnail">
        </div>
        <div class="col-md-10">
            <p style="color: blue">@' . $comm->comment_name . '</p>
            <p style="color: green">' . $comm->comment_date . '</p>
            <p>
            ' . $comm->comment . '
            </p>
        </div>
        </div>
        <p></p>';
            foreach ($comment_rep as $key => $rep_cmt) {
                if ($rep_cmt->comment_parent_comment == $comm->comment_id) {
                    $output .= '
        <div class="row style_comment" style="margin: 5px 40px;background: ivory">
        <div class="col-md-2">
            <img width="50%" src="/public/frontend/images/adminicon.jpg" class="img img-responsive img-thumbnail">
        </div>
        <div class="col-md-10">
            <p style="color: green">@Admin</p>
            <p>
            ' . $rep_cmt->comment . '
            </p>
        </div>
        </div>
        <p></p>';
                }
            }
        }
        echo $output;
    }
    //admin
    public function send_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 1;
        $comment->comment = $comment_content;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }
    public function list_comment()
    {
        $this->AuthLogin();
        $comment = Comment::with('product')->where('comment_parent_comment', 0)->orderBy('comment_id', 'DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->orderBy('comment_id', 'DESC')->get();
        return view('admin.comment.list_comment')->with(compact('comment', 'comment_rep'));
    }
    public function allow_comment(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }
    public function reply_comment(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->comment_name = 'Admin';

        $comment->save();
    }
    public function insert_comment(Request $request)
    {
        $data = $request->all();
        $rating = new Rating();
        $customer_id = Session()->get('customer_id');
        if ($customer_id) {
            $rating->product_id = $data['product_id'];
            $rating->rating = $data['index'];
            $rating->save();
        }
        echo 'done';
    }
}
