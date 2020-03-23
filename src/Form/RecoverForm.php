<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class RecoverForm extends Form
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

}