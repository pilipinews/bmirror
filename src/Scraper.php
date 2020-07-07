<?php

namespace Pilipinews\Website\Bmirror;

use Pilipinews\Common\Article;
use Pilipinews\Common\Interfaces\ScraperInterface;
use Pilipinews\Common\Scraper as AbstractScraper;

/**
 * Business Mirror Scraper
 *
 * @package Pilipinews
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class Scraper extends AbstractScraper implements ScraperInterface
{
    /**
     * @var string[]
     */
    protected $removables = array('.td-a-rec', '.addtoany_share_save_container');

    /**
     * Returns the contents of an article.
     *
     * @param  string $link
     * @return \Pilipinews\Common\Article
     */
    public function scrape($link)
    {
        $this->prepare((string) $link);

        $title = $this->title('.tdb-title-text');

        $this->remove((array) $this->removables);

        $body = $this->body('.tdb_single_content > .tdb-block-inner.td-fix-index');

        $html = $this->html($body);

        return new Article($title, $html, $link);
    }
}
