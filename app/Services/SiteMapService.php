<?php

namespace App\Services;

class SiteMapService
{
    protected $urls = [];

    public function addUrl($url, $lastmod, $changefreq, $priority, $images = [])
    {
        $this->urls[] = [
            'url' => $url,
            'lastmod' => $lastmod,
            'changefreq' => $changefreq,
            'priority' => $priority,
            'images' => $images,
        ];
    }

    public function generate()
    {
        try {
            $xml = new \XMLWriter();
            $xml->openURI(public_path('sitemap.xml'));
            $xml->startDocument('1.0', 'UTF-8');
            $xml->startElement('urlset');
            $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
            $xml->writeAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');

            foreach ($this->urls as $urlData) {
                $this->createUrl($xml, $urlData['url'], $urlData['lastmod'], $urlData['changefreq'], $urlData['priority'], $urlData['images']);
            }

            $xml->endElement();
            $xml->endDocument();
            $xml->flush();

            return "Sitemap generated successfully";
        } catch (\Exception $e) {
            return "Error generating sitemap: " . $e->getMessage();
        }
    }

    private function createUrl($xml, $url, $lastmod, $changefreq, $priority, $images = [])
    {
        $xml->startElement('url');
        $xml->writeElement('loc', $url);
        $xml->writeElement('lastmod', $lastmod);
        $xml->writeElement('changefreq', $changefreq);
        $xml->writeElement('priority', $priority);

        if (!empty($images)) {
            foreach ($images as $image) {
                $this->createImage($xml, $image['loc'], $image['title']);
            }
        }

        $xml->endElement();
    }

    private function createImage($xml, $imageLoc, $imageTitle)
    {
        $xml->startElement('image:image');
        $xml->writeElement('image:loc', $imageLoc);
        $xml->writeElement('image:title', $imageTitle);
        $xml->endElement();
    }
}
