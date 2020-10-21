<?php
define( 'WEB_ROOT' ,dirname( __FILE__ ) . '/' );
function sp_file_put_contents( $file , $data ) {
    $dir = dirname( $file );
    if ( is_writeable ( $dir )) {
        return file_put_contents ( $file , $data );
    } else {
        throw new writeFail(sprintf( "写入文件%s,失败，目录不可写" , $file ), 503);
    }
}
class _HtmlTag{
    protected $taglist = "if|elseif|else|loop|for|while|=|:=|:e|:html|:" ;
    protected $string ;
    protected $tpldir ;
    public $findReg ;
    function __construct( $dir , $tpl ) {
        $this ->findReg = "/\{[ ]*($this->taglist)(\s*[^\{\}]+\s*)?\}/i" ;
        $this ->tpldir = $dir ;
        $this ->tpl = $tpl ;
    }
    function render( $s ) {
        $s = str_replace ([ '<--{' , '}-->' ], [ '{' , '}' ], $s );
        if ( strpos ( $s , "{extends" ) !== false) {
            $s = $this ->_extends( $s );
        }
        $s = preg_replace( '/[\n\r]+/s' , "\n" , $s );
        $s = preg_replace( '/\r+/s' , "" , $s );
        $s = preg_replace( '/\t+/s' , "\t" , $s );
        $this ->string = str_replace ([ "\{" , "\}" ], [ "\HKH1" , "\HKH2" ], $s );
        preg_match_all( "/\{[ ]*(import)(\s*[^\{\}]+\s*)?\}/i" , $s , $d );
        foreach ( $d [0] as $k => $v ) {
            call_user_func_array( array ( $this , "_import" ), array ( $v , $d [1][ $k ], $d [2][ $k ]));
        }
        static $m = array ( "=" => "_defaultEcho" , ":=" => " _xssEcho" , ":e" => "_htmlencodeEcho" , ":" => "_echo" , ":html" => "_htmldecodeEcho" );
        preg_match_all( $this ->findReg, $this ->string, $d );
        foreach ( $d [0] as $k => $v ) {
            if (isset( $m [ $d [1][ $k ]])) {
                $medth = $m [ $d [1][ $k ]];
            } else {
                $medth = '_' . $d [1][ $k ];
            }
            call_user_func_array( array ( $this , $medth ), array ( $v , $d [1][ $k ], $d [2][ $k ]));
        }
    }
    function _extends( $tpl ) {
        preg_match( "/\{\s*extends\s+([^\{\}]+?)\s*\}/i" , $tpl , $d );
        list( $search , $arg ) = $d ;
        if ( stripos ( $arg , "." ) !==0 ) {
            $arg = '../' . $arg ;
        }
        //$file = $this->tpl->me->realTpl($arg . ".htm");
        $file = $arg . ".htm" ;
        $basetpl = file_get_contents ( $file );
        preg_match_all( "/\{block\s+([^\{\}]+?)\s*\}(.+?)\{\/block\}/s" , $tpl , $ds );
        foreach ( $ds [1] as $n => $name ) {
            $basetpl = preg_replace( "/\{block\s+name={$name}\s*\}/" , $ds [2][ $n ], $basetpl );
        }
        $basetpl = preg_replace( "/\{block\s+name=.+?\}/" , ' ' , $basetpl );

        return $basetpl ;
    }
    function _import ( $search , $tag , $arg ) {

        $arg = trim( $arg );
        if ( stripos ( $arg , "." ) !== 0) {
            $arg = '../' . $arg ;
        }
        //$file = $this->tpl->me->realTpl($arg . ".htm");
        $file = $arg . ".htm" ;
        if ( file_exists ( $file )) {
            $this ->string = str_replace ( $search , file_get_contents ( $file ), $this ->string);
            return ;
        } else {
            if ( stripos ( $file , "$" ) !== false) {
                $this ->string = str_replace ( $search , '<? include $this->tpl->display("' . $arg . '"); ?>' , $this ->string);
                return ;
            }
            if ( stripos ( $arg , '|' ) !== false) {
                list( $func , $tmp ) = explode ( "|" , trim( $arg ));
                $kw = explode ( ', ' , $tmp );
            } else {
                $func = trim( $arg );
                $kw = array ();
            }
            if (function_exists( $func )) {
                $tpl_str = call_user_func_array( $func , $kw );
                $this ->string = str_replace ( $search , $tpl_str , $this ->string);
                return ;
            } else {
                $this ->string = str_replace ( $search , $arg , $this ->string);
                return ;
            }
            system_error( $this ->tpldir . trim( $arg ) . ".htm不存在" );
        }
    }

