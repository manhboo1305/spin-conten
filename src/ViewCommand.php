<?php

namespace  ManhND\TextSpinner;
use InvalidArgumentException;

use Illuminate\Console\Command;

class ViewCommand extends Command{
    protected $signature = 'spin:view';
    protected $views = [
        'group-of-word.stub' => 'spin/group-of-word.blade.php',
        'spin.stub' => 'spin/spin.blade.php',
    ];
    public function handle()
    {
        $this->ensureDirectoriesExist();
        $this->exportViews();
        $this->info('Spin scaffolding generated successfully.');
    }
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            if (file_exists($view = $this->getViewPath($value))) {
                if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }
            $dir = __DIR__.'/Views/'.$key;
            copy($dir, $view);
        }
    }
    protected function ensureDirectoriesExist()
    {
        if (! is_dir($directory = $this->getViewPath('spin'))) {
            mkdir($directory, 0755, true);
        }
    }
    protected function getViewPath($path)
    {
        return implode(DIRECTORY_SEPARATOR, [
            config('view.paths')[0] ?? resource_path('views'), $path,
        ]);
    }
}
