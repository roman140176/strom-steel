<?php
/**
 * CustomFieldBehavior
*/
/*******************************
////////////////////////////////
------ Произвольные поля -------
////////////////////////////////
****************************** */

namespace yupe\components\behaviors;

use CActiveRecordBehavior;
use CUploadedFile;
use Yii;

class CustomFieldBehavior extends CActiveRecordBehavior
{
    public $attributeName = 'data';

    public $uploadCustomfield = 'customfield';
    public $uploadCustomfieldGallery = 'customfield/gallery';

    /**
     * @param \CComponent $owner
     */
    public function attach($owner)
    {
        parent::attach($owner);
    }

    /**
     * @return bool
     */
    public function beforeSave($event)
    {
        $myfield = Yii::app()->getRequest()->getPost('MyCustomField');
        if(!empty($myfield)){
            array_multisort( array_column($myfield, "position"), SORT_ASC, $myfield );
            // ksort($myfield);
            $newmyfield = [];
            $count = 1;
            foreach ($myfield as $key => $value) {
                $newmyfield[$count] = $value;
                $newmyfield[$count]['image'] = $this->updateMyCustomFieldImage($count, $value['image']);
                $newmyfield[$count]['gallery'] = $this->updateMyCustomFieldGallery($count, $value['gallery']);
                $count++;
            }

            $this->getOwner()->{$this->attributeName} = serialize($newmyfield);
        } else if(is_array($this->getOwner()->{$this->attributeName})) {
            $this->getOwner()->{$this->attributeName} = serialize($this->getOwner()->{$this->attributeName});
        }

        return parent::beforeSave($event);
    }

    /**
     * @return bool
     */
    public function afterFind($event)
    {
        if(!empty($this->getOwner()->{$this->attributeName})){
            $this->getOwner()->{$this->attributeName} = unserialize($this->getOwner()->{$this->attributeName});
        }

        return parent::afterFind($event);
    }

    /*
     * Фунция загрузки изображения
    */
    public function updateMyCustomFieldImage($count, $name)
    {
        $delete = Yii::app()->getRequest()->getPost('myCustomField-delete-image-'.$count);
        $new_image = CUploadedFile::getInstancesByName('MyCustomField_'.$count);
        $path = Yii::getPathOfAlias("webroot.uploads.{$this->uploadCustomfield}").DIRECTORY_SEPARATOR;
        if (!empty($new_image) || !empty($delete)) {
            $del = @unlink($path.$name);
            if($del == true && empty($new_image)){
                return '';
            }

            foreach($new_image as $key => $item) {
                $filename = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' . $item->getExtensionName();
                $item->saveAs($path.$filename);
                return $filename;
            }
        }
        return $name;
    }
    /*
     * Фунция загрузки галереи для произвольного поля
    */
    public function updateMyCustomFieldGallery($count, $gallery = [])
    {
        $images = [];
        $new_images = CUploadedFile::getInstancesByName('MyCustomFieldGallery_'.$count);
        $path = Yii::getPathOfAlias("webroot.uploads.{$this->uploadCustomfieldGallery}").DIRECTORY_SEPARATOR;

        $newgallery = [];
        $new_pos = 1;
        if(empty($gallery)){
            $gallery = [];
        }
        foreach ($gallery as $key => $item) {
            $delete = Yii::app()->getRequest()->getPost('myCustomField-delete-galImage-'.$count.'_'.$key);
            if (!empty($delete)) {
                unlink($path.$item['image']);
            } else {
                $newgallery[$key] = $item;
                $newgallery[$key]['position'] = $new_pos;
                $gal_images = CUploadedFile::getInstancesByName('MyCustomFieldGalleryImage_'.$count.'_'.$key);

                if($gal_images){
                    $file = $path.$item['image'];
                    if(file_exists($file)){
                        unlink($file);
                    }
                    foreach($gal_images as $item) {
                        $filename = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' . $item->getExtensionName();
                        $item->saveAs($path.$filename);
                    }

                    $newgallery[$key]['image'] = $filename;
                }

                $new_pos++;
            }
        }

        if (!empty($new_images)) {
            $pos = 1;
            if(count($newgallery) > 0){
                $pos = count($newgallery) + 1;
            }
            foreach($new_images as $key => $item) {
                $filename = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' . $item->getExtensionName();
                $item->saveAs($path.$filename);
                $images[$key]['image'] = $filename;
                $images[$key]['position'] = $pos;
                $pos++;
            }
        }

        if(!empty($newgallery)){
            $images = array_merge($newgallery, $images);
        }

        return $images;
    }

    /*
     * Функция получения значения произвольного поля
    */
    public function getAttributesGroup($group)
    {
        $data = [];
        foreach ($this->getOwner()->{$this->attributeName} as $key => $value) {
            // print_r("group=".$group);
            // print_r($value);

            if($value['group'] == $group){
                $data[] = $value;
            }
        }
            // exit;
        return (!empty($data)) ? $data : false;
    }
    public function getGroupValue($code)
    {
        $data = [];
        foreach ($this->getOwner()->{$this->attributeName} as $key => $value) {
            $data[$value['group']] = $value;
        }
        return (!empty($data[$code])) ? $data[$code] : false;
    }
    public function EmptyDataGroup($group){
        return !empty($this->getAttributesGroup($group));
    }
    /*
     * Функция получения значения произвольного поля
    */
    public function getAttributesValue($code)
    {
        $data = [];
        foreach ($this->getOwner()->{$this->attributeName} as $key => $value) {
            $data[$value['code']] = $value;
        }
        return (!empty($data[$code])) ? $data[$code] : false;
    }

