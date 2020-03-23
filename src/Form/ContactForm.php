<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Mailer\Email;

class ContactForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('name', 'string')
            ->addField('email', ['type' => 'string'])
            ->addField('message', ['type' => 'text'])
            ->addField('role', ['type' => 'string'])
            ->addField('home', ['type' => 'string'])
            ->addField('browser', ['type' => 'string'])
            ->addField('agent', ['type' => 'string']);
    }

    protected function _buildValidator(Validator $validator)
    {
        return $validator->add('name', 'length', [
                'rule' => ['minLength', 1],
                'message' => 'A name is required'
            ])->add('email', 'format', [
                'rule' => 'email',
                'message' => 'A valid email address is required',
            ])->add('message', 'format', [
                'rule' => ['minLength', 1],
                'message' => 'Please enter a message',
            ]);
    }

    protected function _execute(array $data)
    {
        $to = \Cake\Core\Configure::check('Client.contact_us_email') ? \Cake\Core\Configure::read('Client.contact_us_email') : 'daniel@daktech.com.au';
        
        $email = new Email();
        $email->emailFormat('html');
        $email->template('feedback');
        $email->to($to);
        $email->subject('DDMS Contact Us');
        $email->viewVars($data);
        $email->send();
        // Send an email.
        return true;
    }
}