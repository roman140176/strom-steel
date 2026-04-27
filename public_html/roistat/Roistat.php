<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 25/04/2019
 * Time: 13:41
 */

class Roistat {
    const ROISTAT_KEY  = 'YjA2YmZhZjc4NTE1YzRkNDM5MmVkNjg0NGU5Nzk0MmQ6MTg4Njkx';
    const ROISTAT_HOST = 'https://cloud.roistat.com/api/proxy/1.0/leads/add?';
    const WEBHOOK_HOST = '';

    const NAME      = 'name';
    const PHONE     = 'phone';
    const EMAIL     = 'email';
    const COMMENT   = 'comment';
    const VISITID   = 'visit_id';
    const TITLE     = 'title';
    const FORMNAME  = 'formname';
    const FIELDS    = 'fields';
    const IS_SKIP   = 'is_skip_sending';
    const IS_CALL   = 'is_need_callback';

    /**
     * Отправка лида
     * @return bool|string
     */
    public static function sendLead($data)
    {
        if(isset($data['visit_id'])) {
            $roistat = $data['visit_id'];
        } else {
            $roistat = isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'no_cookie';
        }

        if(empty($data['email']) && empty($data['phone'])) return false;

        $data['key']     = self::ROISTAT_KEY;
        $data['roistat'] = $roistat;

        return self::roistatSendCurl(self::ROISTAT_HOST, $data, true);
    }

    /**
     * @param int $id
     * @param $params
     * @return bool|string
     */
    public static function createLead($id, $params, $formname = null)
    {
        if( !is_array($params) ) return false;

        $formname   = !empty($params['formname'])   ? $params['formname']   : $formname;
        $name       = !empty($params['name'])       ? $params['name']       : 'Неизвестный контакт';
        $phone      = !empty($params['phone'])      ? $params['phone']      : null;
        $email      = !empty($params['email'])      ? $params['email']      : null;
        $comment    = !empty($params['comment'])    ? $params['comment']    : null;
        $price		= !empty($params['price'])      ? $params['price']      : null;

        //Metrica
        $city        = !empty($params['city'])        ? $params['city']        : '{city}';
        $source      = !empty($params['source'])      ? $params['source']      : '{source}';
        $utmTerm     = !empty($params['utmTerm'])     ? $params['utmTerm']     : '{utmTerm}';
        $utmSource   = !empty($params['utmSource'])   ? $params['utmSource']   : '{utmSource}';
        $utmMedium   = !empty($params['utmMedium'])   ? $params['utmMedium']   : '{utmMedium}';
        $utmContent  = !empty($params['utmContent'])  ? $params['utmContent']  : '{utmContent}';
        $landingPage = !empty($params['landingPage']) ? $params['landingPage'] : '{landingPage}';
        $utmCampaign = !empty($params['utmCampaign']) ? $params['utmCampaign'] : '{utmCampaign}';

        $is_skip_sending  = !empty($data['is_skip_sending'])    ? 1 : 0;
        $is_need_callback = !empty($params['is_need_callback']) ? 1 : 0;

        //$this->dataSwitch();

        $title = !empty($formname) ? "Заявка с формы: {$formname}" : "Новый лид с сайта {domain}";

        $roistatData = array(
	        Roistat::VISITID   => !empty($params[Roistat::VISITID]) ? $params[Roistat::VISITID] : null,
            Roistat::TITLE     => $title,
            Roistat::NAME      => $name,
            Roistat::PHONE     => $phone,
            Roistat::EMAIL     => $email,
            Roistat::COMMENT   => $comment,
            Roistat::IS_SKIP   => $is_skip_sending,
            Roistat::IS_CALL   => $is_need_callback,
            Roistat::FIELDS    => array(
                'form'        => $formname,
                'city'        => $city,
                'source'      => $source,
                'landingPage' => $landingPage,
                'pipeline_id' => 3176797, 
            )
        );

        if(!empty($params['fields'])) {
            $roistatData['fields'] += $params['fields'];
        }

        return self::sendLead($roistatData);
    }

    private function dataSwitch($id, &$params)
    {
        switch($id) {
            default:break;
        }
        return $params;
    }

    /** -
     * Генерация менеджеров по очереди
     * @param array $manager
     * @return mixed
     */
    public static function getManager($manager = array()) {
        $manager_file = __DIR__ . '/manager.txt';

        $fp = fopen($manager_file, "r");
        $counter = fgets($fp);
        fclose($fp);

        $key = array_search($counter, $manager);

        $new_key=$key+1;
        if ($new_key>(count($manager)-1)) {
            $new_key=0;
        }

        $managerId=$manager[$new_key];

        $fh = fopen($manager_file, "w+");
        fwrite($fh, $managerId);
        fclose($fh);
        return $managerId;
    }

    /**
     * Функция логирования
     * @param $data
     * @param string $title
     * @return bool
     */
    public static function writeToLog($data, $title = '', $name = null) {
        $log = "\n------------------------\n";
        $log .= date("d.m.Y G:i:s") . "\n";
        $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
        $log .= print_r($data, 1);
        $log .= "\n------------------------\n";
        $mName = date('Y-m-d');
        if($name) {
            $mName = $name;
        } //OnSaleOrderSaved

        $path = __DIR__ . '/logs';
        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        return file_put_contents("{$path}/roistat_{$mName}.log", $log, FILE_APPEND);
    }

    /**
     * Вебхук
     * @param $params
     * @return bool|mixed|string
     */
    public static function webhookDebug($params)
    {
        return file_get_contents(
            self::WEBHOOK_HOST . http_build_query($params)
        );
    }

    /**
     * Вывод массива на экран
     * @param $str
     * @param null $name
     */
    public static function debug($str, $name = null)
    {
        if(!empty($name)) {
            echo "<h3 style='padding: 0;'>{$name}</h3>";
        }
        echo "<pre>";
        print_r($str);
        echo "</pre>";
    }

    /**
     * Отправка формы по Curl
     * @param $url
     * @param $roistatData
     * @param $httpBuild
     * @return mixed
     */
    private static function roistatSendCurl($url, $roistatData, $httpBuild)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, null);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, null);
        if ($httpBuild == true) {
            curl_setopt($ch, CURLOPT_URL, $url . http_build_query($roistatData));
        } else {
            curl_setopt($ch, CURLOPT_URL, $url . $roistatData);
        }
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
