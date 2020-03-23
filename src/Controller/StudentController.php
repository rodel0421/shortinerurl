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
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class StudentController extends AppController
{ 
    public function view($id = null)
    {
    }
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['search','listmodules','modulesview']);
    }
    public function search(){
        $select = $this->request->data['searchMethod'];
        $searchvalue = $this->request->data['searchValue'];

        if($select == 'machine'){
            $this->setAction('searchByMachine', $searchvalue);
        }
        elseif($select == 'person'){
            $this->setAction('searchByPerson', $searchvalue);
        }

        // if ($select == 'machine') {
        //     echo '<pre>';
        //     var_dump('machine');
        //     var_dump($select);
        //     var_dump($searchvalue);
        //     echo '</pre>';
        //     exit;
        // }
        // elseif ($select == 'person')
        // {
        //     echo '<pre>';
        //     var_dump('person');
        //     var_dump($select);
        //     var_dump($searchvalue);
        //     echo '</pre>';
        //     exit;
        // }
     
    }

    public function searchByMachine($searchValue){
        $this->viewBuilder()->setLayout('taro');
        $results = array(
            [
                "machine_name" => 'TCP123',
                "img" => 'hero-banner.jpeg',
                "description" => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe iusto tempore quas vel quod omnis porro voluptas blanditiis autem repudiandae.',
                "passers" => [
                    [
                        "name" => "John Doe",
                        "profile_picture" => "no_picture.png"
                    ],
                    [
                        "name" => "Jane Doe",
                        "profile_picture" => "no_picture.png"
                    ]
                ]
            ],
            [
                "machine_name" => 'ABC234',
                "img" => 'hero-banner.jpeg',
                "description" => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe iusto tempore quas vel quod omnis porro voluptas blanditiis autem repudiandae.',
                "passers" => [
                    [
                        "name" => "Jane Doe",
                        "profile_picture" => "no_picture.png"
                    ],
                    [
                        "name" => "John Doe",
                        "profile_picture" => "no_picture.png"
                    ]
                ]
            ],
            [
                "machine_name" => 'QWE567',
                "img" => 'hero-banner.jpeg',
                "description" => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe iusto tempore quas vel quod omnis porro voluptas blanditiis autem repudiandae.',
                "passers" => []
            ]
        );
        
        $this->set('results',$results);
    }

    public function searchByPerson($searchValue = null){
        $this->viewBuilder()->setLayout('taro');
        if(!$searchValue){
            $searchvalue = $this->request->data['searchValue'];
        }
        $results = array(
            [   
                "id" => "ACT12334",
                "name" => "John Doe",
                "profile_picture" => "no_picture.png",
                "qualifications" => [
                    [
                        "machine_name" => 'TCP123',
                        "img" => 'hero-banner.jpeg'
                    ],
                    [
                        "machine_name" => 'TCP123',
                        "img" => 'hero-banner.jpeg'
                    ]
                ]
            ],
            [
                "id" => "ACT1233",
                "name" => "John Doe",
                "profile_picture" => "no_picture.png",
                "qualifications" => [
                    [
                        "machine_name" => 'TCP123',
                        "img" => 'hero-banner.jpeg'
                    ],
                    [
                        "machine_name" => 'TCP123',
                        "img" => 'hero-banner.jpeg'
                    ]
                ]
            ],
            [
                "id" => "ACT1224",
                "name" => "John Doe",
                "profile_picture" => "no_picture.png",
                "qualifications" => []
            ]
            
        );
        
        $this->set('results',$results);
    }

}