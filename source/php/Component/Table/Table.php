<?php

namespace ComponentLibrary\Component\Table;

class Table extends \ComponentLibrary\Component\BaseController implements TableInterface
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->padCells();

        //Typecast labels
        if(is_object($labels)) {
           $this->data['labels'] = (array) $labels; 
        }

        if ($filterable) {
            $this->data['attributeList']['js-table-filter'] = '';
        }

        if ($sortable) {
            $this->data['attributeList']['js-table-sort'] = '';
        }

        if ($isMultidimensional) {
            $this->data['classList'][]  = $this->getBaseClass() . '--multidimensional';
        }

        if ($showSum) {
            $this->data['classList'][]  = $this->getBaseClass() . '--summary';
        }
        if($fullscreen && empty($title)) {
            $this->data['classList'][] = $this->getBaseClass() . '--title-none';
        }

        if ($showSum) {
            $this->data['attributeList']['table-sum'] = true;

            $sumRow = ['columns' => []];
            foreach ($list as $rowIndex => $row) {
                foreach ($row['columns'] as $cellIndex => $cell) {
                    if ($cellIndex !== 0) {
                        if (!isset($sumRow['columns'][$cellIndex])) {
                            $sumRow['columns'][$cellIndex] = (int)$cell;
                        } else {
                            $sumRow['columns'][$cellIndex] += (int)$cell;
                        }
                    }
                }
            }

            if ($list[count($list) - 1]['columns'][0] !== 'Sum') {
                array_unshift($sumRow['columns'], 'Sum');
                array_push($list, $sumRow);
            }

            $this->data['list'] = $list;
        }
    }

    /**
     * Traverse the arrays and make
     * each sub array equal in length
     *
     * @return void
     */
    private function padCells()
    {
        $longest = 0;
        foreach ($this->data['list'] as $row) {
            $current = count($row['columns']);
            if ($current > $longest) {
                $longest = $current;
            }
        }

        foreach ($this->data['list'] as &$row) {
            $row['columns'] = array_pad($row['columns'], $longest, ' ');
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'table';
    }

    // -------------------------------------------------------------------------
    // TableInterface — generated getters
    // -------------------------------------------------------------------------

    public function getList(): array
    {
        return $this->data['list'] ?? [];
    }

    public function getHeadings(): array
    {
        return $this->data['headings'] ?? [];
    }

    public function getShowHeader(): bool
    {
        return $this->data['showHeader'] ?? true;
    }

    public function getShowCaption(): bool
    {
        return $this->data['showCaption'] ?? false;
    }

    public function getFilterable(): bool
    {
        return $this->data['filterable'] ?? false;
    }

    public function getSortable(): bool
    {
        return $this->data['sortable'] ?? false;
    }

    public function getShowSum(): bool
    {
        return $this->data['showSum'] ?? false;
    }

    public function getFullscreen(): bool
    {
        return $this->data['fullscreen'] ?? false;
    }

    public function getIsMultidimensional(): bool
    {
        return $this->data['isMultidimensional'] ?? false;
    }

    public function getTitle(): string
    {
        return $this->data['title'] ?? '';
    }

    public function getIncludePaper(): bool
    {
        return $this->data['includePaper'] ?? true;
    }

    public function getLabels(): object
    {
        return $this->data['labels'] ?? (object) [];
    }
}
