<?php
/**
 * Created by PhpStorm.
 * User: A.Klapchuk
 * Date: 15.03.2018
 * Time: 12:29
 */
namespace App\Repositories\Contracts;

interface CompanyInterface
{
    function getAll();

    function getById($id);

    function create(array $fields);

    function update($id, array $fields);

    function delete($id);
}