    /*
     * Фунция получения url изображения
    */
    public function getFieldImageUrl($width = 0, $height = 0, $crop = true, $name)
    {
        $file = Yii::getPathOfAlias('webroot')."/uploads/{$this->uploadCustomfield}/{$name}";
        if(file_exists($file)){
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if($ext == 'svg'){
                return "/uploads/{$this->uploadCustomfield}/{$name}";
            }
            if ($width || $height) {
                return Yii::app()->thumbnailer->thumbnail(
                    $file,
                    $this->uploadCustomfield,
                    $width,
                    $height,
                    $crop
                );
            }

            return "/uploads/{$this->uploadCustomfield}/{$name}";
        }
        return false;
    }
    /*
     * Фунция получения url изображения
    */
    public function getFieldGalImageUrl($width = 0, $height = 0, $crop = true, $name)
    {
        $file = Yii::getPathOfAlias('webroot')."/uploads/{$this->uploadCustomfieldGallery}/{$name}";
        if(file_exists($file)){
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if($ext == 'svg'){
                return "/uploads/{$this->uploadCustomfieldGallery}/{$name}";
            }
            if ($width || $height) {
                return Yii::app()->thumbnailer->thumbnail(
                    $file,
                    $this->uploadCustomfieldGallery,
                    $width,
                    $height,
                    $crop
                );
            }

            return "/uploads/{$this->uploadCustomfieldGallery}/{$name}";
        }
        return false;
    }

    /* Преобразование изображения в webp и вовзрат пути до него */
    public function geFieldImageWebp($width = 0, $height = 0, $crop = true, $name)
    {
        // Получаем изображение
        $file = $this->getFieldImageUrl($width, $height, $crop, $name);
        // Получаем массив, где есть путь до папки, имя файла и расширение
        $pathinfo = pathinfo($file);
        // Получаем относительный путь к изображению
        $relativefile = str_replace(Yii::app()->request->getHostInfo(), '', $file);
        // Получаем абсолютный путь до изображения
        $fullpathfile = Yii::getPathOfAlias('webroot').$relativefile;
        // Задаем путь к изображению webp
        $webppath = dirname($fullpathfile).'/'.$pathinfo['filename'].'.webp';

        // В зависимости от расширения, преобразуем изображение в webp
        switch ($pathinfo['extension']) {
            case 'jpeg':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'jpg':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'png':
                $img = imagecreatefrompng($fullpathfile);
                break;
            case 'gif':
                $img = imagecreatefromgif($fullpathfile);
                break;
            case 'JPEG':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'JPG':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'PNG':
                $img = imagecreatefrompng($fullpathfile);
                break;
            case 'GIF':
                $img = imagecreatefromgif($fullpathfile);
                break;
        }

        // Проверяем наличие файла, и если его нет - преобразуем в webp
        if(!file_exists($webppath)){
            imagepalettetotruecolor($img);
            imagewebp($img, $webppath, 100);
            //imagedestroy($img);
        }

        // Возвращаем путь к webp изображению
        return dirname($file).'/'.basename($webppath);
    }

    public function geFieldGalImageWebp($width = 0, $height = 0, $crop = true, $name)
    {
        // Получаем изображение
        $file = $this->getFieldGalImageUrl($width, $height, $crop, $name);
        // Получаем массив, где есть путь до папки, имя файла и расширение
        $pathinfo = pathinfo($file);
        // Получаем относительный путь к изображению
        $relativefile = str_replace(Yii::app()->request->getHostInfo(), '', $file);
        // Получаем абсолютный путь до изображения
        $fullpathfile = Yii::getPathOfAlias('webroot').$relativefile;
        // Задаем путь к изображению webp
        $webppath = dirname($fullpathfile).'/'.$pathinfo['filename'].'.webp';

        // В зависимости от расширения, преобразуем изображение в webp
        switch ($pathinfo['extension']) {
            case 'jpeg':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'jpg':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'png':
                $img = imagecreatefrompng($fullpathfile);
                break;
            case 'gif':
                $img = imagecreatefromgif($fullpathfile);
                break;
            case 'JPEG':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'JPG':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'PNG':
                $img = imagecreatefrompng($fullpathfile);
                break;
            case 'GIF':
                $img = imagecreatefromgif($fullpathfile);
                break;
        }

        // Проверяем наличие файла, и если его нет - преобразуем в webp
        if(!file_exists($webppath)){
            imagepalettetotruecolor($img);
            imagewebp($img, $webppath, 100);
            //imagedestroy($img);
        }

        // Возвращаем путь к webp изображению
        return dirname($file).'/'.basename($webppath);
    }
}

/*********************************
*************** END **************
*********************************/