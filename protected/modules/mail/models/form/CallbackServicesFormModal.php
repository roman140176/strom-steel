<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CallbackServicesFormModal
 *
 * @author roman
 */
Yii::import('application.modules.mail.models.form.CallbackFormModal');
Yii::import('application.modules.page.models.Page');

class CallbackServicesFormModal extends CallbackFormModal
{
    public $services;
    public $body;

    public function rules()
    {
        $parent = parent::rules();
        $parent[] = ['services', 'required'];
        return $parent;
    }

    public function attributeLabels()
    {
        $parent = parent::attributeLabels();
        $parent['services'] = 'Название услуги';
        return $parent;
    }

    public function getServicesList()
    {
        $page = Page::model()->findAllByAttributes(['parent_id' => 3]);
        return CHtml::listData($page, 'id', 'title');
    }


    public function afterValidate()
    {
        if (empty($this->getErrors())) {
            $data = $this->getAttributes();
            $services = $this->getServicesList();
            if(isset($services[$data['services']])){
                $data['services'] = $services[$data['services']];
            }
            Yii::app()->mailMessage->raiseMailEvent('zapis-na-priem', $data);
        }
        return parent::afterValidate();
    }
}
