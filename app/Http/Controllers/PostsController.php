<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
// use the storage library
use Illuminate\Support\Facades\Storage;
// bring in 'Post' model
use App\Post;
// bring in 'User' model
use App\User;
use Gate;
use Illuminate\Support\Facades\Hash;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // use ant of the 'Post' model function(using eloquent(ORM))
        //$posts = Post::all(); // fetch all the data in 'Post' model/table

        // set limit to view on page to different tyep of users
        if(Gate::allows('isManager')){
            $posts = Post::orderBy('updated_at', 'desc')->paginate(10);  // paginate page to 10 data per page
        }else if(Gate::allows('isAdmin')){
            $posts = Post::orderBy('updated_at', 'desc')->paginate(10);  
        }else if(Gate::allows('isDesigner')){
            $posts = Post::where('status', 'Submitted')->orWhere('status', 'Drafted')->orWhere('status', 'Accepted')
                ->orWhere('status', 'Rejected')->orderBy('updated_at', 'desc')->paginate(10); 
        }else if(Gate::allows('isMoulder')){
            $posts = Post::where('status', 'Designed')->orderBy('updated_at', 'desc')->paginate(10);  
        }else if(Gate::allows('isTailor')){
            $posts = Post::where('status', 'Mouldered')->orWhere('status', 'Tailored')->orderBy('updated_at', 'desc')->paginate(10);  
        }else if(Gate::allows('isHR')){
            $posts = Post::orderBy('updated_at', 'desc')->paginate(10);  
        }else{
            // else customer
            abort(404, "Sorry, you cannot do this action");
        }

        
        // return view of index file with 'posts' table data
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // set limit to view on page to different tyep of users
        if(!Gate::allows('isCustomer')){
            abort(404, "Sorry, you cannot do this action");
        }

        // load create view
        return view('posts.create');
    }

    /**
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // make validation
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'cover_image' => 'image|max:1999|required'
        ]);

        // handle file upload
        if($request->hasFile('cover_image')){

            // get the file name with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            // get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // create filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        // create post
        $post = new Post;

        // add out var value and get it from submitted form
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->gender = $request->input('gender');
        $post->size = $request->input('size');
        $post->collar = $request->input('collar');
        $post->sleeve = $request->input('sleeve');
        $post->color = $request->input('color');
        // features array
        if($request->features != null){
            $post->features = implode(", ", $request->features);
        }else{
            $post->features = 'no feature';
        }
        
        $post->material = $request->input('material');
        $post->amount = $request->input('amount');
        // get user id that create the order
        $post->user_id = auth()->user()->id;
        // insert the cover image into database
        $post->cover_image = $fileNameToStore;
        $post->status = "Submitted";
        $post->delivery = $request->input('delivery');

        // save it
        $post->save();

        // redirect and set success message
        return redirect('/dashboard')->with('success', 'Order Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // function
    public function show($id)
    {
        // fetch data based on id from database
        $post = Post::find($id);

        // return show page
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // set limit to view on page to different admin
        if(!Gate::allows('isAdmin') && !Gate::allows('isManager')){
            abort(404, "Sorry, you cannot do this action");
        }
        
        // fetch data based on id from database
        $post = Post::find($id);

        // return edit page
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // make validation
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'cover_image' => 'image|max:1999|nullable'
        ]);

        // handle file upload
        if($request->hasFile('cover_image')){

            // get the file name with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            // get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // create filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }

        // fetch data based on id from database
        $post = Post::find($id);

        // add out var value and get it from submitted form
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->gender = $request->input('gender');
        $post->size = $request->input('size');
        $post->collar = $request->input('collar');
        $post->sleeve = $request->input('sleeve');
        $post->color = $request->input('color');
        // features array
        if($request->features != null){
            $post->features = implode(", ", $request->features);
        }else{
            $post->features = 'no feature';
        }

        $post->material = $request->input('material');
        $post->amount = $request->input('amount');
        // get user id that update the order
        // $post->user_id = auth()->user()->id;
        // insert the cover image into database
        //$post->cover_image = $fileNameToStore;
        

        if($request->hasFile('cover_image')){
            if($post->cover_image != 'noimage.jpg'){
                // Delete image with storage object delete()
                Storage::delete('public/cover_images/'.$post->cover_image);
            }
            $post->cover_image = $fileNameToStore;
        }

        $post->status = $request->input('status');
        $post->delivery = $request->input('delivery');

        // save it
        $post->save();

        // redirect and set success message
        return redirect('/posts')->with('success', 'Order Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the post by it's @id that has been passed in
        $post = Post::find($id);

        // check for correct user
        // if(auth()->user()->id !== $post->user_id){
        //     return redirect('/posts')->with('error', 'Unauthorized Page');
        // }

        // we don't want the 'no_image' to disappear because we gonna need that in case someone upload new post without an image
        if($post->cover_image != 'noimage.jpg'){
            // Delete image with storage object delete()
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        // simply delete it
        $post->delete();
        // redirect back to post
        return redirect('/posts')->with('success', 'Order Removed');
    }

    //method for display user page
    public function displayuser(){

        // set limit to view on page to different tyep of users
        if(!Gate::allows('isAdmin') && !Gate::allows('isHR') && !Gate::allows('isManager')){
            abort(404, "Sorry, you cannot do this action");
        }

        $users = User::orderBy('created_at', 'asc')->paginate(10);
        return view('posts.displayuser')->with('users', $users);
    }

    //method for edit user page
    public function edituser($id){
        
        // set limit to view on page to different tyep of users
        if(!Gate::allows('isAdmin') && !Gate::allows('isHR') && !Gate::allows('isManager')){
            abort(404, "Sorry, you cannot do this action");
        }
        
        // fetch data based on id from database
        $user = User::find($id);

        // return edit user page 
        return view('posts.edituser')->with('user', $user);
    }

    public function createuser()
    {
        // set limit to view on page to different tyep of users
        if(!Gate::allows('isAdmin') && !Gate::allows('isHR') && !Gate::allows('isManager')){
            abort(404, "Sorry, you cannot do this action");
        }

        // load create view
        return view('posts.createuser');
    }

    /**
     * 
     * Store a newly created user in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeuser(Request $request)
    {
        // set limit to view on page to different tyep of users
        if(!Gate::allows('isAdmin') && !Gate::allows('isHR') && !Gate::allows('isManager')){
            abort(404, "Sorry, you cannot do this action");
        }

        // make validation
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirmpassword' => 'required'
        ]);

        // create user
        $user = new User;

        // add out var value and get it from submitted form
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->user_type = $request->input('user_type');
        

        // save it
        $user->save();

        // redirect and set success message
        return redirect('/displayuser')->with('success', 'User Created');

        // return User::create([
        //     'name' => $request->input('name'),
        //     'email' => $request->input('email'),
        //     'password' => Hash::make($request->input('password')),
        //     'user_type' => $request->input('user_type'),
        // ]);
    }

    public function updateuser(Request $request, $id)
    {
        // set limit to view on page to different tyep of users
        if(!Gate::allows('isAdmin') && !Gate::allows('isHR') && !Gate::allows('isManager')){
            abort(404, "Sorry, you cannot do this action");
        }

        // make validation
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required'
        ]);

        // create user 
        $user = User::find($id);

        // add out var value and get it from submitted form
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->user_type = $request->input('user_type');
        

        // save it 
        $user->save();

        // redirect and set success message
        return redirect('/displayuser')->with('success', 'User Updated');

    }

    public function destroyuser($id)
    {
        // find the post by it's @id that has been passed in
        $user = User::find($id);

        // simply delete it
        $user->delete();
        // redirect back to post  
        return redirect('/displayuser')->with('success', 'User Deleted');
    }

    // function to view for designer send mockup image to customer
    public function design($id){

        // set limit to view on page to designer
        if(!Gate::allows('isDesigner')){
            abort(404, "Sorry, you cannot do this action");
        }
        
        // fetch data based on id from database
        $post = Post::find($id);

        // return design page
        return view('posts.design')->with('post', $post);

    }

    public function downloadimage($id){
        $post = Post::find($id);
         $filename = $post->cover_image;
         $file_path = storage_path('app/public/cover_images/').$filename;
         return Response::download($file_path);
    }

    public function senddraft(Request $request, $id){

        // make validation
        $this->validate($request, [
            'draft_desc' => 'required',
            'draft_image' => 'image|max:1999|required'
        ]);

        // handle file upload
        if($request->hasFile('draft_image')){

            // get the file name with the extension
            $filenameWithExt = $request->file('draft_image')->getClientOriginalName();

            // get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // get just extension
            $extension = $request->file('draft_image')->getClientOriginalExtension();

            // create filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // upload the image
            $path = $request->file('draft_image')->storeAs('public/draft_image', $fileNameToStore);

        }

        // fetch data based on id from database
        $post = Post::find($id);

        // add out var value and get it from submitted form
        $post->draft_desc = $request->input('draft_desc');

        $post->draft_image = $fileNameToStore;

        $post->status = 'Drafted';

        // save it
        $post->save();

        // redirect back to post  
        return redirect('/posts')->with('success', 'Image sent');
    }

    // function for cust view mockup image sent by designer
    public function viewdraft($id){

        // set limit to view on page to designer
        if(!Gate::allows('isCustomer')){
            abort(404, "Sorry, you cannot do this action");
        }
        
        // fetch data based on id from database
        $post = Post::find($id);

        // return design page
        return view('posts.draft')->with('post', $post);

    }

    public function confirmdraft(Request $request, $id)
    {
        
        // fetch data based on id from database
        $post = Post::find($id);

        $response = $request->input('confirmed');
        if($response == 'Rejected'){
            $desc = $request->input('desc_reject');
            $post->desc_reject = $desc;
            // Delete image in draft_image folder
            Storage::delete('public/draft_image/'.$post->draft_image);
        }else{
            // Delete image with storage object delete()
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->status = $response;

        // save it
        $post->save();

        // redirect and set success message
        return redirect('/dashboard')->with('success', 'Response Sent');
    }

    public function manageaction(Request $request, $id){

        switch($request->submitbutton){

            case 'Designed':
                // fetch data based on id from database
                $post = Post::find($id);

                $post->status = 'Designed';

                // save it
                $post->save();

                // redirect and set success message
                return redirect('/posts')->with('success', 'Design Confirmed'); 

            break;

            case 'Mouldered':
                // fetch data based on id from database
                $post = Post::find($id);

                $post->status = 'Mouldered';

                // save it
                $post->save();

                // redirect and set success message
                return redirect('/posts')->with('success', 'Order Mouldered'); 

            break;

            case 'Tailored':
                // fetch data based on id from database
                $post = Post::find($id);

                $post->status = 'Tailored';

                // save it
                $post->save();

                return redirect('/posts')->with('success', 'Order Tailored');

            break;

            case 'Packaged':
                // fetch data based on id from database
                $post = Post::find($id);
                
                $post->status = 'Packaged';

                // save it
                $post->save();
                
                return redirect('/posts')->with('success', 'Order Packaged');
                    
            break;

        }

    }

}
