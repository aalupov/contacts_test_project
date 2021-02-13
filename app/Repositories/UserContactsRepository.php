<?php
namespace App\Repositories;

use App\UserContacts as Model;

/**
 * Class UserContactsRepository
 *
 * @package App\Repositories
 */
class UserContactsRepository extends CoreRepository
{

    /**
     * const array
     */
    private const COLUMNS = [
        'id',
        'contact_id'
    ];

    /**
     *
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get Model to edit
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * delete the contact for user
     *
     * @param int $contactId
     *
     * @return void
     */
    public function deleteUserContact($contactId)
    {
        $this->startConditions()
            ->where('contact_id', '=', $contactId)
            ->delete();
    }

    /**
     * add the contact to user
     *
     * @param int $contactId
     * @param int $userId
     *
     * @return void
     */
    public function addContact($contactId, $userId)
    {
        $this->startConditions()->insert([
            'contact_id' => $contactId,
            'user_id' => $userId
        ]);
    }

    /**
     * Get the user contacts by user id
     *
     * @param int $userId
     *
     * @return App\Contacts
     */
    public function getContactsByUserId($userId)
    {
        $result = $this->startConditions()
            ->select('contacts.id', 'contacts.name')
            ->join('contacts', 'contacts.id', '=', 'user_contacts.contact_id')
            ->where('user_id', '=', $userId)
            ->orderBy('contacts.id')
            ->get();

        return $result;
    }
}