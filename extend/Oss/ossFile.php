<?php 
namespace Oss;
use OSS\OssClient;
use OSS\Core\OssException;
use think\File;
class ossFile extends File{
	protected static $accessKeyId;
	protected static $accessKeySecret;
	protected static $endpoint;
	protected $bucket;
	protected static $ossClient;
	protected $files;
	protected $checkFiles;
	public function __construct($filename,$bucket=''){
		if(is_null(self::$ossClient)){
			self::$accessKeyId = 'LTAI0dKswK5Yx6a3';
			self::$accessKeySecret = 'gQjQvfgjofq1IZqrZQRKaf1UBxNlnx';
			self::$endpoint = 'http://oss-cn-shanghai.aliyuncs.com';
			self::$ossClient = new OssClient(self::$accessKeyId,self::$accessKeySecret,self::$endpoint);
			$this->bucket = empty($bucket) ? 'liu-web-static' : $bucket;
		}
        parent::__construct($filename);
	}

	/**
	 * 上传文件
	 * @param  [type] $object   [上传到oss的文件名]
	 * @param  [type] $filePath [本地的文件名]
	 * @return [type]           [description]
	 */
	public function putObject($object,$filePath){
		try {
            self::$ossClient->putObject($this->bucket,$object,$filePath);
        } catch (OssException $e) {
            throw new \Exception($e->getMessage(),$e->getCode());
                  
        }
	}

    public function moves($path, $object,  $savename = true, $replace = true)
    {
        // 文件上传失败，捕获错误代码
        if (!empty($this->info['error'])) {
            $this->error($this->info['error']);
            return false;
        }

        // 检测合法性
        if (!$this->isValid()) {
            $this->error = '非法上传文件';
            return false;
        }

        // 验证上传
        if (!$this->check()) {
            return false;
        }
        $path = rtrim($path, DS) . DS;
        // 文件保存命名规则
        $saveName = $this->buildSaveName($savename);
        $filename = $path . $saveName;

        // 检测目录
        if (false === $this->checkPath(dirname($filename))) {
            return false;
        }

        /* 不覆盖同名文件 */
        if (!$replace && is_file($filename)) {
            $this->error = '存在同名文件' . $filename;
            return false;
        }

        /* 移动文件 */
        if ($this->isTest) {
            rename($this->filename, $filename);
        } elseif (!move_uploaded_file($this->filename, $filename)) {
            $this->error = '文件上传保存错误！';
            return false;
        }
        $filename = str_replace('\\','/',$filename);
        $this->putObject($object.'/'.$filename,$this->filename);
        // 返回 File对象实例
        $file = new self($filename,$this->bucket);
        $file->setSaveName($saveName);
        $file->setUploadInfo($this->info);
        return $file;
    }
    

}