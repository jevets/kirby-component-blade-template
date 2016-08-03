<?php 

namespace Jevets\Kirby\Component;

use \tpl;
use \Page;
use \Kirby;
use \Kirby\Component\Template as KirbyTemplate;
use Philo\Blade\Blade;

class BladeTemplate extends KirbyTemplate
{
    /**
     * @var string
     */
    const DS = DIRECTORY_SEPARATOR;

    /**
     * Instance of Blade
     *
     * @var Philo\Blade\Blade
     */
    protected $blade;

    /**
     * Path to blade views
     *
     * @var string
     */
    protected $viewsPath;

    /**
     * Path to views cache
     *
     * @var string
     */
    protected $cachePath;

    /**
     * @var Kirby $kirby
     * @var string 'site/blade'
     * @var string 'site/cache'
     */
    public function __construct(Kirby $kirby, $viewsPath = 'site/blade', $cachePath = 'site/cache')
    {
        parent::__construct($kirby);

        if ($viewsPath) {
            $viewsPath = str_replace('/', self::DS, $viewsPath);
        } else {
            $viewsPath = $this->kirby->roots()->site() . self::DS . 'blade';
        }

        if ($cachePath) {
            $cachePath = str_replace('/', self::DS, $cachePath);
        } else {
            $cachePath = $this->kirby->roots()->cache();
        }

        if (! $this->blade) {
            $this->blade = new Blade(
                $this->viewsPath, $this->cachePath
            );

            // Instructs Blade to use the `html()` function
            // instead of the `e()` function, as Kirby 
            // defines its own `e()` function that doesn't
            // do what Blade's `e()` does.
            $this->blade
                ->getCompiler()
                ->setEchoFormat('html(%s)');
        }
    }

    /**
     * Returns a template file path by name
     *
     * @param string $name
     * @return string
     */
    public function file($name)
    {
        return $this->viewsPath . self::DS . str_replace('/', self::DS, $name) . '.blade.php';

        // return $this->kirby->roots()->site() . DS . '..' . DS . 'resources' . DS . 'views' . DS . str_replace('/', DS, $name) . '.blade.php';
    }

    /**
     * Renders the template by page with the additional data
     * 
     * @param Page|string $template
     * @param array $data
     * @param boolean $return
     * @return string
     */
    public function render($template, $data = [], $return = true)
    {
        $data = array_merge(
            $this->data($template, $data), $data
        );

        if ($template instanceof Page) {
            $file = basename($template->templateFile(), '.blade.php');
        } else {
            $file = $template;
        }

        return $this->blade
            ->view()
            ->make($file, $data)
            ->render();
    }
}