<?php

/**
 *
 *
 */
Yii::import('application.modules.mail.MailModule');

class CalcFormModel extends CFormModel
{
    public $name;       // Имя
    public $phone;     // Телефон
    public $email;       // email
    public $material;       // Материал фасада
    public $kview;    // Вид кухни
    public $kviewP;    // Вид прямо
    public $kviewL;    // Вид лево
    public $kviewR;    // Вид право
    public $stoleshnic; // Материал столешницы
    public $height;      // Высота верхних шкафов
    public $technic;        // Встраиваемая техника
    public $txt;        // Дополнительные пожелания
    public $image;        // Дополнительные пожелания
    public $code;        //code


    public function rules()
    {
        return [
            ['name, phone, email, kview', 'required'],
            ['kviewP, kviewL, kviewR', 'required', 'on' => 'pView'],
            ['kviewP, kviewL', 'required', 'on' => 'lView'],
            ['kviewP, kviewR', 'required', 'on' => 'rView'],
            ['kviewP', 'required', 'on' => 'prView'],
            ['image', 'file',
                'allowEmpty'=>false,
                'types'=>'doc,docx,jpeg,jpg,png',
                'maxFiles'=>1,
                'maxSize'=>1024 * 1024 * 5,
                'tooLarge'=>'Файл должен быть меньше 5 МБ',
                'message' => 'Необходимо прикрепить резюме (в формате .doc)'
            ],
            ['material, stoleshnic, height, technic, txt, code, image', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'email',
            'material' => 'Материал фасада',
            'kview' => 'Вид кухни',
            'height' => 'Высота верхних шкафов',
            'technic' => 'Встраиваемая техника',
            'stoleshnic' => 'Материал столешницы',
            'txt' => 'Дополнительные пожелания',
            'kviewP' => 'Укажите длинну прямой стороны в сантиметрах',
            'kviewL' => 'Укажите длинну левой стороны в сантиметрах',
            'kviewR' => 'Укажите длинну правой стороны в сантиметрах',
        ];
    }

    public function getMaterialList()
    {
        return [
            0 => 'Натуральное дерево',
            1 => 'МДФ эмаль',
            2 => 'Пластик',
            3 => 'Акрил',
            4 => 'МДФ пленка',
            5 => 'Натуральный шпон',
        ];
    }
    public function getKviewList()
    {
        return [
            0 => 'П-образный',
            1 => 'Г-образный левый',
            2 => ' Г-образный правый',
            3 => 'Прямой',
        ];
    }
    public function getStolicList()
    {
        return [
            0 => 'Пластик',
            1 => 'Искусственный камень',
        ];
    }
    public function getHeightList()
    {
        return [
            0 => 'Комбинированная',
            1 => 720,
            2 => 915,
        ];
    }
    public function getTechnicList()
    {
        return [
            0 => 'Варочная поверхность',
            1 => 'Духовой шкаф',
            2 => 'Посудомоечная машина',
            3 => 'Холодильник',
            4 => 'Вытяжка',
            4 => 'Стиральная машина',
            4 => 'Стеновая панель',
        ];
    }
}

