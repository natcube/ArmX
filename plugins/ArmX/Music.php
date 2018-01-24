<?php
/*!
 * 音乐类，参考修改自 metowolf/Meting
 * https://github.com/metowolf/Meting
 */
class ArmX_Music
{
    const SITES = array('netease', 'xiami', '163.opdays.com');
    protected $_SITE;
    protected $_TEMP;
    protected $_RETRY = 3;
    protected $_FORMAT = false;
    public function __construct($v = 'xiami')
    {
        $this->site($v);
    }
    public function site($v)
    {
        $this->_SITE=in_array($v,self::SITES)?$v:'xiami';
        return $this;
    }
    public function cookie($v = '')
    {
        if (!empty($v)) {
            $this->_TEMP['cookie']=$v;
        }
    }
    public function format($v = true)
    {
        $this->_FORMAT=$v;
        return $this;
    }
    private function curl($API)
    {
        if (isset($API['encode'])) {
            $API=call_user_func_array(array($this,$API['encode']), array($API));
        }
        $BASE=$this->curlset();
        $curl=curl_init();
        if ($API['method']=='POST') {
            if (is_array($API['body'])) {
                $API['body']=http_build_query($API['body']);
            }
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $API['body']);
        } elseif ($API['method']=='GET') {
            if (isset($API['body'])) {
                $API['url']=$API['url'].'?'.http_build_query($API['body']);
            }
        }
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 20);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_IPRESOLVE, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_URL, $API['url']);
        curl_setopt($curl, CURLOPT_COOKIE, isset($this->_TEMP['cookie'])?$this->_TEMP['cookie']:$BASE['cookie']);
        curl_setopt($curl, CURLOPT_REFERER, $BASE['referer']);
        curl_setopt($curl, CURLOPT_USERAGENT, $BASE['useragent']);
        for ($i=0;$i<=$this->_RETRY;$i++) {
            $data=curl_exec($curl);
            $info=curl_getinfo($curl);
            $error=curl_errno($curl);
            $status=$error?curl_error($curl):'';
            if (!$error) {
                break;
            }
        }
        curl_close($curl);
        if ($error) {
            return array(
                    'error'  => $error,
                    'info'   => $info,
                    'status' => $status,
                );
        }
        if ($this->_FORMAT&&isset($API['decode'])) {
            $data = call_user_func_array(array($this,$API['decode']), array($data));
        }
        $data=json_decode($data, 1);
        if ($this->_FORMAT&&isset($API['format'])) {
            return $this->clean($data, $API['format']);
        }
        return $data;
    }
    private function pickup($array, $rule)
    {
        $t=explode('#', $rule);
        foreach ($t as $vo) {
            if (!isset($array[$vo])){
                return array();
            }
            $array=$array[$vo];
        }
        return $array;
    }
    private function clean($raw, $rule)
    {
        if (!empty($rule)) {
            $raw = $this->pickup($raw, $rule);
        }
        if (!isset($raw[0])&&sizeof($raw)) {
            $raw=array($raw);
        }
        $result=array_map(array($this,'format_'.$this->_SITE), $raw);
        return $result;
    }
    public function search($keyword, $page=1, $limit=30)
    {
        switch ($this->_SITE) {
            case 'netease':
                $API=array(
                    'method' => 'POST',
                    'url'    => 'http://music.163.com/api/linux/forward',
                    'body'   => array(
                        'method' => 'POST',
                        'params' => array(
                            's'      => $keyword,
                            'type'   => 1,
                            'limit'  => $limit,
                            'total'  => 'true',
                            'offset' => ($page-1)*$limit,
                        ),
                        'url' => 'http://music.163.com/api/cloudsearch/pc',
                    ),
                    'encode' => 'netease_AESECB',
                    'format' => 'result#songs',
                );
                break;
            case 'xiami':
                $API=array(
                    'method' => 'GET',
                    'url'    => 'http://api.xiami.com/web',
                    'body'   => array(
                        'v'       => '2.0',
                        'app_key' => '1',
                        'key'     => $keyword,
                        'page'    => $page,
                        'limit'   => $limit,
                        'r'       => 'search/songs',
                    ),
                    'format' => 'data#songs',
                );
                break;
        }
        return $this->curl($API);
    }
    public function song($id)
    {
        switch ($this->_SITE) {
            case 'netease':
                $API=array(
                    'method' => 'POST',
                    'url'    => 'http://music.163.com/api/linux/forward',
                    'body'   => array(
                        'method' => 'POST',
                        'params' => array(
                            'c' => '[{"id":'.$id.'}]',
                        ),
                        'url' => 'http://music.163.com/api/v3/song/detail',
                    ),
                    'encode' => 'netease_AESECB',
                    'format' => 'songs',
                );
                break;
            case 'xiami':
                $API=array(
                    'method' => 'GET',
                    'url'    => 'http://api.xiami.com/web',
                    'body'   => array(
                        'v'       => '2.0',
                        'app_key' => '1',
                        'id'      => $id,
                        'r'       => 'song/detail',
                    ),
                    'format' => 'data#song',
                );
                break;
        }
        return $this->curl($API);
    }

    public function top($page = 1, $limit = 30)
    {
        switch ($this->_SITE) {
            case 'netease':
                # code...
                break;
            
            case 'xiami':
                $API = array(
                        'method' => 'GET',
                        'url' => 'http://www.xiami.com/chart/data?c=103&type=0&page='.$page.'&limit='.$limit,
                        'decode' => 'xiami_top'
                    );
                break;
        }

        return $this->curl($API);
    }

    public function album($id)
    {
        switch ($this->_SITE) {
            case 'netease':
                $API=array(
                    'method' => 'POST',
                    'url'    => 'http://music.163.com/api/linux/forward',
                    'body'   => array(
                        'method' => 'GET',
                        'params' => array(
                            'id' => $id,
                        ),
                        'url' => 'http://music.163.com/api/v1/album/'.$id,
                    ),
                    'encode' => 'netease_AESECB',
                    'format' => 'songs',
                );
                break;
            case 'xiami':
                $API=array(
                    'method' => 'GET',
                    'url'    => 'http://api.xiami.com/web',
                    'body'   => array(
                        'v'       => '2.0',
                        'app_key' => '1',
                        'id'      => $id,
                        'r'       => 'album/detail',
                    ),
                    'format' => 'data#songs',
                );
                break;
        }
        return $this->curl($API);
    }
    public function artist($id, $limit=50)
    {
        switch ($this->_SITE) {
            case 'netease':
                $API=array(
                    'method' => 'POST',
                    'url'    => 'http://music.163.com/api/linux/forward',
                    'body'   => array(
                        'method' => 'GET',
                        'params' => array(
                            'top' => $limit,
                            "id"  => $id,
                            "ext" => "true",
                        ),
                        'url' => 'http://music.163.com/api/v1/artist/'.$id,
                    ),
                    'encode' => 'netease_AESECB',
                    'format' => 'hotSongs',
                );
                break;
            case 'xiami':
                $API=array(
                    'method' => 'GET',
                    'url'    => 'http://api.xiami.com/web',
                    'body'   => array(
                        'v'       => '2.0',
                        'app_key' => '1',
                        'id'      => $id,
                        'limit'   => $limit,
                        'page'    => 1,
                        'r'       => 'artist/hot-songs',
                    ),
                    'format' => 'data',
                );
                break;
        }
        return $this->curl($API);
    }
    public function playlist($id)
    {
        switch ($this->_SITE) {
            case 'netease':
                $API=array(
                    'method' => 'POST',
                    'url'    => 'http://music.163.com/api/linux/forward',
                    'body'   => array(
                        'method' => 'POST',
                        'params' => array(
                            'id' => $id,
                            "n"  => 1000,
                        ),
                        'url' => 'http://music.163.com/api/v3/playlist/detail',
                    ),
                    'encode' => 'netease_AESECB',
                    'format' => 'playlist#tracks',
                );
                break;
            case 'xiami':
                $API=array(
                    'method' => 'GET',
                    'url'    => 'http://api.xiami.com/web',
                    'body'   => array(
                        'v'       => '2.0',
                        'app_key' => '1',
                        'id'      => $id,
                        'r'       => 'collect/detail',
                    ),
                    'format' => 'data#songs',
                );
                break;
        }
        return $this->curl($API);
    }

    public function detail($id){
        switch ($this->_SITE) {
            case 'netease':
                $API=array(
                    'method' => 'GET',
                    'url'    => 'http://163.opdays.com/song/detail?id='.$id,
                    'decode' => 'netease_detail'
                );
            break;
        }

        return $this->curl($API);
    }

    public function url($id, $br=320)
    {
        switch ($this->_SITE) {
            case 'netease':

                $API=array(
                    'method' => 'POST',
                    'url'    => 'http://music.163.com/api/linux/forward',
                    'body'   => array(
                        'method' => 'POST',
                        'params' => array(
                            'ids' => array($id),
                            'br'  => $br*1000,
                        ),
                        'url' => 'http://music.163.com/api/song/enhance/player/url',
                    ),
                    'encode' => 'netease_AESECB',
                    'decode' => 'netease_url',
                );
                break;
            case 'xiami':
                $API=array(
                    'method' => 'GET',
                    'url'    => 'http://www.xiami.com/song/gethqsong/sid/'.$id,
                    'body'   => array(
                        'v'       => '2.0',
                        'app_key' => '1',
                        'id'      => $id,
                        'r'       => 'song/detail',
                    ),
                    'decode' => 'xiami_url',
                );
                break;
        }
        $this->_TEMP['br']=$br;
        return $this->curl($API);
    }
    public function lyric($id)
    {
        switch ($this->_SITE) {
            case 'netease':
                $API=array(
                    'method' => 'POST',
                    'url'    => 'http://music.163.com/api/linux/forward',
                    'body'   => array(
                        'method' => 'POST',
                        'params' => array(
                            'id' => $id,
                            'os' => 'linux',
                            'lv' => -1,
                            'kv' => -1,
                            'tv' => -1,
                        ),
                        'url' => 'http://music.163.com/api/song/lyric',
                    ),
                    'encode' => 'netease_AESECB',
                    'decode' => 'netease_lyric',
                );
                break;
            case 'xiami':
                $API=array(
                    'method' => 'GET',
                    'url'    => 'http://api.xiami.com/web',
                    'body'   => array(
                        'v'       => '2.0',
                        'app_key' => '1',
                        'id'      => $id,
                        'r'       => 'song/detail',
                    ),
                    'decode' => 'xiami_lyric',
                );
                break;
        }
        return $this->curl($API);
    }
    public function pic($id, $size=150)
    {
        switch ($this->_SITE) {
            case 'netease':
                $url='https://p3.music.126.net/'.$this->netease_pickey($id).'/'.$id.'.jpg?param='.$size.'y'.$size;
                break;
            case 'xiami':
                $format=$this->_FORMAT;
                $data=$this->format(false)->song($id);
                $this->format($format);
                $url=$data['data']['song']['logo'];
                $url=str_replace(array('_1.','http:','img.'), array('.','https:','pic.'), $url).'@'.$size.'h_'.$size.'w_100q_1c.jpg';
                break;
        }
        return array('url'=>$url);
    }
    private function curlset()
    {
        switch ($this->_SITE) {
            case 'netease':
                return array(
                    'referer'   => 'https://music.163.com/',
                    'cookie'    => 'os=linux; appver=1.0.0.1026; osver=Ubuntu%2016.10; MUSIC_U=' . $this->getRandomHex(112) . '; __remember_me=true',
                    'useragent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
                );
            case 'xiami':
                return array(
                    'referer'   => 'http://h.xiami.com/',
                    'cookie'    => 'user_from=2;XMPLAYER_addSongsToggler=0;XMPLAYER_isOpen=0;_xiamitoken=123456789' . $this->getRandomHex(32) . ';',
                    'useragent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
                );
        }
    }
    private function getRandomHex($length)
    {
        $val = '';
        for( $i=0; $i<$length; $i++ ) {
           $val .= chr( rand( 65, 90 ) );
        }
        return $val;
    }
    /**
     * 乱七八糟的函数，加密解密...
     * 正在努力重构这些代码 TAT
     */
    private function netease_AESECB($API)
    {
        $KEY='7246674226682325323F5E6544673A51';
        $body=json_encode($API['body']);
        if (function_exists('openssl_encrypt')) {
            $body=openssl_encrypt($body, 'aes-128-ecb', pack('H*', $KEY));
        } else {
            $PAD=16-(strlen($body)%16);
            $body=base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, hex2bin($KEY), $body.str_repeat(chr($PAD), $PAD), MCRYPT_MODE_ECB));
        }
        $body=strtoupper(bin2hex(base64_decode($body)));
        $API['body']=array(
            'eparams'=>$body,
        );
        return $API;
    }
    private function netease_pickey($id)
    {
        $magic=str_split('3go8&$8*3*3h0k(2)2');
        $song_id=str_split($id);
        for ($i=0;$i<count($song_id);$i++) {
            $song_id[$i]=chr(ord($song_id[$i])^ord($magic[$i%count($magic)]));
        }
        $result=base64_encode(md5(implode('', $song_id), 1));
        $result=str_replace(array('/','+'), array('_','-'), $result);
        return $result;
    }

    private function netease_detail($result){
        $data = json_decode($result, 1);
        $url = array(
               'src'=> array('url'=>$data['url'] ? $data['url'] : ''),
               'pic' => array('url'=> $data['cover'] ? $data['cover'] : ''),
               'artist'=>array(),
               'name' => $data['name'],
               'id' => $data['song_id']
            );
        if (!empty($data['author'])) {
            $url['artist'][] = $data['author'];
        }
        return json_encode($url);
    }
    /**
     * URL - 歌曲地址转换函数
     * 用于返回不高于指定 bitRate 的歌曲地址（默认规范化）
     */
    private function netease_url($result)
    {
        $data=json_decode($result, 1);
        if (isset($data['data'][0]['uf']['url'])) {
            $data['data'][0]['url']=$data['data'][0]['uf']['url'];
        }
        if (isset($data['data'][0]['url'])) {
            $url=array(
                'url' => $data['data'][0]['url'],
                'br'  => $data['data'][0]['br']/1000,
            );
        } else {
            $url=array(
                'url' => '',
                'br'  => -1,
            );
        }
        return json_encode($url);
    }
    private function xiami_url($result)
    {
        $data=json_decode($result, 1);
        if (!empty($data['location'])) {
            $location = $data['location'];
            $num = (int)$location[0];
            $str = substr($location, 1);
            $len = floor(strlen($str)/$num);
            $sub = strlen($str) % $num;
            $qrc = array();
            $tmp = 0;
            $urlt = '';
            for (;$tmp<$sub;$tmp++) {
                $qrc[$tmp] = substr($str, $tmp*($len+1), $len+1);
            }
            for (;$tmp<$num;$tmp++) {
                $qrc[$tmp] = substr($str, $len*$tmp+$sub, $len);
            }
            for ($tmpa=0;$tmpa<$len+1;$tmpa++) {
                for ($tmpb=0;$tmpb<$num;$tmpb++) {
                    if (isset($qrc[$tmpb][$tmpa])) {
                        $urlt.=$qrc[$tmpb][$tmpa];
                    }
                }
            }
            $urlt=str_replace('^', '0', urldecode($urlt));
            $url=array(
                'url' => str_replace('http://','https://',urldecode($urlt)),
                'br'  => 320,
            );
        } else {
            $url=array(
                'url' => '',
                'br'  => -1,
            );
        }
        return json_encode($url);
    }

    /**
     * 歌词处理模块
     * 用于规范化歌词输出
     */
    private function netease_lyric($result)
    {
        if (!$this->_FORMAT) {
            return $result;
        }
        $result=json_decode($result, 1);
        $data=array(
           'lyric'  => isset($result['lrc']['lyric'])?$result['lrc']['lyric']:'',
           'tlyric' => isset($result['tlyric']['lyric'])?$result['tlyric']['lyric']:'',
        );
        return json_encode($data);
    }
    private function xiami_lyric($result)
    {
        if (!$this->_FORMAT) {
            return $result;
        }
        $result = json_decode($result, 1);
        $data = array('lyric'=>'', 'tlyric'=>'');
        if (isset($result['data']) && isset($result['data']['song']) && $lyric = $result['data']['song']['lyric']) {
            if ($content = @file_get_contents($lyric)) {
                $content = preg_replace('/<\d+>/', '', $content);
                preg_match_all('/\[\d{1,2}:\d{1,2}(\.\d+)?\].+(\n+)?/i', $content, $matches);
                if ($matches) {
                    $data['lyric'] = $data['tlyric'] = implode('', $matches[0]);
                }
            }
        }
        return json_encode($data);
    }

    private function xiami_top($result)
    {
        if (!$this->_FORMAT) {
            return $result;
        }
        $data = [];

        preg_match_all("|<tr[^>]+demoid=\"(\d+)\"[^>]+>[\s\S]+<img[^>]+src=\"([^>]+)\"[\s\S]+<strong><a[^>]+>([^<]+)</a></strong>[\s\S]+<p>[^<]+(<a class=\"artist\"[^>]+>[^<]+</a[\s\S]+)</p>|U", $result, $matches, PREG_SET_ORDER);
        if (!empty($matches)) {
            foreach ($matches as $match) {
                $row = [
                    'id'=>$match[1],
                    'name'=>$match[3],
                    'artist'    => array(),
                    'pic_id'    => $match[1],
                    'url_id'    => $match[1],
                    'lyric_id'  => $match[1],
                    'pic' => $match[2],
                    'source'    => 'xiami',
                ];
                preg_match_all("|class=\"artist\"[^>]+>([^<]+)</a|U", $match[4], $artist);
                if ($artist) {
                    $row['artist'] = $artist[1];
                }
                $data[] = $row;
            }
        }
        return json_encode($data);
    }
    /**
     * Format - 规范化函数
     * 用于统一返回的参数，可用 ->format() 一次性开关开启
     */
    private function format_netease($data)
    {
        $result=array(
            'id'        => $data['id'],
            'name'      => $data['name'],
            'artist'    => array(),
            'album'     => $data['al']['name'],
            'pic_id'    => isset($data['al']['pic_str'])?$data['al']['pic_str']:$data['al']['pic'],
            'url_id'    => $data['id'],
            'lyric_id'  => $data['id'],
            'duration'  => $data['dt'],
            'source'    => 'netease',
        );
        if (isset($data['al']['picUrl'])) {
            preg_match('/\/(\d+)\./', $data['al']['picUrl'], $match);
            $result['pic_id']=$match[1];
        }
        foreach ($data['ar'] as $vo) {
            $result['artist'][]=$vo['name'];
        }
        return $result;
    }

    private function format_xiami($data)
    {
        $result=array(
            'id'       => $data['song_id'],
            'name'     => $data['song_name'],
            'artist'   => explode(';', isset($data['singers'])?$data['singers']:$data['artist_name']),
            'album'    => $data['album_name'],
            'pic_id'   => $data['song_id'],
            'url_id'   => $data['song_id'],
            'lyric_id' => $data['song_id'],
            'source'   => 'xiami',
        );
        if (isset($data['logo'])) {
            $result['pic'] = $data['logo'];
        }
        if (isset($data['listen_file'])) {
            $result['src'] = $data['listen_file'];
        }
        return $result;
    }
}