<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'config.php';


use Assetic\AssetManager;
use Assetic\AssetWriter;
use Assetic\Extension\Twig\AsseticExtension;
use Assetic\Extension\Twig\TwigFormulaLoader;
use Assetic\Extension\Twig\TwigResource;
use Assetic\Factory\AssetFactory;
use Assetic\Factory\LazyAssetManager;
use Assetic\Filter\LessFilter;
use Assetic\FilterManager;
use Symfony\Component\Finder\Finder;

$loader = new Twig_Loader_Filesystem(VIEWS_PATH);

$options = [
    'cache' => DEBUG_APP ? false : 'cache'
];

$twig = new Twig_Environment($loader, $options);

$assetManager = new AssetManager();
$filterManager = new FilterManager();
$filterManager->set('less', new LessFilter(NODE_PATH, [NODE_MODULE_PATH]));

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