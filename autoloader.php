<?php
/*
  This autoloader is very useful, it allows us to use namespaces in the project
  and we don't have to cluter the codebase with the 'require' keyword in every
  file and everywhere.
*/

function fqcnToPath(string $fqcn): array|string
{
  return str_replace('\\', '/', $fqcn) . '.php';
}

spl_autoload_register(function (string $class) {
  $path = fqcnToPath($class);

  require PROJECT_ROOT_PATH . '/src/' . $path;
});
