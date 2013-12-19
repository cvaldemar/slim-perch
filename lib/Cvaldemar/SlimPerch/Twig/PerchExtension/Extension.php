<?php

namespace Cvaldemar\SlimPerch\Twig\PerchExtension;

class Extension extends \Twig_Extension
{

    protected $blankImgData = 'data:image/gif;base64,R0lGODlhIAAgAOMJAMzMzJaWlre3t5ycnL6+vsXFxaOjo7Gxsaqqqv///////////////////////////yH+EUNyZWF0ZWQgd2l0aCBHSU1QACwAAAAAIAAgAAAEIhDISau9OOvNu/9gKI5kaZ5oqq5s675wLM90bd94ru+8HAEAOw==';

    /**
     * Functions
     * @return array
     */
    public function getFunctions()
	{
		return array(
			'perch_content'  => new \Twig_Function_Method($this, 'content'),
			'perch_location' => new \Twig_Function_Method($this, 'location'),
            'perch_content_create' => new \Twig_Function_Method($this, 'content_create'),
            'perch_content_custom' => new \Twig_Function_Method($this, 'content_custom'),
            'perch_content_search' => new \Twig_Function_Method($this, 'content_search'),
            'perch_pages_navigation' => new \Twig_Function_Method($this, 'pages_navigation'),
            'perch_pages_navigation_text' => new \Twig_Function_Method($this, 'pages_navigation_text'),
            'perch_pages_breadcrumbs' => new \Twig_Function_Method($this, 'pages_breadcrumbs'),
		);
	}

	public function content($region)
	{
		return perch_content($region);
	}

	public function location($set_page)
	{
		\PerchSystem::set_page($set_page);
	}

    public function content_create($key, $opts)
    {
        return perch_content_create($key, $opts);
    }

    public function content_custom($opts, $return)
    {
        return perch_content_custom($opts, $return);
    }

    public function content_search($key, $opts)
    {
        return perch_content_search($key, $opts);
    }

    public function pages_navigation($opts = array())
    {
        return perch_pages_navigation($opts);
    }

    public function pages_navigation_text($opts = false)
    {
        return perch_pages_navigation_text($opts);
    }

    public function pages_breadcrumbs($opts = array())
    {
        return perch_pages_breadcrumbs($opts);
    }

    /**
     * Filters
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('perchsize', array($this, 'perchsize')),
        );
    }

    public function perchsize($path, $width = 200, $height = 100)
    {
        if (!$path)  return $this->blankImgData;

        $p = pathinfo($path);

        $dirname = array_key_exists('dirname', $p) ? $p['dirname'] : '';
        $filename = array_key_exists('filename', $p) ? $p['filename'] : '';
        $extension = array_key_exists('extension', $p) ? $p['extension'] : '';

        return $dirname . '/' . $filename . '-w' . $width . 'h' . $height . '.' . $extension;
    }

	public function getName()
	{
		return 'perch';
	}
}
