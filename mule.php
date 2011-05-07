<?php
/*
 * Mule CMS v0.1
 * The PHP engine for small sites
 * http://flexbyte.com/mule-cms/
 *
 * (c) 2011 Flexbyte Software, released under BSD license
 */

class Mule
{
	protected $title;
	protected $keywords;
	protected $description;

	public function __construct()
	{
	}

	protected function render($file, $vars = null)
	{
		if (isset($vars))
			extract($vars);
		ob_start();
		include_once $file;
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	public function run($config)
	{
		// extract page name
		$page = $_SERVER['REQUEST_URI'];
		$page = ltrim($page, '/');
		$page = rtrim($page, '/');
		
		if (strlen($page) == 0)
			$page = 'index';
		
		// find path to page
		$path = $config['dir.content'];
		$template = $path.$page.'.php';
		if (!file_exists($template))
		{
			header('HTTP/1.1 404 Not Found');
			$template = $path.'404.php';
		}

		// get page content
		$content = $this->render($template);
		
		// render page in layout
		$path = $config['dir.layout'];
		echo $this->render($path.'layout.php', 
			array('content'=>$content));
	}
}
