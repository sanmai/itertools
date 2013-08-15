<?php

spl_autoload_register(function ($class) {
	$available_classes = array(
		'itertools\AbstractCsvIterator',
		'itertools\ArrayAccessIterator',
		'itertools\CachingIterator',
		'itertools\CallbackFilterIterator',
		'itertools\CallbackIterator',
		'itertools\CallbackRecursiveIterator',
		'itertools\ChainIterator',
		'itertools\ChunkedIterator',
		'itertools\ChunkingIterator',
		'itertools\CurrentCachedIterator',
		'itertools\FileCsvIterator',
		'itertools\FileLineIterator',
		'itertools\ForkingIterator',
		'itertools\HistoryIterator',
		'itertools\IterUtil',
		'itertools\MapIterator',
		'itertools\PdoIterator',
		'itertools\Queue',
		'itertools\RangeIterator',
		'itertools\RepeatIterator',
		'itertools\SliceIterator',
		'itertools\StringCsvIterator',
		'itertools\TakeWhileIterator',
		'itertools\UniqueIterator',
		'itertools\ZipIterator',
	);
	if(in_array($class, $available_classes)) {
		require(__DIR__ . '/../' . strtr($class, '\\', '/') . '.php');
	}
});

