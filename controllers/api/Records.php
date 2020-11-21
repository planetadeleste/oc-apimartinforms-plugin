<?php namespace PlanetaDelEste\ApiMartinForms\Controllers\Api;

use Exception;
use Kharanenka\Helper\Result;
use Martin\Forms\Components\EmptyForm;
use PlanetaDelEste\ApiMartinForms\Models\Setting;
use PlanetaDelEste\ApiToolbox\Classes\Api\Base;
use Martin\Forms\Models\Record;

/**
 * Class Records
 *
 * @package PlanetaDelEste\ApiMartinForms\Controllers\Api
 *
 * @property Record $obModel
 */
class Records extends Base
{
    public function send()
    {
        try {
            $obComponent = $this->magicFormComponent(array_get($this->data, 'group'));
            $arResponse = $obComponent->onFormSubmit();

            return Result::setTrue()->get();
        } catch (Exception $e) {
            return static::exceptionResult($e);
        }
    }

    public function getModelClass(): string
    {
        return Record::class;
    }

    /**
     * @param null|string|array $sGroup
     *
     * @return \Cms\Classes\ComponentBase|\Martin\Forms\Components\EmptyForm
     * @throws \SystemException
     */
    public function magicFormComponent($sGroup = null)
    {
        if (!is_array($sGroup)) {
            $arSettings = Setting::group($sGroup);
        } else {
            $arSettings = $sGroup;
        }

        $arSettings['redirect'] = '/';

        return $this->component(EmptyForm::class, null, $arSettings);
    }
}
