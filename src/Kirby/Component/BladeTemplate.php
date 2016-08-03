<?php 

namespace Jevets\Kirby\Component;

use \tpl;
use \Page;
use \Kirby;
use \Kirby\Component\Template as KirbyTemplate;
use Philo\Blade\Blade;

class BladeTemplate extends KirbyTemplate
{
    protected $blade;

    public function __construct(Kirby $kirby)
    {
        parent::__construct($kirby);

        if (! $this->blade) {
            $this->blade = new Blade(
                $this->kirby->roots()->site() . DS . '..' . DS . 'resources' . DS . 'views',
                $this->kirby->roots()->cache()
            );

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
        return $this->kirby->roots()->site() . DS . '..' . DS . 'resources' . DS . 'views' . DS . str_replace('/', DS, $name) . '.blade.php';
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
            $this->data($template, $data), 
            $data
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