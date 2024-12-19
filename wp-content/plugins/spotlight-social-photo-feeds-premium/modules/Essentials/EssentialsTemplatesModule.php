<?php

namespace RebelCode\Spotlight\Instagram\Modules\Essentials;

use Dhii\Services\Extension;
use Dhii\Services\Factories\StringService;
use Dhii\Services\Factory;
use RebelCode\Spotlight\Instagram\Module;

class EssentialsTemplatesModule extends Module
{
    /** @inheritDoc */
    public function getFactories(): array
    {
        return [
            // The JSON file
            'file' => new StringService("{0}/data/templates-pro.json", ['@plugin/dir']),

            // The data parsed from the JSON file
            'data' => new Factory(['file'], function ($file) {
                if (!is_readable($file)) {
                    return [];
                }

                $json = @file_get_contents($file);
                $data = @json_decode($json ? : '{}', true);

                return is_array($data) ? $data : [];
            }),
        ];
    }

    /** @inheritDoc */
    public function getExtensions(): array
    {
        return [
            'templates/data' => new Extension(['data'], function ($templates, $proDesigns) {
                foreach ($proDesigns as $templateId => $design) {
                    foreach ($templates as $template) {
                        if ($template->id === $templateId) {
                            $template->design = $design;
                            break;
                        }
                    }
                }

                return $templates;
            }),
        ];
    }
}
