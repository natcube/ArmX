<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
* 上传类
*/
class ArmX_Upload
{
	//上传文件目录
    const UPLOAD_DIR = '/usr/uploads';

    /**
     * 调用类方法
     * @param  [type] $className [description]
     * @param  [type] $method    [description]
     * @return [type]            [description]
     */
    public static function call($className, $method = '')
    {
        $className = explode('::', $className);
        return array(ArmX_Plugin::NAME . '_' . $className[0], $className[1] ? $className[1] : $method);
    }

    /**
     * 调用类
     * @param  [type] $className [description]
     * @return [type]            [description]
     */
    public static function get($className)
    {
        $className = explode('::', $className);
        return ArmX_Plugin::NAME . '_' . $className[0];
    }

    /**
     * 判断附件是否为图片
     * @author NatLiu
     * @date   2017-12-25T10:18:55+0800
     * @param  [type]                   $ext [description]
     * @return boolean                       [description]
     */
    public static function isImage($ext)
    {
        return in_array($ext, array('jpg', 'jpeg', 'gif', 'png', 'tiff', 'bmp'));
    }
	
    /**
     * 创建上传路径
     *
     * @access private
     * @param string $path 路径
     * @return boolean
     */
    private static function makeUploadDir($path)
    {
        $path = preg_replace("/\\\+/", '/', $path);
        $current = rtrim($path, '/');
        $last = $current;

        while (!is_dir($current) && false !== strpos($path, '/')) {
            $last = $current;
            $current = dirname($current);
        }

        if ($last == $current) {
            return true;
        }

        if (!@mkdir($last)) {
            return false;
        }

        $stat = @stat($last);
        $perms = $stat['mode'] & 0007777;
        @chmod($last, $perms);

        return self::makeUploadDir($path);
    }

    /**
     * 获取安全的文件名 
     * 
     * @param string $name 
     * @static
     * @access private
     * @return string
     */
    private static function getSafeName(&$name)
    {
        $name = str_replace(array('"', '<', '>'), '', $name);
        $name = str_replace('\\', '/', $name);
        $name = false === strpos($name, '/') ? ('a' . $name) : str_replace('/', '/a', $name);
        $info = pathinfo($name);
        $name = substr($info['basename'], 1);
    
        return isset($info['extension']) ? strtolower($info['extension']) : '';
    }

    /**
     * 检查文件名
     *
     * @access private
     * @param string $ext 扩展名
     * @return boolean
     */
    public static function checkFileType($ext)
    {
        return in_array($ext, Typecho_Widget::widget('Widget_Options')->allowedAttachmentTypes);
    }

    /**
     * 剪裁多图
     * @param  [type] $path      [description]
     * @param  [type] $name      [description]
     * @param  [type] $ext       [description]
     * @param  [type] $multiSize [description]
     * @param  [type] $pathDir   [description]
     * @param  [type] $_pathDir  [description]
     * @return [type]            [description]
     */
    private static function cropImage($path, $multiSize = array())
    {
        $info = pathinfo($path);
        if (!self::isImage($info['extension'])) {
            return false;
        }
        $imageclass = self::get('Image');
        $images = [];
        foreach ($multiSize as $sizeType => $size) {
            $image = $imageclass::open($path);
            if ( $size['width'] == 0 || $size['height'] == 0 
                || ( $image->width() < 1.01 * $size['width']
                && $image->height() < 1.01 * $size['height'] ) && !$size['force'] ) {
                continue;
            }
            $type = $size['crop'] ? $imageclass::THUMB_CENTER : $imageclass::THUMB_SCALING;
            $fileName = $info['filename']. '-' . $sizeType . '.' . $info['extension'];
            $new = $info['dirname'] . '/' . $fileName;
            if ($image->thumb($size['width'], $size['height'], $type)->save($new, null, 85)) {

                $images[$sizeType] = array(
                        'name' => $fileName,
                        'width' => $image->width(),
                        'height' => $image->height(),
                        'type' => $image->type(),
                        'mime' => $image->mime(),
                        'size' => filesize($new),
                        'path' => $new
                    );
            }
        }
        return $images;
    }

    /**
     * 保存多尺寸图
     * @author NatLiu
     * @date   2017-12-22T09:10:18+0800
     * @return [type]                   [description]
     */
    public function saveMultiSizeImages(&$images, $basePath, $copyPath = '')
    {
        foreach ($images as $size => $image) {
            $info = pathinfo($image['path']);
            $fileName = $info['filename'] . '.' . $info['extension'];
            $images[$size]['path'] = $basePath . '/' . $fileName;
            if (!empty($copyPath)) {
                @copy($image['path'], $copyPath . '/' . $fileName);
            }
        }
    }

