<?php
namespace Yamiko\CacheAdministrationBundle;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class CacheManager
 * @package Yamiko\CacheAdministrationBundle
 */
class CacheManager
{
    /** @var Filesystem */
    private $filesystm;

    /** @var string path to cache directory */
    private $cacheDir;

    /**
     * @param string $cacheDir path to application root directory
     */
    public function __construct($cacheDir)
    {
        if (!is_dir($cacheDir)) {
            throw new FileNotFoundException(null, 0, null, $cacheDir);
        }
        $this->cacheDir = $cacheDir;
        $this->filesystm = new Filesystem();
    }

    /**
     * Clear annotations cache
     */
    public function clearAnnotations()
    {
        $this->filesystm->remove($this->cacheDir.'/annotations');
    }

    /**
     * clear assetic cache
     */
    public function clearAssetic()
    {
        $this->filesystm->remove($this->cacheDir.'/assetic');
    }

    /**
     * clear doctrine cache
     */
    public function clearDoctrine()
    {
        $this->filesystm->remove($this->cacheDir.'/doctrine');
    }

    /**
     * clear translations cache
     */
    public function clearTranslations()
    {
        $this->filesystm->remove($this->cacheDir.'/translations');
    }

    /**
     * clear profiles cache
     */
    public function clearProfiles()
    {
        $this->filesystm->remove($this->cacheDir.'/profiler');
    }

    /**
     * clear container cache
     */
    public function clearContainer()
    {
        $finder = new Finder();
        $finder->name('*ProjectContainer*');
        $this->filesystm->remove($finder->in($this->cacheDir.DIRECTORY_SEPARATOR));
    }

    /**
     * clear routing cache
     */
    public function clearRouting()
    {
        $finder = new Finder();
        $finder->name('*UrlGenerator*');
        $this->filesystm->remove($finder->in($this->cacheDir.'/'));
        $finder->name('*UrlMatcher*');
        $this->filesystm->remove($finder->in($this->cacheDir.'/'));
    }

    /**
     * clear classes cache
     */
    public function clearClasses()
    {
        $finder = new Finder();
        $finder->name('classes*');
        $this->filesystm->remove($finder->in($this->cacheDir.'/'));
    }

    /**
     * clear templates cache
     */
    public function clearTemplates()
    {
        $this->filesystm->remove($this->cacheDir.'/twig');
        $finder = new Finder();
        $finder->name('templates*');
        $this->filesystm->remove($finder->in($this->cacheDir.'/'));
    }

    /**
     * clear all caches
     */
    public function clearAll()
    {
        $this->clearAnnotations();
        $this->clearAssetic();
        $this->clearContainer();
        $this->clearClasses();
        $this->clearDoctrine();
        $this->clearRouting();
        $this->clearTemplates();
    }
}
