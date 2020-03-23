<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;

/**
 * Groups Controller
 *
 * @property \App\Model\Table\GroupsTable $Groups
 */
class GroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $groups = $this->Groups->find()
                ->select([
                    'group_id'=>'id',
                    'name',
                    'style',
                    'created',
                    'modified'
                ]
                )->toArray();

        $this->set(compact('groups'));
        $this->set('_serialize', 'groups');
        
    }
}
