<?php
class ReviewManager extends CApplicationComponent
{
    /** @var CallbackController */
    private $view;

    private $mailer;

    /** @var CallbackModule */
    private $module;

    private $adminEmail;

    public function init()
    {
        $this->view = Yii::app()->controller;
        $this->mailer = Yii::app()->mail;
        $this->module = Yii::app()->getModule('review');
        $this->adminEmail = Yii::app()->getModule('yupe')->email;
    }

    /**
     * Send notification to managers
     */
    public function sendNotification($body)
    {
        $email = $this->module->email_notification;
        //$to = $this->module->getNotifyTo();
        $from = 'dc@dc56.ru';
        $theme = "Уведомление о новом отзыве";

        
        $this->mailer->send($from, $email, $theme, $body);

        return true;
    }
}