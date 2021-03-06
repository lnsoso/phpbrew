<?php
namespace PhpBrew\Command;
use PhpBrew\Config;
use PhpBrew\VariantParser;

class ListCommand extends \CLIFramework\Command
{
    public function brief() { return 'list installed PHP versions'; }

    public function execute()
    {
        $versions = \PhpBrew\Config::getInstalledPhpVersions();

        // var_dump( $versions ); 
        echo "Installed versions:\n";
        foreach( $versions as $version ) {
            $versionPrefix = Config::getVersionBuildPrefix($version);

            printf('  %-15s  (%-10s)', $version, $versionPrefix);

            if( file_exists($versionPrefix . DIRECTORY_SEPARATOR . 'phpbrew.variants') ) {
                $info = unserialize(file_get_contents( $versionPrefix . DIRECTORY_SEPARATOR . 'phpbrew.variants'));

                echo "\n";
                echo str_repeat(' ',19);
                echo VariantParser::revealCommandArguments($info);
            }

            echo "\n";
        }
    }
}


