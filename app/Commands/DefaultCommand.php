<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class DefaultCommand extends Command
{
    /**
     * The name of the command.
     *
     * @var string
     */
    protected $name = 'default';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Fixes the project\'s coding style';

    /**
     * The configuration of the command.
     *
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setDefinition(
                [
                    new InputArgument('path', InputArgument::OPTIONAL, 'The project\'s path.', (string) getcwd()),
                    new InputOption('preset', '', InputOption::VALUE_REQUIRED, 'The preset that should be used'),
                    new InputOption('test', '', InputOption::VALUE_NONE, 'If the project\'s coding style should be tested instead.'),
                ]
            );
    }

    /**
     * Execute the console command.
     *
     * @param  \App\Actions\FixCode  $fixCode
     * @param  \App\Actions\ElaborateSummary  $elaborateSummary
     * @return int
     */
    public function handle($fixCode, $elaborateSummary)
    {
        [$totalFiles, $changes] = $fixCode->execute();

        return $elaborateSummary->execute($totalFiles, $changes);
    }
}
