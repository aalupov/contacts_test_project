<?php
namespace App\Repositories;

use App\Contacts as Model;

/**
 * Class ContactsRepository
 *
 * @package App\Repositories
 */
class ContactsRepository extends CoreRepository
{

    /**
     * const array
     */
    private const COLUMNS = [
        'id',
        'name'
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
     * Get the contact by id
     *
     * @param int $id
     *
     * @return Model
     */
    public function getContactById($id)
    {
        $result = $this->startConditions()
            ->select(self::COLUMNS)
            ->find($id);

        return $result;
    }

    /**
     * Get the contacts
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getContacts()
    {
        $result = $this->startConditions()
            ->select(self::COLUMNS)
            ->orderBy('id')
            ->get();

        return $result;
    }
}