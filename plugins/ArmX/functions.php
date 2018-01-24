<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 通过ID获取widget
 * @author NatLiu
 * @date   2017-12-26T09:58:42+0800
 * @param  [type]                   $cid   [description]
 * @param  [type]                   $table [description]
 * @return [type]                          [description]
 */
function get_widget($cid, $table)
{
	$table = ucfirst($table);
    if (!in_array($table, array('Contents', 'Comments', 'Metas', 'Users'))) {
        return NULL;
    }

    $keys = array(
        'Contents'  =>  'cid',
        'Comments'  =>  'coid',
        'Metas'     =>  'mid',
        'Users'     =>  'uid'
    );

    $key = $keys[$table];
    $db = Typecho_Db::get();
    $className = "Widget_Abstract_{$table}@{$key}-{$cid}";
    $widget = Typecho_Widget::widget($className);
    
    $db->fetchRow(
        $widget->select()->where("{$key} = ?", $cid)->limit(1),
            array($widget, 'push'));

    return $widget;
}

/**
 * 通过ID获取附件对象
 * @author NatLiu
 * @date   2017-12-26T10:13:57+0800
 * @param  [type]                   $cid [description]
 * @return [type]                        [description]
 */
function get_attachment($cid)
{
	$widget = get_widget($cid, 'contents');
	if ($widget->have() && $widget->type == "attachment") {
		return $widget;
	}
}

/**
 * 通过ID获取缩略图附件对象
 * @author NatLiu
 * @date   2017-12-26T10:12:29+0800
 * @param  [type]                   $cid             [description]
 * @param  string                   $size            [description]
 * @param  string                   $thumbnail_field [description]
 * @return [type]                                    [description]
 */
function get_thumbnail_attachment($cid, $thumbnail_field = ArmX_Plugin::THUMB_FIELD)
{
	$post = get_widget($cid, 'contents');
	if ($post->have() && $post->fields->{$thumbnail_field}) {
		$thumbnail = get_attachment($post->fields->{$thumbnail_field});
		if ($thumbnail && $thumbnail->have() && $thumbnail->attachment->isImage) {
			return $thumbnail;
		}
	}
	return false;
}

/**
 * 通过ID获取缩略图对象
 * @author NatLiu
 * @date   2017-12-26T10:19:08+0800
 * @param  [type]                   $cid [description]
 * @return [type]                        [description]
 */
function get_thumbnail($cid, $size = 'thumbnail', $thumbnail_field = ArmX_Plugin::THUMB_FIELD)
{
	if ($thumbnail = get_thumbnail_attachment($cid, $thumbnail_field)) {
		if ($thumbnail->attachment->sizes && !empty($thumbnail->attachment->sizes[$size])) {
			return new Typecho_Config($thumbnail->attachment->sizes[$size]);
		}
		return $thumbnail->attachment;
	}
	return false;
}

/**
 * 通过ID获取缩略图地址
 * @author NatLiu
 * @date   2017-12-26T10:30:15+0800
 * @param  [type]                   $cid             [description]
 * @param  string                   $size            [description]
 * @param  string                   $thumbnail_field [description]
 * @return [type]                                    [description]
 */
function get_thumbnail_src($cid, $size = 'thumbnail', $thumbnail_field = ArmX_Plugin::THUMB_FIELD)
{
	if ($thumbnail = get_thumbnail($cid, $size = 'thumbnail', $thumbnail_field = '_thumbnail_id')) {
		return $thumbnail->url;
	}
	return false;
}


/**
 * 删除自定义字段
 * @author NatLiu
 * @date   2017-12-26T11:20:36+0800
 * @param  [type]                   $value [description]
 * @param  [type]                   $name  [description]
 * @return [type]                          [description]
 */
function delete_field($value, $name, $type = 'str')
{
	$db = Typecho_Db::get();
	return $db->query($db->delete('table.fields')
                    ->where( $type . '_value = ? AND name = ?', $value, $name));
}

/**
 * 获取字段
 * @author NatLiu
 * @date   2017-12-26T12:11:25+0800
 * @param  [type]                   $value [description]
 * @param  [type]                   $name  [description]
 * @param  string                   $type  [description]
 * @return [type]                          [description]
 */
function get_field($value, $name, $type = 'str')
{
	$db = Typecho_Db::get();
	return $db->fetchRow($db->select()->from('table.fields')
                    ->where( $type . '_value = ? AND name = ?', $value, $name));
}

/**
 * 获取图片的最小尺寸
 * @param  [type] $sizes [description]
 * @return [type]        [description]
 */
function get_small_size_image($sizes = array())
{
	$_sizes = array('thumbnail', 'medium', 'large', 'full');
	foreach ($_sizes as $size) {
		if ($image = $sizes[$size]) {
			return $image;
		}
	}
}

/**
 * 根据ID，NAME，删除字段
 * @param  [type] $cid  [description]
 * @param  [type] $name [description]
 * @param  [type] $type [description]
 * @return [type]       [description]
 */
function delete_field_by_name($cid, $name, $type = 'str')
{
	$db = Typecho_Db::get();
	return $db->query($db->delete('table.fields')
                    ->where( 'cid = ? AND name = ?', $cid, $name));
}

/**
 * 通过ID获取相关附件
 * @author NatLiu
 * @date   2018-01-02T10:35:13+0800
 * @param  string                   $cid    [description]
 * @param  integer                  $limit  [description]
 * @param  integer                  $offset [description]
 * @return [type]                           [description]
 */
function get_attachments($cid='', $limit = 0, $offset = 0)
{
	return Typecho_Widget::widget('Widget_Contents_Attachment_Related@' . $cid . '-' . uniqid(), array(
            'parentId'  => $cid,
            'limit'     => $limit,
            'offset'    => $offset
        ));
}