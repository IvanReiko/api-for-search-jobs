<?php
/**
 * Created by PhpStorm.
 * User: A.Klapchuk
 * Date: 27.03.2018
 * Time: 11:00
 */

namespace App\Repositories\Web;

use App\Models\CompanyBillingInfo;


class BillingRepository extends BaseWebRepository
{
    private $billing;

    public function __construct(CompanyBillingInfo $billing)
    {
        $this->billing = $billing;
    }

    public function getAll()
    {
        return $this->billing->all();
    }

    public function getById($id)
    {
        return $this->billing->find($id);
    }

    public function create(array $fields)
    {
        return $this->billing->create($fields);
    }

    public function update($id, array $fields)
    {
        return $this->billing->find($id)->update($fields);
    }

    public function delete($id)
    {
        return $this->billing->find($id)->delete();
    }
}