<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Mailer\Email;

class TestEmailForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('email', ['type' => 'string']);
    }

    protected function _buildValidator(Validator $validator)
    {
        return $validator->add('email', 'format', [
                'rule' => 'email',
                'message' => 'A valid email address is required',
            ]);
    }

    protected function _execute(array $data)
    {      
        $email = new Email();
        $email->emailFormat('html');
        $email->to($data['email']);
        $email->subject('Test Email Successful');
        $email->viewVars($data);
        $email->send();
        // Send an email.
        return true;
    }
}