    function mytest(){
        return $this ->string;
    }


    function _baseParse( $s ) {
        if ( strpos ( $s , "{loadCss" ) !== false) {
            $s = $this ->_loadCss( $s );
        }
        if ( strpos ( $s , "{loadJs" ) !== false) {
            $s = $this ->_loadJs( $s );
        }
        return $s ;
    }

    function fileMd5( $f ) {
        if ( stripos ( $f , "http://" ) !== false) {
            return md5( $f );
        }
        return md5_file(WEB_ROOT . $f );
    }

    function _loadCss( $tpl ) {
        preg_match_all( '/\{loadCss\s+([^\{\}]+)\s*\}/i' , $tpl , $match );
        $cdn = "" ;
        foreach ( $match [1] as $k => $css ) {
            $cssstr = "" ;
            if ( stripos ( $css , ',' ) !== false) {
                $filename = "" ;
                $md5 = "" ;
                $css_content = "" ;
                foreach ( explode ( ',' , $css ) as $css ) {
                    $filename .= basename ( $css , '.css' ) . ',' ;
                    $md5 = self::fileMd5( $css );
                    $css_content .= file_get_contents (WEB_ROOT . $css );
                }
                $md5 = md5( $md5 );
                $filename = dirname( $css ) . '/' . trim( $filename , ',' ) . '.css' ;
                self::parseCss( $css_content , $filename );
                $cssstr = "<link rel=\"stylesheet\" href=\"{$cdn}{$filename}?v={$md5}\">" ;
            } else {
                $md5 = self::fileMd5( $css );
                if ( stripos ( $css , ".min." ) == false) {
                    $css = self::parseCss( file_get_contents (WEB_ROOT . $css ), dirname( $css ) . '/' . basename ( $css , '.css' ) . '.min.css' );
                }
                $cssstr .= "<link rel=\"stylesheet\" href=\"{$cdn}{$css}?v={$md5}\">" ;
            }
            $tpl = str_replace ( $match [0][ $k ], $cssstr , $tpl );
        }
        return $tpl ;
    }


    function _loadJs( $tpl ) {

        preg_match_all( '/\{loadJs\s+([^\{\}]+?)\s*\}/i' , $tpl , $match );
        //var_dump($match);die;
        include "jsmin.class.php" ;
        foreach ( $match [1] as $k => $js ) {
            $jsstr = "" ;
            $cdn = "" ;
            if ( stripos ( $js , ',' ) !== false) {
                $filename = "" ;
                $md5 = "" ;
                $js_content = "" ;
                foreach ( explode ( ',' , $js ) as $j ) {
                    $filename .= basename ( $j , '.js' ) . ',' ;
                    $md5 .= self::fileMd5( $j );
                    if ( stripos ( $j , '.min.' ) === false) {
                        $js_content .= JSMin::minify( file_get_contents (WEB_ROOT . $j ));
                    } else {
                        $js_content .= file_get_contents (WEB_ROOT . $j );
                    }
                    $js_content .= ';' ;
                }
                $md5 = md5( $md5 );

                $filename = dirname( $js ) . '/' .trim( $filename , ',' ) . '.js' ;
                self::parseJs( $js_content , $filename );
                $jsstr = "<script src=\"{$cdn}{$filename}?v={$md5}\"></script>" ;
            } else {
                $md5 = self::fileMd5( $js );
                if ( stripos ( $js , ".min." ) === false) {
                    $js = self::pareJs(JSMin::minify( file_get_contents (WEB_ROOT . $js )), dirname( $js ). '/' . basename ( $js , '.js' ) . '.min.js' );
                }
//                $jsstr = "<script src=\"{$cdn}{$js}?v={$mdt}\"></script>" ;
            }
            $tpl = str_replace ( $match [0][ $k ], $jsstr , $tpl );
        }
        return $tpl ;
    }

    static function parseCss( $css_content , $filenme ) {

        $css_content = preg_replace( "/[\r\n\t]/" , '' , $css_content );
        $css_content = preg_replace( "/ +/" , ' ' , $css_content );
        // echo WEB_ROOT . $filenme;

        sp_file_put_contents(WEB_ROOT . $filenme , $css_content );

        return $filenme ;
    }

    static function parseJs( $js , $filenme ) {

        sp_file_put_contents(WEB_ROOT . $filenme , $js );

        return $filenme ;

    }

