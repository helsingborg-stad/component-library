<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Divider;

use ComponentLibrary\Component\ComponentInterface;

interface DividerInterface extends ComponentInterface
{
    /**
     * The tag to use for this component.
     */
    public function getComponentElement(): string;

    /**
     * Either dashed, solid or dotted.
     */
    public function getStyle(): string;

    /**
     * The length of the divider. Either sm, md or lg.
     */
    public function getSize(): string;

    /**
     * Title to be displayed in the divider.
     */
    public function getTitle(): string;

    /**
     * TitleVariant.
     */
    public function getTitleVariant(): string;

    /**
     * Alignment of text in the divider. left, center or right.
     */
    public function getAlign(): string;

    /**
     * If set to true, the title will be wrapped in a frame.
     */
    public function getFrame(): bool;

    /**
     * Enable if font color should be customized. Default: false.
     */
    public function getCustomFont(): bool;

}
