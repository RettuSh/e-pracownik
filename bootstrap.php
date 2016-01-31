<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'config.php';


use Assetic\AssetWriter;
use Assetic\Extension\Twig\TwigFormulaLoader;
use Assetic\Extension\Twig\TwigResource;
use Assetic\Factory\LazyAssetManager;
use Assetic\Factory\AssetFactory;
use Assetic\AssetManager;
use Assetic\FilterManager;
use Assetic\Extension\Twig\AsseticExtension;
use Symfony\Component\Finder\Finder;
use Assetic\Filter\LessFilter;
use Assetic\Filter\LessphpFilter;

$loader = new Twig_Loader_Filesystem('assets/views/');
$options = array(
    'cache' => false,
    'debug' => true
);

$twig = new Twig_Environment($loader, $options);

$assetManager = new AssetManager();
$filterManager = new FilterManager();
//$filterManager->set('less', new LessFilter('/opt/local/bin/node'));
$filterManager->set('less', new LessphpFilter());
//asset factory
$assetFactory = new AssetFactory('assets/');
$assetFactory->setDebug(false);
$assetFactory->setAssetManager($assetManager);
$assetFactory->setFilterManager($filterManager);

$twig->addExtension(new AsseticExtension($assetFactory));

$lazyAssetManager = new LazyAssetManager($assetFactory);
$lazyAssetManager->setLoader('twig', new TwigFormulaLoader($twig));

$finder = new Finder();
$finder
    ->files()
    ->in('assets')
    ->exclude('css')
    ->exclude('js')
    ->exclude('images')
    ->name("*.twig");


foreach ($finder as $template) {
    $resource = new TwigResource($loader, $template->getFileName());
    $lazyAssetManager->addResource($resource, 'twig');
}

$writer = new AssetWriter('.');
$writer->writeManagerAssets($lazyAssetManager);