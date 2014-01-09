<?php

namespace Samye\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SamyeUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
