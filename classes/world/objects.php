<?php

namespace jobs\world;

interface objects
{
	function addObjectProperty(comparable $name, comparable $value, object $object);
	function removeObjectProperty(comparable $name, comparable $value, object $object);
}
