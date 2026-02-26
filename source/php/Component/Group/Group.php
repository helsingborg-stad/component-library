<?php

namespace ComponentLibrary\Component\Group;

/**
 * Class Group
 * @package ComponentLibrary\Component\Group
 */
class Group extends \ComponentLibrary\Component\BaseController implements GroupInterface
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if (!empty($fluidGrid)) {
            $fluidGrid = is_numeric($fluidGrid) ? $fluidGrid : 3;
            $this->data['containerAware'] = true;
            $this->data['classList'][] = $this->getBaseClass('fluid-grid', true);
            $this->data['classList'][] = $this->getBaseClass('fluid-grid-' . $fluidGrid, true);
        }

        if ($direction == "vertical") {
            $this->data['classList'][] = $this->getBaseClass() . "--vertical";
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--horizontal";
        }

        if (!empty($justifyContent)) {
            $this->data['classList'][] = $this->getBaseClass() . "--justify-content-" . $justifyContent;      
        }
        
        if (!empty($gap)) {
            $this->data['classList'][] = $this->getBaseClass('gap-' . $gap, true);
        }
        
        if (!empty($alignItems)) {
            $this->data['classList'][] = $this->getBaseClass() . "--align-items-" . $alignItems;      
        }

        if (!empty($alignContent)) {
            $this->data['classList'][] = $this->getBaseClass() . "--align-content-" . $alignContent;      
        }

        if (!empty($display)) {
            $this->data['classList'][] = $this->getBaseClass() . "--display-" . $display;      
        }

        if (!empty($wrap)) {
            $this->data['classList'][] = $this->getBaseClass() . "--flex-wrap-" . $wrap;      
        }

        if ($flexGrow) {
            $this->data['classList'][] = $this->getBaseClass() . "--flex-grow";
        }

        if (!$flexShrink) {
            $this->data['classList'][] = $this->getBaseClass() . "--flex-shrink-none";
        }

        if ($columns) {
            $this->data['classList'][] = $this->getBaseClass() . "--columns-" . $columns;
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'group';
    }

    // -------------------------------------------------------------------------
    // GroupInterface — generated getters
    // -------------------------------------------------------------------------

    public function getDirection(): string
    {
        return $this->data['direction'] ?? 'horizontal';
    }

    public function getJusitifyContent(): string
    {
        return $this->data['jusitifyContent'] ?? '';
    }

    public function getAlignItems(): string
    {
        return $this->data['alignItems'] ?? '';
    }

    public function getAlignContent(): string
    {
        return $this->data['alignContent'] ?? '';
    }

    public function getDisplay(): string
    {
        return $this->data['display'] ?? '';
    }

    public function getWrap(): string
    {
        return $this->data['wrap'] ?? '';
    }

    public function getFlexGrow(): bool
    {
        return $this->data['flexGrow'] ?? false;
    }

    public function getFlexShrink(): bool
    {
        return $this->data['flexShrink'] ?? true;
    }

    public function getGap(): string
    {
        return $this->data['gap'] ?? '';
    }

    public function getFluidGrid(): mixed
    {
        return $this->data['fluidGrid'] ?? null;
    }

    public function getColumns(): mixed
    {
        return $this->data['columns'] ?? null;
    }
}
