<?php
namespace KryuuBlog\Form;

use Zend\Form\Form;

class DeleteForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('deleteBlogPost');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'delete',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Delete',
                'id' => 'submitbutton',
            ),
        ));
        $this->add(array(
            'name' => 'do not delete',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Cancel',
                'id' => 'submitbutton',
            ),
        ));
    }
}