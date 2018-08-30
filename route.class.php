<?php
	class Route {
	
    private $path;
    private $callback;
    private $matches = [];
    private $params =  [];
    
    public function __construct( $path, $callback ){
    	$this->path = trim( $path, '/' );
        $this->callback = $callback;
    }

    public function match($url){
    
    	$url = trim($url, '/');
    	/* http://php.net/manual/fr/function.preg-replace.php */
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        
        /* http://php.net/manual/fr/function.preg-match.php */
        if( !preg_match($regex, $url, $matches ) ) {
            return false;
        }

        /* http://php.net/manual/fr/function.array-shift.php */
        array_shift($matches);
        $this->matches = $matches;
        
        return true;
    }

    public function call(){
    
    	/* http://php.net/manual/fr/function.call-user-func-array.php */
    	return call_user_func_array($this->callback, $this->matches);
    }
}
?>