<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>Neues von der KGS Rastede</title>
		<description>Die neuesten Nachrichten von der KGS Rastede</description>
		<link><?= $site->url() ?></link>
		<atom:link href="<?= $page->url() ?>.xml" rel="self" type="application/rss+xml" />
		<?php foreach ($articles as $note): ?>
		<item>
			<title><?= $note->title()->xml() ?></title>
			<pubDate><?= $note->date()->toDate('r') ?></pubDate>
            <description>
                <?= $note->Text()->toBlocks()->excerpt(100) ?>
            </description>
			<link><?= $note->url() ?></link>
			<guid isPermaLink="true"><?= $note->url() ?></guid>
		</item>
		<?php endforeach ?>
	</channel>
</rss>