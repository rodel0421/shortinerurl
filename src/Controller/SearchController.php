<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use App\Form\RecoverForm;

/**
 * Search Controller
 *
 *
 * @method \App\Model\Entity\Search[] paginate($object = null, array $settings = [])
 */
class SearchController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['search']);
    }

    public function searchByPerson($value = null){
        $this->loadModel('Users');
        $users = $this->Users->find();
        if($value){
            $users->like('given_name', '%'.$value.'%');
        }
        dump($users);exit;
    }

}
