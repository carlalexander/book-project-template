<?php

/*
 * This file is part of the markdown book project template.
 *
 * (c) Carl Alexander <contact@carlalexander.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

/**
 * Command for building the book for mobile formats.
 *
 * @author Carl Alexander <contact@carlalexander.ca>
 */
class BuildMobileCommand extends Command
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct('book:build-mobile');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = 'pandoc -f markdown+smart'
                 . ' -o book-title.epub'
//                 . ' --epub-cover-image=assets/images/cover.jpg'
//                 . ' --epub-embed-font=/System/Library/Fonts/Avenir.ttc'
//                 . ' --epub-embed-font=/System/Library/Fonts/Menlo.ttc'
                 . ' --css=assets/css/epub.css'
                 . ' -M author="[Author]"'
                 . ' -M title="[Book Title]"';

        $files = Finder::create()->files()->in('content')->name('*.md')->sortByName();

        foreach ($files as $file) {
            $command .= ' '.$file->getPathName();
        }

        $process = new Process($command);
        $process->run();
    }
}
