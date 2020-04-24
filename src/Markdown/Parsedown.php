<?php

/*
 * This file is part of the markdown book project template.
 *
 * (c) Carl Alexander <contact@carlalexander.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Markdown;

use Parsedown as BaseParsedown;

/**
 * Exetended Parsedown class.
 *
 * Required to add ability to add IDs to section headings.
 *
 * @see https://github.com/erusev/parsedown/pull/285
 */
class Parsedown extends BaseParsedown
{
    /**
     * All the generated HTML IDs for the current markdown document.
     *
     * Array uses the base ID as a key and the number of occurrences of that ID as the value.
     *
     * @var array
     */
    private $generatedIds;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->generatedIds = [];
    }

    /**
     * {@inheritdoc}
     */
    protected function blockHeader($Line)
    {
        $block = parent::blockHeader($Line);

        if (!is_array($block) || empty($block['element']['text'])) {
            return $block;
        }

        $block['element']['attributes'] = [
            'id' =>  $this->createId($block['element']['text']),
        ];

        return $block;
    }

    /**
     * {@inheritdoc}
     */
    protected function inlineImage($Excerpt)
    {
        $image = parent::inlineImage($Excerpt);

        if (!is_array($image)
            || !isset($image['element']['name'], $image['element']['attributes']['src'], $image['element']['attributes']['title'])
            || 'img' !== $image['element']['name']
        ) {
            return $image;
        }

        $image['markup'] = "<figure><img src=\"{$image['element']['attributes']['src']}\" /><figcaption>{$image['element']['attributes']['title']}</figcaption></figure>";

        return $image;
    }

    /**
     * Create an HTML ID for the given text.
     *
     * @param string $text
     *
     * @return string
     */
    private function createId($text)
    {
        $attributeId = $id = preg_replace('/[^a-z0-9_-]/', '', strtolower(strtr(trim($text), ' ', '-')));

        if (!isset($this->generatedIds[$id])) {
            $this->generatedIds[$id] = 0;
        }

        if ($this->generatedIds[$id] > 0) {
            $attributeId .= '-'.$this->generatedIds[$id];
        }

        $this->generatedIds[$id]++;

        return $attributeId;
    }
}
