<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContactsRepository;
use App\Repositories\UserContactsRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->ContactsRepository = app(ContactsRepository::class);
        $this->UserContactsRepository = app(UserContactsRepository::class);
    }

    /**
     * const array
     */
    protected const viewShareVarsContacts = [
        'id',
        'contacts',
    ];
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contacts = $this->ContactsRepository->getContacts();
        return view('home', compact(self::viewShareVarsContacts));
    }
    
    /**
     * Get the user contacts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user_contacts()
    {
        $userId = auth()->id();
        $contacts = $this->UserContactsRepository->getContactsByUserId($userId);
        return view('contacts', compact(self::viewShareVarsContacts));
    }
    
    /**
     * Add the contact to user.
     *
     * @param int $contactId
     * @return \Illuminate\Http\Response
     */
    public function add($contactId)
    {
        if ($this->ContactsRepository->getEdit($contactId)) {
            $userId = auth()->id();
            $this->UserContactsRepository->addContact($contactId, $userId);
            
            return redirect()->back()->with('success', 'The Contact has been added successfully');
        } else {
            return redirect()->back()->withErrors('This Contact does not exist.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->ContactsRepository->getEdit($id)) {
            
            $this->UserContactsRepository->deleteUserContact($id);
            
            return redirect()->back()->with('success', 'The Contact has been removed successfully');
        } else {
            return redirect()->back()->withErrors('This Contact does not exist.');
        }
    }
}