    /**
     * 上传操作
     * @param  [type]  $file      [description]
     * @param  boolean $localSave [description]
     * @return [type]             [description]
     */
    public static function uploadHandle($file, $multiSize = false, $localSave = false)
    {
        $ext = self::getSafeName($file['name']);
        if (!self::checkFileType($ext) || Typecho_Common::isAppEngine()) {
            return false;
        }

        $date = new Typecho_Date();
        $datePath = '/' . $date->year . '/' . $date->month;
        $dir = defined('__TYPECHO_UPLOAD_DIR__') ? __TYPECHO_UPLOAD_DIR__ : self::UPLOAD_DIR;
        $root = defined('__TYPECHO_UPLOAD_ROOT_DIR__') ? __TYPECHO_UPLOAD_ROOT_DIR__ : __TYPECHO_ROOT_DIR__;
        $basePath = Typecho_Common::url($datePath, $dir);
        $pathDir = Typecho_Common::url($basePath, $root);

        //创建上传目录
        if (!is_dir($pathDir)) {
            if (!self::makeUploadDir($pathDir)) {
                return false;
            }
        }

        //获取文件名
        $name = sprintf('%u', crc32(uniqid()));
        $fileName = $name . '.' . $ext;
        $path = $pathDir . '/' . $fileName;

        if (isset($file['tmp_name'])) {

            //移动上传文件
            if (!@move_uploaded_file($file['tmp_name'], $path)) {
                return false;
            }
        } else if (isset($file['bytes'])) {

            //直接写入文件
            if (!file_put_contents($path, $file['bytes'])) {
                return false;
            }
        } else {
            return false;
        }

        if (!isset($file['size'])) {
            $file['size'] = filesize($path);
        }

        //  同步保存到源站
        if ($localSave) {
            $_pathDir = Typecho_Common::url($basePath, __TYPECHO_ROOT_DIR__);
            // 复制到源站
            if (!is_dir($_pathDir)) {
                if (!self::makeUploadDir($_pathDir)) {
                    return false;
                }
            }
            @copy($path, $_pathDir . '/' . $fileName);
        }
        
        $result = $full = array(
            'name' => $file['name'],
            'path' => $basePath . '/'. $fileName,
            'size' => $file['size'],
            'type' => $ext,
            'mime' => Typecho_Common::mimeContentType($path)
        );
        // 对图片处理多尺寸
        if (self::isImage($ext)) {
            $sizes = array();
            if (!empty($multiSize)) {
                $sizes = self::cropImage($path, $multiSize);
                self::saveMultiSizeImages($sizes, $basePath, $_pathDir);
            }
            if ($imageinfo = getimagesize($path)) {
                $sizes['full'] = array_merge($full, array('width'=>$imageinfo[0],'height'=>$imageinfo[1]));
            }
            $result['sizes'] = $sizes;
        }

        //返回相对存储路径
        return $result;
    }

    /*修改文件
     *
     * @access public
     * @param array $content 老文件
     * @param array $file 新上传的文件
     * @return mixed
     */
    public static function modifyHandle($content, $file, $multiSize = false, $localSave = false)
    {
        $ext = self::getSafeName($file['name']);
        
        if ($content['attachment']->type != $ext || Typecho_Common::isAppEngine()) {
            return false;
        }

        $path = Typecho_Common::url($content['attachment']->path, defined('__TYPECHO_UPLOAD_ROOT_DIR__') ? __TYPECHO_UPLOAD_ROOT_DIR__ : __TYPECHO_ROOT_DIR__);
        $dir = dirname($path);
        $_basePath = pathinfo($content['attachment']->path);

        //创建上传目录
        if (!is_dir($dir)) {
            if (!self::makeUploadDir($dir)) {
                return false;
            }
        }

        if (isset($file['tmp_name'])) {
            
            @unlink($path);

            //移动上传文件
            if (!@move_uploaded_file($file['tmp_name'], $path)) {
                return false;
            }
        } else if (isset($file['bytes'])) {
            
            @unlink($path);

            //直接写入文件
            if (!file_put_contents($path, $file['bytes'])) {
                return false;
            }
        } else {
            return false;
        }

        if (!isset($file['size'])) {
            $file['size'] = filesize($path);
        }

        if ($localSave) {
            $localPath = Typecho_Common::url($content['attachment']->path, __TYPECHO_ROOT_DIR__);
            @unlink($localPath);
            @copy($path, $localPath);
            $_pathDir = Typecho_Common::url($_basePath, __TYPECHO_ROOT_DIR__);
            
        }

        $sizes = array();
        if (!empty($multiSize)) {
            $sizes = self::cropImage($path, $multiSize);
            self::saveMultiSizeImages($sizes, $_basePath['dirname'], $_pathDir);
        }

        //返回相对存储路径
        return array(
            'name' => $content['attachment']->name,
            'path' => $content['attachment']->path,
            'size' => $file['size'],
            'type' => $content['attachment']->type,
            'mime' => $content['attachment']->mime,
            'sizes' => $sizes
        );
    }
}