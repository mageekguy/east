<?php

namespace jobs\world;

interface objects
{
	public function addObjectProperty(comparable $name, comparable $value, object $object);
	public function removeObjectProperty(comparable $name, comparable $value, object $object);
}
