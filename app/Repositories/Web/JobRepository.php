<?php
/**
 * Created by PhpStorm.
 * User: A.Klapchuk
 * Date: 15.03.2018
 * Time: 13:45
 */

namespace App\Repositories\Web;


use App\Repositories\Contracts\JobInterface;
use App\Models\Job;

class JobRepository implements JobInterface
{
    private $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function getAll(){
        return $this->job->all();
    }

    public function getById($id){
        return $this->job->find($id);
    }

    public function create(array $fields){
        return $this->job->create($fields);
    }

    public function update($id, array $fields){
        return $this->job->find($id)->update($fields);
    }

    public function delete($id){
        return $this->job->find($id)->delete();
    }
}