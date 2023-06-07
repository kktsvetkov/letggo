<?php /**
* Autoloader, if used withour composer
*/
function Letggo_autoload($class)
{
	$chunks = explode('\\', $class);
        if ('Letggo' !== $chunks[0])
	{
                return;
        }

	array_shift($chunks);
	$phpFile = __DIR__ . '/src/' . join('/', $chunks) . '.php';
	if (is_file($phpFile))
	{
		include $phpFile;
	}
}

spl_autoload_register('Letggo_autoload');
