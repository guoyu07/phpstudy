<?php
/*
 * Author : arch 
 * Email : yajin160305@gmail.com
 * File : CompileClass.php
 * CreateDate : 2016-12-05 15:52:13
 * */

class CompileClass {
    private $template;
    private $content;
    private $comfile;    
    private $left = '{';
    private $right = '}';
    private $value = array();
    private $phpTurn;
    private $T_P = array();
    private $T_R = array();

    public function __construct($template, $compileFile, $config)
    {
        $this->template = $template;
        $this->compile = $compileFile;
        $this->content = file_get_contents($template);
        if($config['php_turn'] === false) {
            $this->T_P [] = "#<\? (=|php|)(.+?)>#is";
            $this->T_R[] = "&lt;? \\1\\2? &gt;";
        }
        $this->T_P[] = "#\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}#";
        $this->T_R[] = "<?php echo \$this->value['\\1']; ?>";

        $this->T_P[] = "#\{(loop|foreach) \\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)}#i";
        $this->T_R[] = "<?php foreach ((array)\$this->value['\\2'] as \$K => \$V) {?>";

        $this->T_P[] = "#{\/(loop|foreach|if)}#i";
        $this->T_R[] = "<?php }?>";

        $this->T_P[] = "#\{([K|V])\}#";
        $this->T_R[] = "<?php echo \$\\1; ?>";

        $this->T_P[] = "#\{if (.*?)\}#";
        $this->T_R[] = "<?php if (\\1){?>";

        $this->T_P[] = "#\{(else if|elseif) (.*?)\}#";
        $this->T_R[] = "<?php }else if(\\2){?>";

        $this->T_P[] = "#\{else\}#";
        $this->T_R[] = "<?php }else{?>";

        $this->T_P[] = "#\{(\#|\*)(.*?)(\#|\*)\}#";
        $this->T_R[] = "";
    }

    public function compile()
    {
        $this->c_var2();
        $this->c_staticFile();
        file_put_contents($this->compile, $this->content);
    }

    public function c_var2()
    {
        $this->content = preg_replace($this->T_P, $this->T_R, $this->content);
    }

    public function c_staticFile()
    {
        $this->content = preg_replace('#\{\!(.*?)\!\}#', '<script src=\\1>' . '?t=' . time() . '></script>', $this->content);
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
/* vim: set tabstop=4 set shiftwidth=4 */

