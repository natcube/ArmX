<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 第三方用户抽象组件
 *
 */

/**
 * 第三方用户抽象类
 *
 */
class ArmX_OAuth_Users extends Widget_Abstract
{
    /**
     * 判断用户openid是否存在
     *
     * @access public
     * @param string $openid 用户openid
     * @return boolean
     */
    public function openidExists($openid, $channel = 'qq')
    {
        $select = $this->db->select()
        ->from('table.oauths')
        ->where('openid = ? AND channel = ?', $openid, $channel)
        ->limit(1);

        $user = $this->db->fetchRow($select);
        return $user ? true : false;
    }

    /**
     * 判断是否绑定本地账号
     * @author NatLiu
     * @date   2018-01-17T08:34:45+0800
     * @param  [type]                   $openid [description]
     * @return boolean                          [description]
     */
    public function hasAccount($openid, $channel = 'qq')
    {
    	$select = $this->db->select()
        ->from('table.oauths')
        ->where('openid = ? AND channel = ?', $openid, $channel)
        ->limit(1);

        $user = $this->db->fetchRow($select);

        return $user && !empty($user['uid']) ? $user['uid'] : false;
    }

    /**
     * 获取本地账号
     *
     * @access public
     * @param string $openid 用户openid
     * @return boolean
     */
    public function account($openid, $channel = 'qq')
    {

        $uid = $this->hasAccount($openid, $channel);
        if ($uid) {
        	$select = $this->db->select()
	        ->from('table.users')
	        ->where('uid = ?', $uid)
	        ->limit(1);
        	$user = $this->db->fetchRow($select);
        }
        return $user ? $user : false;
    }

    /**
     * 将每行的值压入堆栈
     *
     * @access public
     * @param array $value 每行的值
     * @return array
     */
    public function push(array $value)
    {
        $value = $this->filter($value);
        return parent::push($value);
    }

    /**
     * 查询方法
     *
     * @access public
     * @return Typecho_Db_Query
     */
    public function select()
    {
        return $this->db->select()->from('table.oauths');
    }

    /**
     * 获得所有记录数
     *
     * @access public
     * @param Typecho_Db_Query $condition 查询对象
     * @return integer
     */
    public function size(Typecho_Db_Query $condition)
    {
        return $this->db->fetchObject($condition->select(array('COUNT(openid)' => 'num'))->from('table.oauths'))->num;
    }

    /**
     * 增加记录方法
     *
     * @access public
     * @param array $rows 字段对应值
     * @return integer
     */
    public function insert(array $rows)
    {
        return $this->db->query($this->db->insert('table.oauths')->rows($rows));
    }

    /**
     * 更新记录方法
     *
     * @access public
     * @param array $rows 字段对应值
     * @param Typecho_Db_Query $condition 查询对象
     * @return integer
     */
    public function update(array $rows, Typecho_Db_Query $condition)
    {
        return $this->db->query($condition->update('table.oauths')->rows($rows));
    }

    /**
     * 删除记录方法
     *
     * @access public
     * @param Typecho_Db_Query $condition 查询对象
     * @return integer
     */
    public function delete(Typecho_Db_Query $condition)
    {
        return $this->db->query($condition->delete('table.oauths'));
    }
}
