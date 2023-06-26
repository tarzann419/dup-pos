<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $category = Category::latest()->get(); //The categories are fetched in descending order based on their creation timestamps using the latest() method.
        return view('backend.category.all_category', compact('category'));
    } // End Method 

    public function StoreCategory(Request $request)
    {
        Category::insert([ //This method is responsible for storing a new category in the database
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(), //current timestamp for created_at
        ]);

        $notification = array( //After successful insertion, a success notification message is set
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory($id) //This method retrieves a specific category with the given $id from the Category model using the findOrFail() method. The retrieved category is passed to the edit_category view for editing.
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit_category', compact('category'));
    }

    public function UpdateCategory(Request $request) // It retrieves the category ID from the request, finds the category with that ID using findOrFail(), and updates the category_name field with the new value. The updated_at field is also updated with the current timestamp
    {
        $category_id = $request->id;
        Category::findorFail($category_id)->update([
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function DeleteCategory($id){ //This method deletes a category from the database based on the provided $id
        Category::findOrFail($id)->delete();


        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
