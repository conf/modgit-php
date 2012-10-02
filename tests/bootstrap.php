<?php
namespace Modgit;

require_once __DIR__ . '/../src/Modgit/Autoloader.php';

Autoloader::register();

require_once __DIR__ . '/Modgit/DirectoryHelper.php';

chdir(__DIR__ . '/../');
