<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact; // The model name should be singular, 'Contact' instead of 'Contacts'
use Illuminate\Support\Facades\Validator; // Use 'Validator' from the 'Illuminate\Support\Facades' namespace
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        $getData = Contact::all();
        if ($getData->count() > 0) {
            return response()->json([
                'status' => 200,
                'Contact' => $getData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Record Found...'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'mobile' => 'required|max:10',
            'email' => 'required|email|max:40',
            'subject' => 'required|string|max:191',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $contact = Contact::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            if ($contact) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Contact Saved Successfully...',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something Went Wrong',
                ], 500);
            }
        }
    }
    public function show($id)
    {
        $getData = Contact::find($id);
        // dd($getData);
        if ($getData) {
            return response()->json([
                'status' => 200,
                'Contact' => $getData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Such Contact Found',
            ], 404);
        }
    }
    public function edit($id)
    {
        $getData = Contact::find($id);
        if ($getData) {
            return response()->json([
                'status' => 200,
                'Contact' => $getData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Failed To Create Record...',
            ], 404);
        }
    }
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'mobile' => 'required|max:10',
            'email' => 'required|email|max:40',
            'subject' => 'required|string|max:191',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $getData = Contact::find($id);
            if ($getData) {
                $getData->update([
                    'name' => $request->input('name'),
                    'mobile' => $request->input('mobile'),
                    'email' => $request->input('email'),
                    'subject' => $request->input('subject'),
                    'message' => $request->input('message'),
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Contact Updated Successfully...',
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Something Went Wrong',
                ], 404);
            }
        }
    }
    public function destroy($id)
    {
        $getData = Contact::find($id);
        if ($getData) {
            $getData->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Delete Record Successfully...',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Failed To Delete Record...',
            ], 404);
        }
    }    
}
