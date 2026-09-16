<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Code;
final class CodeData { public function __construct(public string $content = 'Undocumented code...', public string $slot = "echo 'Whoops, there's no code here. Where is it?'", public string $language = 'php', public bool $escape = false, public string $componentElement = 'div', public string $preTagElement = 'pre') {} }