    function _loop( $search , $tag , $arg ) {
        list( $attr , $arg ) = $this ->parseAttr( $arg );
        $d = preg_split( "/\s+/" , trim( $arg ));
        if ( count ( $d ) == 3) {
            $data = $d [0];
            $k = $d [1];
            $v = $d [2];
            $s = "<? \n if(!empty($data)) {\n \t foreach(" . $data . " as {$k} => {$v}){" ;
        } elseif ( count ( $d ) == 2) {
            $data = $d [0];
            $v = $d [1];
//            $s = "<? \n if(!empty($data)){\n \t foreach(" . $datsa . " as {$v}) {" ;
        }

        if (isset( $attr [ 'counter' ])) {
            $s = "\n\t\t <? if (!isset({$attr['counter']})) { {$attr['counter']} = 0;} ?> \n \t\t" . $s . "\n \t\t{$attr['counter']}++; \n ?>" ;
        } else {
            $s .= "?>" ;
        }
        $this ->string = str_replace ( $search , $s , $this ->string);
        $this ->string = str_replace ( "{/loop}" , "<? \t}\n}?>" , $this ->string);
    }
    function parseAttr( $s ) {
        $reg = '/([a-zA-Z0-9_])+\s*=\s*([a-zA-Z0-9_\$]+)/i' ;
        $arg = preg_replace( $reg , '' , $s );
        preg_match_all( $reg , $s , $d );
        $arr = array ();
        foreach ( $d [1] as $key => $value ) {
            $arr [trim( $value )] = trim( $d [2][ $key ]);
        }
        return array ( $arr , $arg );
    }
    function _if ( $search , $tag , $arg ) {
        $replace [0] = "<? if($arg){?>" ;
        $replace [1] = "<? }?>" ;
        $this ->string = str_replace ( array ( $search , "{/$tag}" ), $replace , $this ->string);
    }
    function _else( $search , $tag , $arg ) {
        $this ->string = str_replace ( "{else}" , "\n" . '<? } else {?>' , $this ->string);
    }
    function _elseif( $search , $tag , $arg ) {
        $this ->string = str_replace ( $search , "<? }elseif($arg){?>" , $this ->string);
    }

    function _for( $search , $tag , $arg ) {
        $s = trim(trim(preg_replace( '/\s+/' , ' ; ' , $arg )), ';' );
        $this ->string = str_replace ( $search , "<? for($s){?>" , $this ->string);
        $this ->string = str_replace ( "{/for}" , "<? \t\n}?>" , $this ->string);
    }
    function _while( $search , $tag , $arg ) {
        $this ->string = str_replace ( $search , "<? while($arg){ ?>" , $this ->string);
        $this ->string = str_replace ( "{/while}" , "<? \t\n} ?>" , $this ->string);
    }
    function _end() {
        //{$val}标签解析
        $this ->string = preg_replace( '/\\{(\\$\\w+.*)\\}/is' , "<?=\\\\1;?>" , $this ->string);
        //{:$val()}标签解析
        $this ->string = preg_replace( '/\\{\\:\\s*(\\$?\\w+.*?)\\}/is' , "<? =\\\\1;?>" , $this ->string);
        //将$val[arg]解析成$val['arg']
        $this ->string = preg_replace( '/\\$([_a-z]+\\w*)\\[([_a-z]+\\w*)\\]/is' , "$\\\\1['\\\\2']" , $this ->string);
        //支持点号访问数组。如array['key']可以用array.key访问
        $this ->string = preg_replace( '/\\$([_a-z]+\\w*)\\.(\\$[_a-z]+\\w*)/is' , "$\\\\1[\\\\2]" , $this ->string);
        $this ->string = preg_replace( '/\\$([_a-z]+\\w*)\\.([_a-z]+\\w*)/is' , "$\\\\1['\\\\2']" , $this ->string);
        $this ->sring = preg_replace( array ( "/<\?/" , "/<\?php\s*=/" ), array ( "<?php " , "<?php echo " ), $this ->string);
    }
    function result() {
        $this ->_end();
        $this ->string = $this ->_baseParse( $this ->string);
        return str_replace ( array ( "\\HKH1" , "\\HKH2" ), array ( "\\{" , "\\}" ), $this ->string);
    }
}
$data = [ 'aa' , 'bb' , 'cc' ];
$bb = 'aa' ;
$con = 11;
$tag = new _HtmlTag( './index' , '' );
$str = file_get_contents ( 'base.htm' );
$tag ->render( $str );
$html = $tag ->result();
var_dump( $html );
echo '</br>----------------------------</br>' ;
sp_file_put_contents( "./index.html" , $html );
include "index.html" ;