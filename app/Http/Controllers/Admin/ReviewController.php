<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->get('name', '');

        $records = Review::with('customer:firstname,lastname,id', 'product:image,id')
            ->select('id', 'rating', 'customer_id', 'product_id', 'text')
            ->has('customer')
            ->paginate($this->defaultPaginate);

        return view('admin.review.index', ['records' => $records]);
    }

    public function edit($id)
    {

        return view('admin.review.edit', [
            'data' => Review::with('customer')->findOrFail($id),
        ]);
    }

    protected function validateData($request)
    {
        $this->validate($request, [
            'text' => ['required', 'string', 'max:255'],
        ]);
    }

    public function update($id, Request $request)
    {
        $this->validateData($request);
        $data = Review::findOrFail($id);
        $rating = $data->rating;
        if (isset($request->rating)) {
            $rating = $request->rating;
        }
        $data->update(['text' => $request->text, 'rating' => $rating]);
        return redirect()->route('review')->with('success', 'Rating Successfully Updated');
    }

    public function delete($id)
    {
        if (!$data = Review::whereId($id)->first()) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $data->delete();
        return redirect(route('review'))->with('success', 'Review  Deleted Successfully');
    }
}