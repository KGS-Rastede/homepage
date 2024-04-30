<?php

use Kirby\Cms\Page;
use Kirby\Cms\Pages;


class RssfeedPage extends Page
{
    public function children(): Pages
    {
        if ($this->children instanceof Pages) {
            return $this->children;
        }

        $pages = [];
        
        // Fetch the RSS feed
        $request = Remote::get('https://kgs-rastede.eu/iserv/public/news/rss/news-infobildschirm-sek1');

        // If the request was successful, parse the feed
        if ($request->code() === 200) {
            $xml = Xml::parse($request->content());

            // Check if the XML is valid and contains items
            if ($xml !== false && isset($xml['channel']['item'])) {
                $items = $xml['channel']['item'];

                // If there is only one item, convert it to an array for consistency
                if (!is_array($items)) {
                    $items = [$items];
                }

                foreach ($items as $item) {
                    $pages[] = [
                        'slug'     => Str::slug($item['title']),
                        'template' => 'feeditem',
                        'model'    => 'feeditem',
                        'content'  => [
                            'title'       => $item['title'] ?? '',
                            'date'        => $item['pubDate'] ?? '',
                            'description' => $item['description'] ?? '',
                            'link'        => $item['link'] ?? '',
                            'content'     => $item['content:encoded'] ?? '',
                        ]
                    ];
                }
            } else {
                // Handle missing or empty item array
                throw new Exception('No items found in the RSS feed.');
            }
        } else {
            // Handle HTTP request error
            throw new Exception('Failed to fetch RSS feed.');
        }

        // Create a Pages collection for the child pages
        return $this->children = Pages::factory($pages, $this);
    }
}
