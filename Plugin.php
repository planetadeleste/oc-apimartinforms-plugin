<?php namespace PlanetaDelEste\ApiMartinForms;

use PlanetaDelEste\ApiMartinForms\Models\Setting;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

/**
 * Class Plugin
 *
 * @package PlanetaDelEste\ApiMartinForms
 */
class Plugin extends PluginBase
{
    public $require = ['Martin.Forms'];

    public function registerSettings(): array
    {
        return [
            'config' => [
                'label'       => 'planetadeleste.apimartinforms::lang.menu.main',
                'description' => 'planetadeleste.apimartinforms::lang.menu.settings',
                'category'    => SettingsManager::CATEGORY_CMS,
                'icon'        => 'icon-cog',
                'class'       => Setting::class,
                'permissions' => ['apimartinforms-menu-settings'],
                'order'       => 500
            ]
        ];
    }
}
