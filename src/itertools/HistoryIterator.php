<?php

namespace itertools;

use IteratorIterator;
use SplQueue;


class HistoryIterator extends IteratorIterator
{
	protected $history;
	protected $maxHistorySize;
	protected $hasStoredCurrent;

	public function __construct($innerIterator, $maxHistorySize = 1)
	{
		parent::__construct(IterUtil::asIterator($innerIterator));
		$this->history = new SplQueue();
		$this->maxHistorySize = $maxHistorySize;
		$this->hasStoredCurrent = false;
	}

	public function next()
	{
		parent::next();
		$this->hasStoredCurrent = false;
	}

	public function valid()
	{
		if(!parent::valid()) {
			return false;
		}
		if($this->hasStoredCurrent) {
			return true;
		}
		$this->addToHistory(parent::current());
		return true;
	}

	public function current()
	{
		return $this->history->bottom();
	}

	public function prev($n = 1)
	{
		return $this->history->offsetGet($n);
	}

	public function hasPrev($n = 1)
	{
		return $this->history->count() > $n;
	}

	public function rewind()
	{
		parent::rewind();
		$this->keepLastEntries(0);
		$this->hasStoredCurrent = false;
	}

	protected function addToHistory($value)
	{
		$this->history->unshift($value);
		$this->keepLastEntries($this->maxHistorySize + 1);
	}

	protected function keepLastEntries($count)
	{
		while($this->history->count() > $count) {
			$this->history->pop();
		}
	}
}
