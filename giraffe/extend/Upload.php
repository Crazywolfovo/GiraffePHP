<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription: Upload files class
    | Using: $a = new Upload();
    |        $b = $a->uploadfiles();
    |        var_dump($a->showerror());
    |        var_dump($b);
    |-----------------------------------------------------------------------------------
*/
namespace giraffe\extend;

class Upload
{
    /**
     * upload files
     * @var [array(array)]
     */
    private $files;
    /**
     * upload files number
     * @var [int]
     * private $filesnum;
     */
    /**
     * error infomations
     * @var [string]
     */
    private $error;
    /**
     * error infomations array
     * @var [array]
     */
    private $errorarray = array();
    /**
     * uploadpath
     * @var [string]
     */
    private $uploadpath;
    /**
     * allow extensions
     * @var [array(array)]
     */
    private $allowExt;
    /**
     * allow mime types
     * @var [array(array)]
     */
    private $allowMime;
    /**
     * maxsize
     * @var [int B]
     */
    private $maxsize;
    /**
     * initilize variable
     */
    public function __construct()
    {
        $this->files = $this->getfiles();
        // var_dump($this->files);
        // exit;
        //$this->filesnum = count($this->files);
        $this->setuploadpath();
        $this->setallowExt();
        $this->setallowMime();
        $this->setmaxsize();
    }
/*
*|-----------------------------------------------------------------------------------
*| Discription:set functions
*|-----------------------------------------------------------------------------------
*/
    public function setuploadpath($path = null)
    {
        if (!is_null($path)) {
            $this->uploadpath = $path;
        }else{
            $this->uploadpath = './upload';
        }
        return $this;
    }
    public function setallowExt($ext = null)
    {
        if (is_array($ext) && (count($ext) !== count($ext,COUNT_RECURSIVE))) {
            $this->allowExt = $ext;
        }else{
            $this->allowExt = ['image'=>['jpeg','jpg','png','gif','bmp']];
        }
        return $this;
    }
    public function setallowMime($mime = null)
    {
        if (is_array($mime) && (count($mime) !== count($mime,COUNT_RECURSIVE))) {
            $this->allowMime = $mime;
        }else{
            $this->allowMime = ['image'=>['image/jpeg','image/jpg','image/bmp','image/png','image/gif'],'files'=>['application/octet-stream']];
        }
        return $this;
    }
    public function setmaxsize($size = null)
    {
        if (is_numeric($size)) {
            $this->maxsize = $size;
        }else{
            $this->maxsize = 5242880;
        }
        return $this;
    }
/*
*|-----------------------------------------------------------------------------------
*| Discription:format $_FILES for upload
*|-----------------------------------------------------------------------------------
*/
    /**
     * format $_FILES for upload
     * @return [array]
     */
    private function getfiles()
    {
        foreach ($_FILES as $file) {
            $i=0;
            if(is_string($file['name'])){
                $files[$i] = $file;
                $i++;
            }elseif(is_array($file['name'])) {
                foreach ($file['name'] as $key => $value) {
                    $files[$i]['name'] = $file['name'][$key];
                    $files[$i]['type'] = $file['type'][$key];
                    $files[$i]['tmp_name'] = $file['tmp_name'][$key];
                    $files[$i]['error'] = $file['error'][$key];
                    $files[$i]['size'] = $file['size'][$key];
                    $i++;
                }
            }
        }
        return $files;
    }
/*
*|-----------------------------------------------------------------------------------
*| Discription:uploading
*|-----------------------------------------------------------------------------------
*/
    public function uploadfiles()
    {
        $uploadedflies = array();
        foreach ($this->files as $file) {
            $res = $this->uploadfile($file);
            if ($res && !empty($res)) {
                $uploadedflies[] = $res;
            }else{
                $this->errorarray[] = $file['name'].$this->error;
            }
        }
        if (!empty($uploadedflies)) {
            return $uploadedflies;
        }else{
            return false;
        }
    }
    private function uploadfile($file)
    {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $checksize = $this->checksize($file['size'],$this->maxsize);
            $checkext = $this->checkext($file['name']);
            $checkmime = $this->checkmime($file);
            $checkhttpost = $this->checkhttpost($file['tmp_name']);
            if ($checksize && $checkext && $checkmime && $checkhttpost) {
                $this->checkuploadpath($this->uploadpath);
                $uniname = $this->getuniname();
                $ext = $this->getfilext($file['name']);
                $destination = $this->uploadpath.'/'.$uniname.'.'.$ext;
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return $destination;
                }else{
                    $this->error = '文件移动失败';
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return $this->checkerror($file['error']);
        }
    }
/*
*|-----------------------------------------------------------------------------------
*| Discription:helper functions
*|-----------------------------------------------------------------------------------
*/
    private function checkuploadpath($uploadpath)
    {
        if (!file_exists($uploadpath)) {
            mkdir($uploadpath,0777,true);
            chmod($uploadpath,0777);
        }
    }
    private function getuniname()
    {
        return md5(uniqid(microtime(true),true));
    }
    private function getfilext($filename)
    {
        return strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    }
    private function dealarray($array)
    {
        $newarray = [];
        $i = 0;
        foreach ($array as $value) {
            foreach ($value as $v) {
                $newarray[$i] = $v;
                $i++;
            }
        }
        return $newarray;
    }
    public function showerror()
    {
        if (!empty($this->errorarray)) {
            return $this->errorarray;
        }else{
            return $this->error;
        }
    }
/*
*|-----------------------------------------------------------------------------------
*| Discription:check error functions
*|-----------------------------------------------------------------------------------
*/
    private function checkerror($errorinfo)
    {
        if (!is_null($errorinfo)) {
            if ($errorinfo > UPLOAD_ERR_OK) {
                switch ($errorinfo) {
                    case UPLOAD_ERR_INI_SIZE:
                        $this->error = "上传的文件超过了php.ini中upload_max_filesize选项限制的值";
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $this->error = "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $this->error = "文件只有部分被上传";
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        $this->error = "没有文件被上传";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $this->error = "找不到临时文件夹";
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $this->error = "文件写入失败";
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        $this->error = "由于PHP的扩展程序中断文件上传";
                        break;
                    default:
                        $this->error = "系统错误";
                        break;
                }
                return false;
            }else{
                return true;
            }
        }else{
            $this->error = '文件上传出错';
            return false;
        }
    }
    private function checksize($filesize,$maxsize)
    {
        if ($filesize > $maxsize) {
            $this->error = '上传文件过大';
            return false;
        }
        return true;
    }
    private function checkext($filename)
    {
        $allowExt = $this->dealarray($this->allowExt);
        $ext = $this->getfilext($filename);
        if (!in_array($ext, $allowExt)) {
             $this->error = '不允许的扩展名';
            return false;
        }
        return true;
    }
    private function checkmime($file)
    {
        $allmime = $this->dealarray($this->allowMime);
        if (!in_array($file['type'], $allmime)) {
            $this->error = '不允许的文件mime类型';
            return false;
        }else{
            if (!in_array($file['type'],$this->allowMime['image'])) {
                return true;
            }else{
                if (!getimagesize($file['tmp_name'])) {
                    $this->error = '不是真实的图片';
                    return false;
                }else{
                    return true;
                }
            }
        }
    }
    private function checkhttpost($filetemp)
    {
        if (!is_uploaded_file($filetemp)) {
            $this->error = '文件不是通过HTTPPOST方式上传的';
            return false;
        }
        return true;
    }
}