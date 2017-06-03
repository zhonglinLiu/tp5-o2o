<?php
class fileHelper{

	protected $file;
	protected static $ins = null;
	public static function instance(){
		if(is_null(self::$ins)){
			self::$ins = new self;
		}
		return self::$ins;
	}
	public function file($name = '')
    {
        if (empty($this->file)) {
            $this->file = isset($_FILES) ? $_FILES : [];
        }
        if (is_array($name)) {
            return $this->file = array_merge($this->file, $name);
        }
        $files = $this->file;
        if (!empty($files)) {
            // 处理上传文件
            $array = [];
            foreach ($files as $key => $file) {
                if (is_array($file['name'])) {
                    $item  = [];
                    $keys  = array_keys($file);
                    $count = count($file['name']);
                    for ($i = 0; $i < $count; $i++) {
                        if (empty($file['tmp_name'][$i]) || !is_file($file['tmp_name'][$i])) {
                            continue;
                        }
                        $temp['key'] = $key;
                        foreach ($keys as $_key) {
                            $temp[$_key] = $file[$_key][$i];
                        }
                        $item[] = $temp['tmp_name'];
                    }
                    $array[$key] = $item;
                }else{
                	$array[$key] = $file;
                	if (empty($file['tmp_name']) || !is_file($file['tmp_name'])) {
                        continue;
                    }
                }
            }
            return $array;
            
        }
        return;
    }

    
}