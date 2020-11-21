<?php namespace PlanetaDelEste\ApiMartinForms\Models;

use Model;

/**
 * Class Setting
 *
 * @package PlanetaDelEste\ApiMartinForms\Models
 * @mixin \System\Behaviors\SettingsModel
 *
 * @method static mixed|null get(string $key, $default = null)
 * @method static mixed|null set(string|array $key, $value = null)
 */
class Setting extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'planetadeleste_apimartinforms';
    public $settingsFields = 'fields.yaml';

    public function initSettingsData(): array
    {
        return [
            'groups' => [
                'group'           => 'default',
                'mail_enabled'    => '1',
                'mail_recipients' => 'demo@octobercms.com',
                'mail_template'   => '',
                'allowed_fields'  => 'name,email,message'
            ]
        ];
    }

    public static function defaults()
    {
        return (new static())->initSettingsData();
    }

    /**
     * @param null $sGroup
     *
     * @return mixed|null
     */
    public static function group($sGroup = null)
    {
        if (!$sGroup) {
            $sGroup = 'default';
        }

        return array_get(static::getGrouped(), $sGroup);
    }

    /**
     * @return array
     */
    public static function getGrouped(): array
    {
        return collect(static::get('groups', []))
            ->transform(function ($arGroup) {
                $sRecipients = array_get($arGroup, 'mail_recipients');
                array_set($arGroup, 'mail_recipients', explode(',', $sRecipients));
                return $arGroup;
            })
            ->keyBy('group')
            ->all();
    }
}
