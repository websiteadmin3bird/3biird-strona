<?php

namespace Sitecake\Content\DOM\Query\Selector;

use Sitecake\Content\DOM\Query\SelectorInterface;
use Sitecake\Content\DOM\Query\SelectorMatcherAwareTrait;
use Sitecake\Sitecake;

class ResourceImageSelector implements SelectorInterface
{
    use SelectorMatcherAwareTrait;

    /**
     * Name of directory where images are being stored
     * This is used when matching, because each src attribute wil point to image inside this directory.
     *
     * @var string
     */
    protected $imgDirName;

    /**
     * Allowed extensions for uploaded images.
     * When matching, only these extensions will be included in regex
     *
     * @var array
     */
    protected $validExtensions;

    /**
     * ResourceImageSelector constructor.
     */
    public function __construct()
    {
        $this->imgDirName = Sitecake::getConfig('image.directory_name');
        $this->validExtensions = Sitecake::getConfig('image.valid_extensions');
    }

    /**
     * {@inheritdoc}
     */
    public function getMatcher()
    {
        /*return '<(a)[^>]+href=(?:\s|"|\'))([^\s"\',]*' .
            '(?:' . $this->uploadDirName . ')\/[^\s]*\-sc[0-9a-f]{13}[^\.]*\.(?!' .
            implode('|', $this->forbiddenExtensions) .
            ')[A-Za-z0-9]+)' .
            '([^>]+>';*/

        return $this->attributeSelectorMatcher(
            'src',
            '[^\s"\',]*(?:' . $this->imgDirName .
            ')\/[^\s]*\-sc[0-9a-f]{13}[^\.]*\.(' . implode('|', $this->validExtensions) . ')',
            'img',
            '~'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFilter($filter = null, $params = [])
    {
        return null;
    }
}
