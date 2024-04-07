<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Genre;
use App\Models\Comment;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAccount()
    {
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::orderBy('id','ASC')->get();
         return view('Frontend.account.account',compact('genre','category'));
        
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
    public function updateUser(Request $request)
    {
        $idUser = Auth::id();

        $user = User::find($idUser);

        $data = $request->all();
        $user->name_account = $data['name_account'];
        $user->phone = $data['phone'];

        $get_image = $request->file('avarta');

        if (!is_dir('uploads/user/'.$idUser)) {
            mkdir('uploads/user/'.$idUser);
        }

        if($get_image) {

                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('uploads/user/'.$idUser.'/',$new_image);
                $data['avarta'] = $new_image;
                Comment::where('comment_user_id',$idUser)->update(['comment_avarta' => $data['avarta']]);

            
        }
        // return response()->json( $new_image);
        if ($data['password']) {
            $data['password'] =  bcrypt($data['password']);
        } else {
           $data['password']= $user->password ;
        }

        $user->update($data);
        return redirect()->route('account')->with('success','Updated profile success');
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
}
