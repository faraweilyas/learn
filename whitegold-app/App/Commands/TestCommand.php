<?php

namespace App\Commands;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class TestCommand extends Command
{
	protected static $defaultName = 'app:test';
	// protected static $defaultName = 'cache:clear';
	// protected static $defaultName = 'cache:container';

	public function __construct(bool $requirePassword = false)
    {
        $this->requirePassword = $requirePassword;

        parent::__construct();
    }

	protected function configure()
	{
		$this
			// ->setHidden(true)
			->addArgument('username', InputArgument::OPTIONAL, 'The username of the user.')
            ->addArgument('password', $this->requirePassword ? InputArgument::REQUIRED : InputArgument::OPTIONAL, 'The password of the user.')
            ->addOption('amount', 'a', InputOption::VALUE_REQUIRED, 'How many users do you want to create?', 1)
            ->addOption('root', 'r', InputOption::VALUE_NONE, 'Root user?')
	        ->setDescription('Creates a new user.')
	        ->setHelp('This command allows you to create a new user...');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln([
            '<info>Lorem Ipsum Dolor Sit Amet</>',
            '<info>==========================</>',
            '',
        ]);

        $io = new SymfonyStyle($input, $output);
        $io->title('Lorem Ipsum Dolor Sit Amet');
        $io->section('Adding a User');
		$io->section('Generating the Password');
		$io->text('Lorem ipsum dolor sit amet');
		$io->text([
		    'Lorem ipsum dolor sit amet',
		    'Consectetur adipiscing elit',
		    'Aenean sit amet arcu vitae sem faucibus porta',
		]);
		$io->listing([
		    'Element #1 Lorem ipsum dolor sit amet',
		    'Element #2 Lorem ipsum dolor sit amet',
		    'Element #3 Lorem ipsum dolor sit amet',
		]);
		$io->table(
		    ['Header 1', 'Header 2'],
		    [
		        ['Cell 1-1', 'Cell 1-2'],
		        ['Cell 2-1', 'Cell 2-2'],
		        ['Cell 3-1', 'Cell 3-2'],
		    ]
		);
		$io->horizontalTable(
		    ['Header 1', 'Header 2'],
		    [
		        ['Cell 1-1', 'Cell 1-2'],
		        ['Cell 2-1', 'Cell 2-2'],
		        ['Cell 3-1', 'Cell 3-2'],
		    ]
		);
		$io->definitionList(
		    'This is a title',
		    ['foo1' => 'bar1'],
		    ['foo2' => 'bar2'],
		    ['foo3' => 'bar3'],
		    new TableSeparator(),
		    'This is another title',
		    ['foo4' => 'bar4']
		);
		// $io->newLine();
		// $io->newLine(3);
		// $io->note('Lorem ipsum dolor sit amet');
		// $io->note([
		//     'Lorem ipsum dolor sit amet',
		//     'Consectetur adipiscing elit',
		//     'Aenean sit amet arcu vitae sem faucibus porta',
		// ]);
		// $io->caution('Lorem ipsum dolor sit amet');
		// $io->caution([
		//     'Lorem ipsum dolor sit amet',
		//     'Consectetur adipiscing elit',
		//     'Aenean sit amet arcu vitae sem faucibus porta',
		// ]);

		$io->progressStart();
		$io->progressStart(100);
		$io->progressAdvance();
		$io->progressAdvance(10);
		$io->progressFinish();

		// $io->ask('What is your name?');
		// $io->ask('Where are you from?', 'United States');
		// $io->ask('Number of workers to start', 1, function ($number) {
		//     if (!is_numeric($number)) {
		//         throw new \RuntimeException('You must type a number.');
		//     }

		//     return (int) $number;
		// });
		// $password = $io->askHidden('What is your password?');
		// $io->success($password);
		// $password = $io->askHidden('What is your password?', function ($password) {
		//     if (empty($password)) {
		//         throw new \RuntimeException('Password cannot be empty.');
		//     }

		//     return $password;
		// });
		// $io->success($password);

		// $io->confirm('Restart the web server?');
		// $io->confirm('Restart the web server?', true);
		// $io->choice('Select the queue to analyze', ['queue1', 'queue2', 'queue3']);
		// $io->choice('Select the queue to analyze', ['queue1', 'queue2', 'queue3'], 'queue1');

		// $io->success('Lorem ipsum dolor sit amet');
		// $io->success([
		//     'Lorem ipsum dolor sit amet',
		//     'Consectetur adipiscing elit',
		// ]);
		// $io->warning('Lorem ipsum dolor sit amet');
		// $io->warning([
		//     'Lorem ipsum dolor sit amet',
		//     'Consectetur adipiscing elit',
		// ]);
		// $io->error('Lorem ipsum dolor sit amet');
		// $io->error([
		//     'Lorem ipsum dolor sit amet',
		//     'Consectetur adipiscing elit',
		// ]);

	    $output->writeln([
	        'User Creator',
	        '============',
	        '',
	    ]);

	    for ($i = 0; $i < $input->getOption('amount'); $i++)
	    {
		    $output->writeln([
		        'You are about to create a user with the following credentials.',
		        '',
		        'Username: '.$input->getArgument('username'),
		        'Password: '.$input->getArgument('password'),
		        'Root: '.($input->getOption('root') ? 'Yes' : 'No'),
		        '',
		        'User was successfully created Whoa!',
		        '',
		    ]);
		}

		// creates a new progress bar (50 units)
		$progressBar = new ProgressBar($output, 50);

		// starts and displays the progress bar
		$progressBar->start();

		$i = 0;
		while ($i++ < 100) {
		    // ... do some work

		    // advances the progress bar 1 unit
		    $progressBar->advance();

		    // you can also advance the progress bar by more than 1 unit
		    // $progressBar->advance(3);
		}

		// ensures that the progress bar is at 100%
		$progressBar->finish();
	    $output->writeln('');

		$table = new Table($output);
        $table
            ->setHeaders(['ISBN', 'Title', 'Author'])
            ->setRows([
                ['99921-58-10-7', 'Divine Comedy', 'Dante Alighieri'],
                ['9971-5-0210-0', 'A Tale of Two Cities', 'Charles Dickens'],
                ['960-425-059-0', 'The Lord of the Rings', 'J. R. R. Tolkien'],
                ['80-902734-1-6', 'And Then There Were None', 'Agatha Christie'],
            ]);
        $table->render();

		// $table = new Table($output);
		$table->setHeaderTitle('Books');
		$table->setFooterTitle('Page 1/2');
        $table
            ->setHeaders(['ISBN', 'Title', 'Author'])
	        ->setRows([
			    ['99921-58-10-7', 'Divine Comedy', 'Dante Alighieri'],
			    ['9971-5-0210-0', 'A Tale of Two Cities', 'Charles Dickens'],
			    new TableSeparator(),
			    ['960-425-059-0', 'The Lord of the Rings', 'J. R. R. Tolkien'],
			    ['80-902734-1-6', 'And Then There Were None', 'Agatha Christie'],
			]);
        $table->render();

	    // green text
		// $output->writeln('<info>foo</info>');

		// yellow text
		// $output->writeln('<comment>foo</comment>');

		// black text on a cyan background
		// $output->writeln('<question>foo</question>');

		// white text on a red background
		// $output->writeln('<error>foo</error>');

		// $outputStyle = new OutputFormatterStyle('red', 'yellow', ['bold', 'blink']);
		// $output->getFormatter()->setStyle('fire', $outputStyle);

		// $output->writeln('<fire>foo</>');

		// green text
		// $output->writeln('<fg=green>foo</>');

		// black text on a cyan background
		// $output->writeln('<fg=black;bg=cyan>foo</>');

		// bold text on a yellow background
		// $output->writeln('<bg=yellow;options=bold>foo</>');

		// $output->writeln('<href=https://symfony.com>Symfony Homepage</>');
		// bold text with underscore
		// $output->writeln('<options=bold,underscore>foo</>');

		// $section1 = $output->section();
		// $section2 = $output->section();
		// $section1->writeln('Hello');
		// $section2->writeln('World!');
		// $section1->overwrite('Goodbye');
		// $section2->clear();
		// $section1->clear(2);
		
		// $command 	= $this->getApplication()->find('demo:greet');
		// $arguments 	= [
		// 	'command' => 'demo:greet',
		// 	'name'    => 'Fabien',
		// 	'--yell'  => true,
		// ];
		// $commandInput 	= new ArrayInput($arguments);
		// $returnCode 	= $command->run($commandInput, $output);
	    // or without output to run quietly
	    // $returnCode 	= $command->run($commandInput);

        return 0;
	}
}
