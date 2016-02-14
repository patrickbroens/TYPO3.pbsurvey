<?php
$EM_CONF['pbsurvey'] = [
    'title' => 'Survey',
    'description' => 'Take surveys from the visitors of your website. The results can be exported to a csv-file to analyze in Microsoft Excel or the statistical program SPSS or it\'s open source concurrent PSPP.',
    'category' => 'fe',
    'state' => 'stable',
    'author' => 'Patrick Broens',
    'author_email' => 'patrick@patrickbroens.nl',
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-7.6.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ],
    'autoload' => [
        'psr-4' => ['PatrickBroens\\Pbsurvey\\' => 'Classes']
    ]
];