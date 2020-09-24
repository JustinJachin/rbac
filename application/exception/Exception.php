<?php
namespace app\exception;

use think\exception\Handle;
use Exception as Exceptionthink;
/**
 * 
 */
class Exception extends Handle
{
	
	public function render(Exceptionthink $e)
	{
		return \redirect('admin/error/geterror');
	}
}