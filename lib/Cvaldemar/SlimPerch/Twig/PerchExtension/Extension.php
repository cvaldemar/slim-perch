<?php

namespace Cvaldemar\SlimPerch\Twig\PerchExtension;

class Extension extends \Twig_Extension
{
	public function getFunctions()
	{
		return array(
			'perch_content'  => new \Twig_Function_Method($this, 'content'),
			'perch_location' => new \Twig_Function_Method($this, 'location'),
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

	public function getName()
	{
		return 'perch';
	}
}
