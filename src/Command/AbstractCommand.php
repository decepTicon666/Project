<?php

namespace App\Command;

use App\Command\Exception\UnknownFileTemplateException;

abstract class AbstractCommand implements CommandInterface
{
    private const DIR_FILE_TEMPLATES = __DIR__ . '/../../FileTemplates';

    protected function getFileTemplateDirectory(): string
    {
        return self::DIR_FILE_TEMPLATES;
    }

    /**
     * @throws UnknownFileTemplateException
     */
    protected function getTemplateContent(string $templateName): string
    {
        $templatePath = $this->getFileTemplateDirectory() . '/' . $templateName . '.tpl';

        if (!file_exists($templatePath)) {
            throw new UnknownFileTemplateException('there is no file template with name ' . $templateName);
        }

        return file_get_contents($templatePath);
    }
}